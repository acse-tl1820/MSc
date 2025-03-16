document.addEventListener('DOMContentLoaded', function () {
    const messagesContainer = document.getElementById('messagesContainer');
    const newMessageInput = document.getElementById('newMessage');
    const sendMessageBtn = document.getElementById('sendMessageBtn');

    function fetchMessages() {
        axios.get(`/chatroom/messages/${chatroom_id}`)
            .then(function (response) {
                messagesContainer.innerHTML = ''; // Clear existing messages
                response.data.forEach(function (message) {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = 'flex items-center mb-2';

                    if (message.user_id === current_user_id) {
                        messageDiv.innerHTML = `
                            <div class="flex gap-2 p-2 ml-auto text-white rounded-lg" style="background-color: darkgreen;">
                                ${message.message}
                            </div>
                        `;
                    } else {
                        messageDiv.innerHTML = `
                            <div class="p-2 mr-auto rounded-lg" style="background-color: black;">
                                ${message.message}
                            </div>
                        `;
                    }

                    messagesContainer.appendChild(messageDiv);
                });

                // Scroll to the bottom of the messages container
                messagesContainer.scrollTo({
                    top: messagesContainer.scrollHeight,
                    behavior: 'smooth',
                });
            })
            .catch(function (error) {
                console.error(error);
            });
    }

    // Function to send a message
    function sendMessage() {
        const newMessage = newMessageInput.value.trim();
        if (newMessage !== '') {
            axios.post('/chatroom/sendMessage', {
                chatroom_id: chatroom_id,
                message: newMessage,
        })
        .then(function (response) {
                newMessageInput.value = '';
                fetchMessages();
            }).catch(function (error) {
                console.error(error);
            });
        }
    }

    // Event listeners
    newMessageInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    });

    sendMessageBtn.addEventListener('click', sendMessage);

    fetchMessages();

    window.Echo.channel(`chat.${chatroom_id}`)
        .listen('MessageSent', function (response) {
            fetchMessages();
        });
});
