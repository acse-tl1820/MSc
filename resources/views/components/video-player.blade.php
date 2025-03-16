<div id="videoPlayer"></div>

<script>
    const chatroom_video_id = "{{ $chatroom->youtube_video_id }}";
    const current_user_id = {{ auth()->user()->id }};
    const chatroom_id = {{ $chatroom->id }};
</script>
