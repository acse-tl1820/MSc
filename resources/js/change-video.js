document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('change-video-form');
    const videoIdInput = document.getElementById('videoId');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const videoId = videoIdInput.value;
        if (!videoId) {
            alert('Please input YouTube URL to change the video');
            return;
        }

        const youtubeVideoId = videoId.split('v=')[1];

        axios.post(`/chatroom/change-video`, {
            youtube_video_id: youtubeVideoId,
            chatroom_id,
        })
            .then(function (response) {
                //reload the browser in order to refresh the data
                window.location.reload();
            })
            .catch(function (error) {
                console.error(error);
                alert('An error occurred while changing the video.');
            });
    });

});
