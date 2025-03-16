document.addEventListener('DOMContentLoaded', function() {

    let player;
    let isReady = false;
    let playerState = [];
    let users = []

    function initPlayer() {

        if (!window.YT) {
            const tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            const firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        }

        if (!isReady) {
            window.onYouTubeIframeAPIReady = () => {
                player = new YT.Player('videoPlayer', {
                    videoId: chatroom_video_id,
                    height: '100%',
                    width: '100%',
                    playerVars: { 'playsinline': 1, 'autoplay': 0, 'controls': 1},
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange,
                    },
                });

                isReady = true;
            };
        }
    }

    function onPlayerReady(event) {
        player.mute();

    }

    function onPlayerStateChange(event) {
        playerState.push(event.data)
        let current_time = player.getCurrentTime();

        if(playerState.length === 3 && playerState[0] === -1 && playerState[1] === 3 && playerState[2] === 1){
            console.log('started to play')
            axios.post(`/chatroom/sync-video`, {
                chatroom_id,
                action:"play",
                current_time,
                user_id:current_user_id,
            }).then(response => {
                console.log(response)
            })
            playerState = [];
        }

        if(playerState.length === 3 && playerState[0] === 2 && playerState[1] === 3 && playerState[2] === 1){
            console.log('seeked')
            axios.post(`/chatroom/sync-video`, {
                chatroom_id,
                action:"seek",
                current_time,
                user_id:current_user_id,
            }).then(response => {
                console.log(response)
            })
            playerState = [];
        }

        if(playerState.length === 2 && playerState[0] === 3 && playerState[1] === 1){
            console.log('resumed')
            axios.post(`/chatroom/sync-video`, {
                chatroom_id,
                action:"play",
                current_time,
                user_id:current_user_id,
            }).then(response => {
                console.log(response)
            })
            playerState = [];
        }

        setTimeout(() => {
            console.log('player paused')
            if(playerState.length === 1 && playerState[0] === 2){
                axios.post(`/chatroom/sync-video`, {
                    chatroom_id,
                    action:"pause",
                    current_time,
                    user_id:current_user_id,
                }).then(response => {
                    console.log(response)
                })
                playerState = [];
            }
        },1000)
    }

    initPlayer();


    Echo.channel(`sync.${chatroom_id}`).listen("VideoSync", (response) => {
        console.log('client response', response)
        //console.log('client action', response.videoAction.action)
        switch (response.videoAction.action) {
            case 'play':
                player.playVideo();
                break;
            case 'pause':
                player.pauseVideo();
                break;
            case 'resume':
                player.seekTo(response.videoAction.current_time, true);
                break;
            case 'seek':
                if(response.videoAction.current_time > 0){
                    player.seekTo(response.videoAction.current_time, true);
                }
                break;
        }
    });


    Echo.channel(`change.${chatroom_id}`)
        .listen('ChangeVideo', function (response) {
            player.cueVideoById(response.chatroom.youtube_video_id)
        });

    Echo.join(`chatroom.${chatroom_id}`)
        .here((users) => {
            let count = users.length
            let user_name = []
            users.forEach(function (user) {
                user_name.push(user.name)
                document.getElementById("onlineMembers").innerText = user_name.join(', ');
            });
        })
        .joining((user) => {
            users.push(user);
        })
        .leaving((user) => {
            users = users.filter((u) => u.id !== user.id);
        });

});
