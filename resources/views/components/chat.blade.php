<div>
    <div>
        <div id="messagesContainer" class="p-4 overflow-y-auto bg-transparent mb-2" style="height: 500px;">
            @foreach ($messages as $message)
                <div class="flex items-center mb-2">
                    @if ($message->user_id === $currentUser->id)
                        <div class="flex gap-2 p-2 ml-auto text-white rounded-lg" style="background-color: darkgreen;">
                             {{ $message->message }}
                        </div>
                    @else
                        <div class="p-2 mr-auto rounded-lg" style="background-color: black;">
                          {{ $message->message }}
</div>
@endif
</div>
@endforeach
</div>
</div>
<div class="flex items-center">
<input
type="text"
id="newMessage"
placeholder="Type a message..."
class="flex-1 px-2 py-1 border rounded-lg bg-gray-500"
/>
<x-emoji-picker />
<button id="sendMessageBtn" class="black-btn">
Send
</button>
</div>
</div>
