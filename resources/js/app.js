import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.PUSHER_APP_KEY,
    cluster: window.PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Make sure you dynamically pass the conversationId
var conversationId = {{ $conversation->id }}; // Pass this from the backend view

Echo.private('conversation.' + conversationId)
    .listen('MessageSent', (event) => {
        console.log(event);
        const messageContainer = document.querySelector('#chat-box');
        const newMessage = document.createElement('div');
        newMessage.classList.add('message');
        newMessage.innerHTML = `<strong>${event.message.user.name}:</strong> ${event.message.message}`;
        messageContainer.appendChild(newMessage);

        // Scroll to the bottom
        messageContainer.scrollTop = messageContainer.scrollHeight;
    });
