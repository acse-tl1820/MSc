document.addEventListener('DOMContentLoaded', function() {
    const emojiToggle = document.getElementById('emoji-toggle');
    const emojiList = document.getElementById('emoji-list');

    emojiToggle.addEventListener('click', function() {
        emojiList.style.display = emojiList.style.display === 'none' ? 'flex' : 'none';
    });

    const emojiItems = document.querySelectorAll('.emoji-item');
    emojiItems.forEach(function(item) {
        item.addEventListener('click', function() {
            const selectedEmoji = item.getAttribute('data-emoji');

            document.getElementById('newMessage').value = document.getElementById('newMessage').value + selectedEmoji;

            emojiList.style.display = 'none';
        });
    });
});
