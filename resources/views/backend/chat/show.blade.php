@extends('backend.layouts.app')

@section('content')
   <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <strong>
                                Chat with 
                                @foreach($conversation->users as $user)
                                    @if($user->id != auth()->id())
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </strong>
                        </div>
                        <div class="card-body" id="chat-box">
                            <!-- Display messages -->
                            @foreach($conversation->messages as $message)
                                <div class="{{ $message->user->id == auth()->id() ? 'sent' : 'received' }}">
                                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="text" id="chat-input" name="message" class="form-control" placeholder="Type a message" required>
                                <button type="submit" class="btn btn-primary mt-2">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include jQuery and Laravel Echo -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

     <script>
    // Send message using AJAX
    $('#chat-form').submit(function(e) {
        e.preventDefault();

        var message = $('#chat-input').val();
        var conversationId = {{ $conversation->id }}; // Pass the conversation ID

        if (message) {
            $.ajax({
                url: '/chat/send/' + conversationId,  // Adjust the route URL if necessary
                method: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Clear the input after sending
                    $('#chat-input').val('');
                }
            });
        }
    });

    // Laravel Echo listening for new messages for this specific conversation
    Echo.private('conversation.' + {{ $conversation->id }})  // Listen to the specific conversation channel
        .listen('MessageSent', (event) => {
            console.log('New message received:', event.message);

            // Append the new message to the chat box
            var newMessage = '<div class="message ' + (event.message.user.id == {{ auth()->id() }} ? 'sent' : 'received') + '"><strong>' + event.message.user.name + ':</strong> ' + event.message.message + '</div>';
            $('#chat-box').append(newMessage);

            // Scroll to the bottom of the chat box
            $("#chat-box").scrollTop($("#chat-box")[0].scrollHeight);
        });
</script>
@endsection