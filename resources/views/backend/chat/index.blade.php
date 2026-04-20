@php
    function userAvatar($user, $size = 40)
    {
        if ($user && !empty($user->profile_picture)) {
            return '<img src="' .
                asset($user->profile_picture) .
                '" alt="' .
                e($user->name ?? 'User') .
                '" style="width:' .
                $size .
                'px;height:' .
                $size .
                'px;border-radius:50%;">';
        }

        $letter = strtoupper(substr($user->name ?? 'U', 0, 1));

        return '<div style="width:' .
            $size .
            'px;height:' .
            $size .
            'px;border-radius:50%;background:#007bff;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:bold;">' .
            $letter .
            '</div>';
    }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perfect Chat Interface</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        body {
            background-color: #35443b;
            font-family: 'Source Sans Pro', sans-serif;
            font-size: 0.9em;
            color: #32465a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        #frame {
            display: flex;
            width: 70%;
            max-width: 900px;
            height: 90vh;
            background: #E6EAEA;
            border-radius: 15px;
            overflow: hidden;
        }

        #sidepanel {
            background: #2c3e50;
            color: #f5f5f5;
            width: 35%;
            padding: 15px;
            overflow-y: auto;
            scrollbar-width: none;
        }

        #sidepanel::-webkit-scrollbar {
            display: none;
        }

        #profile {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-bottom: 8px;
            padding: 6px 10px;
        }

        #profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        #profile p {
            margin-top: 5px;
            color: #fff;
            font-size: 1em;
            text-align: center;
        }

        #search {
            margin-bottom: 10px;
        }

        #search input {
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            border: none;
            background: #34495e;
            color: white;
            font-size: 0.9em;
        }

        #contacts ul {
            list-style: none;
            padding: 0;
        }

        #contacts ul li {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #34495e;
            transition: background-color 0.3s;
        }

        #contacts ul li:hover {
            background: #32465a;
        }

        #contacts img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .content {
            width: 65%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            background: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .contact-profile {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .contact-profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .contact-profile p {
            font-size: 1.1em;
            margin: 0;
        }

        .messages {
            flex-grow: 1;
            overflow-y: scroll;
            margin-bottom: 15px;
            background: #f5f5f5;
            border-radius: 8px;
            padding: 10px;
            max-height: calc(90vh - 160px);
            scrollbar-width: none;
        }

        .messages::-webkit-scrollbar {
            display: none;
        }

        .messages ul {
            list-style: none;
            padding: 0;
        }

        .messages ul li {
            display: flex;
            margin-bottom: 15px;
            align-items: center;
        }

        .messages ul li.sent {
            flex-direction: row-reverse;
        }

        .messages ul li p {
            background: #e9ecef;
            padding: 10px 15px;
            border-radius: 15px;
            max-width: 75%;
            margin: 0 0 0 8px;
        }

        .messages ul li.sent p {
            background: #d1ecf1;
            margin: 0 8px 0 0;
        }

        .messages ul li img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: 0 15px;
        }

        .message-input {
            display: flex;
            align-items: center;
            background: #f5f5f5;
            padding: 8px;
            border-radius: 8px;
        }

        .message-input input {
            flex: 1;
            padding: 8px 12px;
            border-radius: 20px;
            border: 1px solid #ddd;
            font-size: 0.85em;
        }

        .message-input button,
        .attachment,
        .microphone {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 6px;
        }

        .message-input i,
        .attachment i,
        .microphone i {
            font-size: 14px;
        }

        .message-input button {
            background: #007bff;
            color: white;
        }

        .attachment {
            background: #f39c12;
        }

        .microphone {
            background: #e74c3c;
        }

        .message-input button:hover,
        .attachment:hover,
        .microphone:hover {
            background: #3b5a3d;
        }

        @media screen and (max-width: 768px) {
            #frame {
                flex-direction: column;
            }

            #sidepanel {
                width: 100%;
                padding: 10px;
            }

            .content {
                width: 100%;
            }

            .message-input input {
                width: 60%;
            }

            .message-input button,
            .attachment,
            .microphone {
                width: 25%;
            }
        }

        .preview {
            font-size: 13px;
            color: rgb(139, 134, 134);
        }

        .user_overview {
            margin-left: 10px;
        }

        .message-select {
            margin-right: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                {!! userAvatar(auth()->user(), 40) !!}
                <p>{{ auth()->user()->name }}</p>
            </div>

            <div id="search">
                <input type="text" id="contact-search" placeholder="Search contacts...">
            </div>

            <div id="contacts">
                <ul id="contacts-list">
                    @foreach ($users as $user)
                        <li class="contact" data-name="{{ strtolower($user->name) }}"
                            onclick="window.location.href='{{ route('chat.startConversation', $user->id) }}'">
                            {!! userAvatar($user, 40) !!}
                            <div class="meta user_overview">
                                <h6 class="name mb-0">{{ $user->name }}</h6>

                                @php
                                    $lastMessage = \App\Models\Conversation::where(function ($q) use ($user) {
                                        $q->where('user_1_id', auth()->id())->where('user_2_id', $user->id);
                                    })
                                        ->orWhere(function ($q) use ($user) {
                                            $q->where('user_1_id', $user->id)->where('user_2_id', auth()->id());
                                        })
                                        ->with('messages')
                                        ->first()
                                        ?->messages->last();
                                @endphp

                                <p class="preview mb-0">
                                    {{ \Illuminate\Support\Str::limit($lastMessage?->message ?? 'No messages yet.', 30) }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="content">

            @if ($conversation)
                <div class="contact-profile">
                    @php
                        $otherUserId =
                            $conversation->user_1_id == auth()->id()
                                ? $conversation->user_2_id
                                : $conversation->user_1_id;

                        $otherUser = \App\Models\User::find($otherUserId);
                    @endphp

                    @if ($otherUser)
                        {!! userAvatar($otherUser, 43) !!}
                        <p class="ms-3" style="margin-left: 8px;">{{ $otherUser->name }}</p>
                    @else
                        <p>No user available in this conversation.</p>
                    @endif
                </div>

                <div class="messages" id="chat-messages">
                    <ul id="messages-list">
                        @foreach ($conversation->messages as $message)
                            <li class="{{ $message->user->id == auth()->id() ? 'sent' : 'replies' }}">
                                <div class="form-check mb-4" style="display: inline-block; margin-right: 12px;">
                                    <input type="checkbox" class="form-check-input message-select"
                                        value="{{ $message->id }}">
                                </div>

                                <div style="margin-right: 10px;">
                                    {!! userAvatar($message->user, 30) !!}
                                </div>

                                @if ($message->message)
                                    <p>{{ $message->message }}</p>
                                @endif

                                @if ($message->file_path)
                                    @if (in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <img src="{{ asset($message->file_path) }}" alt="Image"
                                            style="width: 90px; height: 90px; border-radius: 8px; object-fit: cover; margin-left: 10px; margin-right: 10px;">
                                    @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp4', 'avi', 'mkv']))
                                        <video width="320" height="240" controls>
                                            <source src="{{ asset($message->file_path) }}"
                                                type="video/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp3', 'ogg', 'wav']))
                                        <audio controls>
                                            <source src="{{ asset($message->file_path) }}"
                                                type="audio/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                            Your browser does not support the audio element.
                                        </audio>
                                    @else
                                        <a href="{{ asset($message->file_path) }}" download>Download File</a>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="message-input d-flex align-items-center">
                    <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}"
                        enctype="multipart/form-data" class="d-flex w-100">
                        @csrf

                        <input type="text" id="message-input" name="message" placeholder="Write your message..."
                            class="form-control">

                        <input type="file" id="file-upload" name="file" class="form-control mt-2"
                            style="display: none;">

                        <div id="file-preview-container" style="display: none; margin-left: 10px; margin-right: 10px;">
                            <div id="file-preview-content"></div>
                        </div>

                        <input type="hidden" id="audio-file" name="audio_file" value="">

                        <button type="submit" id="send-message" class="btn btn-primary ms-2"><i
                                class="fa fa-paper-plane"></i></button>

                        <label for="file-upload" class="btn ms-2"><i class="fa fa-paperclip"></i></label>

                        <button type="button" id="record-btn" class="btn ms-2"><i
                                class="fa fa-microphone"></i></button>

                        <audio id="audio-player" controls style="display: none;"></audio>

                    </form>
                    <button id="delete-selected" class="btn btn-danger mb-2" style="background-color: red;"><i
                            class="fa fa-trash"></i></button>
                </div>
            @else
                <div class="card border-0 shadow-sm h-100">
                    <div
                        class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5 px-4">

                        <div class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="width: 110px; height: 110px; background-color: rgba(0, 0, 207, 0.1);">
                            <i class="fas fa-comments text-success" style="font-size: 42px;"></i>
                        </div>

                        <h2 class="fw-bold text-dark mb-2">Welcome to Chat</h2>

                        <div class="bg-success rounded-pill mb-4" style="width: 70px; height: 4px;"></div>

                        <p class="text-muted fs-5 mb-4">
                            Select a conversation from the left to start messaging
                        </p>

                        <div class="d-flex justify-content-center align-items-center flex-wrap mt-3">

                            <div class="d-flex align-items-center mx-1">
                                <i class="fas fa-lock text-success mx-1"></i>
                                <span class="text-muted">Secure</span>
                            </div>

                            <div class="d-flex align-items-center mx-1">
                                <i class="fas fa-bolt text-success mx-1"></i>
                                <span class="text-muted">Fast</span>
                            </div>

                            <div class="d-flex align-items-center mx-1">
                                <i class="fas fa-user-friends text-success mx-1"></i>
                                <span class="text-muted">Easy</span>
                            </div>

                        </div>

                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chat-messages');
        const messagesList = document.getElementById('messages-list');
        const fileInput = document.getElementById('file-upload');
        const filePreviewContainer = document.getElementById('file-preview-container');
        const filePreviewContent = document.getElementById('file-preview-content');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const conversationId = @json($conversation ? $conversation->id : '');
        const currentUserAvatar = @json(userAvatar(auth()->user(), 30));

        function scrollChatToBottom() {
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        function escapeHtml(text) {
            return $('<div>').text(text || '').html();
        }

        function createFilePreviewFromUrl(fileUrl, extension) {
            if (!fileUrl || !extension) return '';

            extension = extension.toLowerCase();

            if (['jpg', 'jpeg', 'png'].includes(extension)) {
                return `<img src="${fileUrl}" alt="Image"
                    style="width: 90px; height: 90px; border-radius: 8px; object-fit: cover; margin-left: 10px; margin-right: 10px;">`;
            }

            if (['mp4', 'avi', 'mkv', 'webm'].includes(extension)) {
                return `
                    <video width="320" height="240" controls>
                        <source src="${fileUrl}">
                        Your browser does not support the video tag.
                    </video>
                `;
            }

            if (['mp3', 'ogg', 'wav'].includes(extension)) {
                return `
                    <audio controls>
                        <source src="${fileUrl}">
                        Your browser does not support the audio element.
                    </audio>
                `;
            }

            return `<a href="${fileUrl}" download>Download File</a>`;
        }

        function appendMessageToChat(messageText = '', fileUrl = '', extension = '', messageId = '') {
            const safeMessage = escapeHtml(messageText);
            const filePreview = createFilePreviewFromUrl(fileUrl, extension);

            const html = `
                <li class="sent">
                    <div class="form-check" style="display: inline-block; margin-right: 12px;">
                        <input type="checkbox" class="form-check-input message-select" value="${messageId}">
                    </div>

                    <div style="margin-right: 10px;">
                        ${currentUserAvatar}
                    </div>

                    ${safeMessage ? `<p>${safeMessage}</p>` : ''}
                    ${filePreview}
                </li>
            `;

            messagesList.insertAdjacentHTML('beforeend', html);
            scrollChatToBottom();
        }

        function clearFilePreview() {
            $('#file-upload').val('');
            filePreviewContainer.style.display = 'none';
            filePreviewContent.innerHTML = '';
        }

        scrollChatToBottom();

        $('#file-upload').on('change', function() {
            const file = this.files[0];

            if (!file) {
                clearFilePreview();
                return;
            }

            const fileName = file.name.toLowerCase();
            const extension = fileName.split('.').pop();

            filePreviewContainer.style.display = 'block';

            if (['jpg', 'jpeg', 'png'].includes(extension)) {
                const imageUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <img src="${imageUrl}" alt="Preview"
                        style="width: 70px; height: 70px; border-radius: 8px; object-fit: cover;">
                `;
            } else if (['mp4', 'avi', 'mkv', 'webm'].includes(extension)) {
                const videoUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <video width="100" height="70" controls style="border-radius: 8px;">
                        <source src="${videoUrl}">
                        Your browser does not support the video tag.
                    </video>
                `;
            } else if (['mp3', 'ogg', 'wav'].includes(extension)) {
                const audioUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <audio controls style="width: 140px;">
                        <source src="${audioUrl}">
                        Your browser does not support the audio element.
                    </audio>
                `;
            } else {
                filePreviewContent.innerHTML = `
                    <div style="padding: 8px 12px; background: #e9ecef; border-radius: 8px; font-size: 12px; max-width: 140px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        ${escapeHtml(file.name)}
                    </div>
                `;
            }
        });

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            let messageText = $('#message-input').val().trim();
            let selectedFile = fileInput.files[0];

            if (!messageText && !selectedFile) {
                return;
            }

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    let fileUrl = '';
                    let extension = '';
                    let messageId = '';

                    if (response && typeof response === 'object') {
                        fileUrl = response.file_url || response.file_path || '';
                        extension = response.extension || '';

                        if (!extension && selectedFile) {
                            let parts = selectedFile.name.split('.');
                            extension = parts.length > 1 ? parts.pop() : '';
                        }

                        messageId = response.message_id || response.id || '';
                    } else if (selectedFile) {
                        let parts = selectedFile.name.split('.');
                        extension = parts.length > 1 ? parts.pop() : '';
                    }

                    appendMessageToChat(messageText, fileUrl, extension, messageId);

                    $('#message-input').val('');
                    $('#audio-file').val('');
                    clearFilePreview();
                },
                error: function(xhr, status, error) {
                    console.log('Error sending message:', error);
                }
            });
        });

        let mediaRecorder;
        let audioChunks = [];
        let audioBlob;
        let recordingState = false;

        $('#record-btn').on('click', function(e) {
            e.preventDefault();

            if (!recordingState) {
                navigator.mediaDevices.getUserMedia({
                        audio: true
                    })
                    .then(function(stream) {
                        mediaRecorder = new MediaRecorder(stream);
                        audioChunks = [];

                        mediaRecorder.ondataavailable = function(event) {
                            audioChunks.push(event.data);
                        };

                        mediaRecorder.onstop = function() {
                            audioBlob = new Blob(audioChunks, {
                                type: 'audio/wav'
                            });

                            let audioUrl = URL.createObjectURL(audioBlob);
                            $('#audio-player').attr('src', audioUrl).show();

                            let file = new File([audioBlob], 'voice_message.wav', {
                                type: 'audio/wav'
                            });

                            let formData = new FormData();
                            formData.append('file', file);
                            formData.append('message', '');

                            $.ajax({
                                url: '/chat/send/' + conversationId,
                                method: 'POST',
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    let fileUrl = '';
                                    let extension = 'wav';
                                    let messageId = '';

                                    if (response && typeof response === 'object') {
                                        fileUrl = response.file_url || response.file_path || '';
                                        extension = response.extension || 'wav';
                                        messageId = response.message_id || response.id || '';
                                    }

                                    appendMessageToChat('', fileUrl, extension, messageId);
                                    resetRecordingState();
                                },
                                error: function(error) {
                                    console.log('Error sending the audio file:', error);
                                    resetRecordingState();
                                }
                            });
                        };

                        mediaRecorder.start();
                        recordingState = true;
                    })
                    .catch(function(error) {
                        console.log('Error accessing microphone:', error);
                    });
            } else {
                if (mediaRecorder && mediaRecorder.state === 'recording') {
                    mediaRecorder.stop();
                }
            }
        });

        function resetRecordingState() {
            recordingState = false;
            audioChunks = [];
            $('#audio-player').hide();
        }

        $('#delete-selected').on('click', function() {
            let selectedMessages = [];
            $('input.message-select:checked').each(function() {
                selectedMessages.push($(this).val());
            });

            if (selectedMessages.length === 0) {
                alert('Please select at least one message to delete.');
                return;
            }

            $.ajax({
                url: '/chat/delete-messages',
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    message_ids: selectedMessages
                },
                success: function(response) {
                    selectedMessages.forEach(function(messageId) {
                        $('input.message-select[value="' + messageId + '"]').closest('li').remove();
                    });
                    alert('Selected messages deleted successfully!');
                },
                error: function() {
                    alert('Error deleting selected messages.');
                }
            });
        });

        $('#contact-search').on('keyup', function() {
            let value = $(this).val().toLowerCase();

            $('#contacts-list .contact').filter(function() {
                $(this).toggle($(this).data('name').indexOf(value) > -1);
            });
        });
    </script>

</body>

</html>