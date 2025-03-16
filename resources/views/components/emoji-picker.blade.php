<div class="emoji-picker">
    <button id="emoji-toggle">😀</button>
    <div id="emoji-list" class="emoji-list" style="display: none;">
        @foreach(['😀', '😎', '😍', '🤔', '😴', '😡', '🥳', '🤩', '😱', '👋', '👍', '👏'] as $emoji)
            <span class="emoji-item" data-emoji="{{ $emoji }}">{{ $emoji }}</span>
        @endforeach
    </div>
</div>
