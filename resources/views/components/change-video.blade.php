<form id="change-video-form" class="flex gap-2 py-2">
    @csrf
    <input
        type="text"
        id="videoId"
        name="videoId"
        class="m-2 flex-1 px-2 py-1 border rounded-lg bg-gray-500 w-full placeholder:text-gray-900"
        placeholder="Please input YouTube URL to change the video"
    />
    <button type="submit" class="black-btn" style="height:35px;margin-top:7px;">Change Video URL</button>
</form>
