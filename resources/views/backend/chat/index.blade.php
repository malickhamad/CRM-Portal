{{-- @php
    use App\Models\Conversation;

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
                'px;border-radius:50%;object-fit:cover;">';
        }

        $letter = strtoupper(substr($user->name ?? 'U', 0, 1));

        return '<div style="width:' .
            $size .
            'px;height:' .
            $size .
            'px;border-radius:50%;background:#14532d;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:bold;">' .
            $letter .
            '</div>';
    }

    function getMessagePreview($message)
    {
        if (!$message) {
            return 'No messages yet.';
        }

        if (!empty($message->message)) {
            return \Illuminate\Support\Str::limit($message->message, 30);
        }

        if (!empty($message->file_path)) {
            $ext = strtolower(pathinfo($message->file_path, PATHINFO_EXTENSION));

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return '📷 Photo';
            }

            if (in_array($ext, ['mp4', 'avi', 'mkv', 'webm'])) {
                return '🎥 Video';
            }

            if (in_array($ext, ['mp3', 'ogg', 'wav'])) {
                return '🎤 Voice message';
            }

            return '📎 File';
        }

        return 'No messages yet.';
    }

    $sortedUsers = collect($users)
        ->map(function ($user) {
            $conversation = Conversation::where(function ($q) use ($user) {
                $q->where('user_1_id', auth()->id())->where('user_2_id', $user->id);
            })
                ->orWhere(function ($q) use ($user) {
                    $q->where('user_1_id', $user->id)->where('user_2_id', auth()->id());
                })
                ->with([
                    'messages' => function ($q) {
                        $q->latest();
                    },
                ])
                ->first();

            $lastMessage = $conversation?->messages->sortByDesc('created_at')->first();

            $unreadCount = 0;

            if ($conversation) {
                $unreadCount = $conversation->messages()->where('user_id', $user->id)->where('is_read', 0)->count();
            }

            $user->chat_conversation = $conversation;
            $user->last_message = $lastMessage;
            $user->last_message_time = $lastMessage?->created_at;
            $user->unread_count = $unreadCount;
            $user->preview_text = getMessagePreview($lastMessage);

            return $user;
        })
        ->sortByDesc(function ($user) {
            return $user->last_message_time ?? now()->subYears(10);
        });
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
            margin: 0;
            overflow: hidden;
        }

        #frame {
            display: flex;
            width: 70%;
            max-width: 900px;
            height: 92vh;
            margin: 4vh auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
        }

        #sidepanel {
            background: #23343b;
            color: #f5f5f5;
            width: 35%;
            min-width: 280px;
            padding: 12px;
            overflow-y: auto;
            scrollbar-width: none;
        }

        #sidepanel::-webkit-scrollbar {
            display: none;
        }

        #profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 12px;
        }

        #profile p {
            margin: 0;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
        }

        #search {
            margin-bottom: 12px;
        }

        #search input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 24px;
            border: none;
            background: #31464f;
            color: #fff;
            font-size: 13px;
            outline: none;
        }

        #search input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        #contacts ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #contacts ul li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            cursor: pointer;
            border-radius: 12px;
            margin-bottom: 6px;
            transition: 0.25s ease;
        }

        #contacts ul li:hover,
        #contacts ul li.active-contact {
            background: rgba(255, 255, 255, 0.08);
        }

        .contact-left {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
        }

        .user_overview {
            margin-left: 10px;
            min-width: 0;
            flex: 1;
        }

        .contact-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .contact-top-row .name {
            margin: 0;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.72);
            margin: 2px 0 0 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-badge {
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 10px;
            background: #25d366;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .content {
            width: 65%;
            display: flex;
            flex-direction: column;
            background: #f6f8fa;
            padding: 12px;
            min-width: 0;
        }

        .contact-profile {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            background: #fff;
            border-radius: 14px;
            margin-bottom: 8px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            flex-wrap: wrap;
        }

        .contact-profile-left {
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .contact-profile-left p {
            margin: 0 0 0 10px;
            font-size: 16px;
            font-weight: 700;
            color: #23343b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .chat-header-actions .form-check {
            margin: 0;
            padding: 6px 12px 6px 28px;
            background: #f2f4f6;
            border-radius: 20px;
        }

        #delete-selected {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 22px;
            padding: 7px 14px;
            font-weight: 600;
        }

        #delete-selected:hover {
            background: #c82333;
            color: #fff;
        }

        .messages {
            flex: 1;
            overflow-y: auto;
            background: #f4f7f9;
            border-radius: 14px;
            padding: 12px 10px 6px 10px;
            margin-bottom: 8px;
            scrollbar-width: none;
            min-height: 0;
        }

        .messages::-webkit-scrollbar {
            display: none;
        }

        .messages ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .messages ul li {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .messages ul li.sent {
            flex-direction: row-reverse;
        }

        .messages ul li p {
            background: #fff;
            padding: 10px 14px;
            border-radius: 16px;
            max-width: 72%;
            margin: 0;
            word-break: break-word;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .messages ul li.sent p {
            background: #dff3e5;
        }

        .message-select {
            margin-right: 0;
        }

        .chat-image-link {
            display: inline-block;
            margin: 0 4px;
        }

        .chat-image-link img {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            object-fit: cover;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        .message-input-wrapper {
            background: #fff;
            border-radius: 14px;
            padding: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .selected-file-preview {
            display: none;
            margin-bottom: 8px;
        }

        .preview-box {
            position: relative;
            display: inline-block;
            background: #f7f9fb;
            border: 1px solid #e4eaee;
            border-radius: 12px;
            padding: 8px;
            max-width: 180px;
        }

        .remove-preview-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 22px;
            height: 22px;
            border: none;
            border-radius: 50%;
            background: #dc3545;
            color: #fff;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .message-input {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-input input[type="text"] {
            flex: 1;
            padding: 10px 14px;
            border-radius: 24px;
            border: 1px solid #dce5eb;
            font-size: 13px;
            outline: none;
        }

        .message-input button,
        .message-input label {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 50%;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0;
            border: none;
        }

        #send-message {
            background: #0d6efd;
            color: #fff;
        }

        #file-label-btn {
            background: #f0ad4e;
            color: #fff;
            cursor: pointer;
        }

        #record-btn {
            background: #e74c3c;
            color: #fff;
        }

        #record-btn.recording {
            background: #28a745;
        }

        .recording-status {
            display: none;
            font-size: 12px;
            color: #dc3545;
            font-weight: 700;
        }

        .recording-status.active {
            display: inline-block;
        }

        .file-thumb-img {
            width: 90px;
            height: 90px;
            border-radius: 8px;
            object-fit: cover;
        }

        .file-thumb-video {
            width: 120px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .file-name-box {
            padding: 8px 12px;
            background: #e9ecef;
            border-radius: 8px;
            font-size: 12px;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            body {
                overflow: auto;
            }

            #frame {
                width: 100%;
                max-width: 100%;
                height: 100vh;
                margin: 0;
                border-radius: 0;
                flex-direction: column;
            }

            #sidepanel {
                width: 100%;
                min-width: 100%;
                max-height: 34vh;
                padding: 10px;
            }

            .content {
                width: 100%;
                height: 66vh;
                padding: 10px;
            }

            .contact-profile {
                padding: 10px;
                margin-bottom: 6px;
            }

            .chat-header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .messages {
                padding: 10px 8px 5px 8px;
                margin-bottom: 6px;
            }

            .messages ul li p {
                max-width: 78%;
                font-size: 13px;
            }

            .message-input {
                flex-wrap: wrap;
            }

            .message-input input[type="text"] {
                width: 100%;
                flex: 0 0 100%;
                margin-bottom: 4px;
            }

            .chat-image-link img {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            #profile p {
                font-size: 14px;
            }

            .contact-top-row .name {
                font-size: 13px;
            }

            .preview {
                font-size: 11px;
            }

            .contact-profile-left p {
                font-size: 14px;
            }

            .chat-header-actions .form-check {
                font-size: 12px;
            }

            #delete-selected {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>
    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                {!! userAvatar(auth()->user(), 42) !!}
                <p>{{ auth()->user()->name }}</p>
            </div>

            <div id="search">
                <input type="text" id="contact-search" placeholder="Search contacts...">
            </div>

            <div id="contacts">
                <ul id="contacts-list">
                    @foreach ($sortedUsers as $user)
                        <li class="contact {{ isset($otherUser) && $otherUser && $otherUser->id == $user->id ? 'active-contact' : '' }}"
                            data-name="{{ strtolower($user->name) }}" data-user-id="{{ $user->id }}"
                            data-conversation-id="{{ $user->chat_conversation?->id }}"
                            onclick="window.location.href='{{ route('chat.startConversation', $user->id) }}'">
                            <div class="contact-left">
                                {!! userAvatar($user, 42) !!}

                                <div class="meta user_overview">
                                    <div class="contact-top-row">
                                        <h6 class="name">{{ $user->name }}</h6>

                                        <span class="unread-badge"
                                            style="{{ $user->unread_count > 0 ? '' : 'display:none;' }}">
                                            {{ $user->unread_count > 9 ? '9+' : $user->unread_count }}
                                        </span>
                                    </div>

                                    <p class="preview">{{ $user->preview_text }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="content">
            @if ($conversation)
                @php
                    $otherUserId =
                        $conversation->user_1_id == auth()->id() ? $conversation->user_2_id : $conversation->user_1_id;

                    $otherUser = \App\Models\User::find($otherUserId);
                @endphp

                <div class="contact-profile">
                    <div class="contact-profile-left">
                        @if ($otherUser)
                            {!! userAvatar($otherUser, 44) !!}
                            <p>{{ $otherUser->name }}</p>
                        @else
                            <p>No user available in this conversation.</p>
                        @endif
                    </div>

                    <div class="chat-header-actions">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="select-all-messages">
                            <label class="form-check-label ml-2" for="select-all-messages">Select All</label>
                        </div>

                        <button type="button" id="delete-selected" class="btn btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="messages" id="chat-messages">
                    <ul id="messages-list">
                        @foreach ($conversation->messages as $message)
                            <li class="{{ $message->user->id == auth()->id() ? 'sent' : 'replies' }}">
                                <div class="form-check mb-3" style="display: inline-flex;">
                                    <input type="checkbox" class="form-check-input message-select"
                                        value="{{ $message->id }}">
                                </div>

                                <div>
                                    {!! userAvatar($message->user, 30) !!}
                                </div>

                                @if ($message->message)
                                    <p>{{ $message->message }}</p>
                                @endif

                                @if ($message->file_path)
                                    @php
                                        $ext = strtolower(pathinfo($message->file_path, PATHINFO_EXTENSION));
                                    @endphp

                                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset($message->file_path) }}" target="_blank"
                                            class="chat-image-link">
                                            <img src="{{ asset($message->file_path) }}" alt="Image">
                                        </a>
                                    @elseif(in_array($ext, ['mp4', 'avi', 'mkv', 'webm']))
                                        <video width="220" height="160" controls
                                            style="border-radius: 10px; margin: 0 6px;">
                                            <source src="{{ asset($message->file_path) }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    @elseif(in_array($ext, ['mp3', 'ogg', 'wav']))
                                        <audio controls style="margin: 0 6px;">
                                            <source src="{{ asset($message->file_path) }}">
                                            Your browser does not support the audio element.
                                        </audio>
                                    @else
                                        <a href="{{ asset($message->file_path) }}" download
                                            style="margin: 0 6px;">Download File</a>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="message-input-wrapper">
                    <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div id="selected-file-preview" class="selected-file-preview">
                            <div class="preview-box">
                                <button type="button" class="remove-preview-btn" id="remove-preview-btn">
                                    <i class="fa fa-times"></i>
                                </button>
                                <div id="file-preview-content"></div>
                            </div>
                        </div>

                        <div class="message-input">
                            <input type="text" id="message-input" name="message" placeholder="Write your message..."
                                class="form-control">

                            <input type="file" id="file-upload" name="file" style="display: none;">

                            <input type="hidden" id="audio-file" name="audio_file" value="">

                            <button type="submit" id="send-message" class="btn">
                                <i class="fa fa-paper-plane"></i>
                            </button>

                            <label for="file-upload" class="btn" id="file-label-btn">
                                <i class="fa fa-paperclip"></i>
                            </label>

                            <button type="button" id="record-btn" class="btn">
                                <i class="fa fa-microphone"></i>
                            </button>

                            <span id="recording-status" class="recording-status">Recording...</span>
                        </div>
                    </form>
                </div>
            @else
                <div class="card border-0 shadow-sm h-100">
                    <div
                        class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5 px-4">
                        <div class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="width: 110px; height: 110px; background-color: rgba(0, 0, 207, 0.1);">
                            <i class="fas fa-comments text-success" style="font-size: 42px;"></i>
                        </div>

                        <h2 class="font-weight-bold text-dark mb-2">Welcome to Chat</h2>
                        <div class="bg-success rounded-pill mb-4" style="width: 70px; height: 4px;"></div>

                        <p class="text-muted mb-4">
                            Select a conversation from the left to start messaging
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chat-messages');
        const messagesList = document.getElementById('messages-list');
        const fileInput = document.getElementById('file-upload');
        const selectedFilePreview = document.getElementById('selected-file-preview');
        const filePreviewContent = document.getElementById('file-preview-content');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const conversationId = @json($conversation ? $conversation->id : '');
        const currentUserId = @json(auth()->id());
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
                return `
                    <a href="${fileUrl}" target="_blank" class="chat-image-link">
                        <img src="${fileUrl}" alt="Image">
                    </a>
                `;
            }

            if (['mp4', 'avi', 'mkv', 'webm'].includes(extension)) {
                return `
                    <video width="220" height="160" controls style="border-radius: 10px; margin: 0 6px;">
                        <source src="${fileUrl}">
                        Your browser does not support the video tag.
                    </video>
                `;
            }

            if (['mp3', 'ogg', 'wav'].includes(extension)) {
                return `
                    <audio controls style="margin: 0 6px;">
                        <source src="${fileUrl}">
                        Your browser does not support the audio element.
                    </audio>
                `;
            }

            return `<a href="${fileUrl}" download style="margin: 0 6px;">Download File</a>`;
        }

        function appendMessageToChat(messageText = '', fileUrl = '', extension = '', messageId = '') {
            const safeMessage = escapeHtml(messageText);
            const filePreview = createFilePreviewFromUrl(fileUrl, extension);

            const html = `
                <li class="sent">
                    <div class="form-check" style="display: inline-flex;">
                        <input type="checkbox" class="form-check-input message-select" value="${messageId}">
                    </div>
                    <div>${currentUserAvatar}</div>
                    ${safeMessage ? `<p>${safeMessage}</p>` : ''}
                    ${filePreview}
                </li>
            `;

            messagesList.insertAdjacentHTML('beforeend', html);
            bindMessageCheckboxEvents();
            syncSelectAllState();
            scrollChatToBottom();
        }

        function appendIncomingMessage(messageText = '', fileUrl = '', extension = '', messageId = '') {
            const safeMessage = escapeHtml(messageText);
            const filePreview = createFilePreviewFromUrl(fileUrl, extension);

            const html = `
                <li class="replies">
                    <div class="form-check mb-3" style="display: inline-flex;">
                        <input type="checkbox" class="form-check-input message-select" value="${messageId}">
                    </div>
                    <div></div>
                    ${safeMessage ? `<p>${safeMessage}</p>` : ''}
                    ${filePreview}
                </li>
            `;

            messagesList.insertAdjacentHTML('beforeend', html);
            bindMessageCheckboxEvents();
            syncSelectAllState();
            scrollChatToBottom();
        }

        function clearFilePreview() {
            if (fileInput) {
                fileInput.value = '';
            }

            if (selectedFilePreview) {
                selectedFilePreview.style.display = 'none';
            }

            if (filePreviewContent) {
                filePreviewContent.innerHTML = '';
            }
        }

        function renderSelectedFilePreview(file) {
            if (!file) {
                clearFilePreview();
                return;
            }

            const fileName = file.name.toLowerCase();
            const extension = fileName.split('.').pop();

            selectedFilePreview.style.display = 'block';

            if (['jpg', 'jpeg', 'png'].includes(extension)) {
                const imageUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `<img src="${imageUrl}" alt="Preview" class="file-thumb-img">`;
            } else if (['mp4', 'avi', 'mkv', 'webm'].includes(extension)) {
                const videoUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <video controls class="file-thumb-video">
                        <source src="${videoUrl}">
                        Your browser does not support the video tag.
                    </video>
                `;
            } else if (['mp3', 'ogg', 'wav'].includes(extension)) {
                const audioUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <audio controls style="width: 150px;">
                        <source src="${audioUrl}">
                        Your browser does not support the audio element.
                    </audio>
                `;
            } else {
                filePreviewContent.innerHTML = `<div class="file-name-box">${escapeHtml(file.name)}</div>`;
            }
        }

        function syncSelectAllState() {
            const allCheckbox = $('#select-all-messages');
            const checkboxes = $('.message-select');
            const checked = $('.message-select:checked');

            if (!checkboxes.length) {
                allCheckbox.prop('checked', false).prop('indeterminate', false);
                return;
            }

            if (checked.length === 0) {
                allCheckbox.prop('checked', false).prop('indeterminate', false);
            } else if (checked.length === checkboxes.length) {
                allCheckbox.prop('checked', true).prop('indeterminate', false);
            } else {
                allCheckbox.prop('checked', false).prop('indeterminate', true);
            }
        }

        function bindMessageCheckboxEvents() {
            $('.message-select').off('change').on('change', function() {
                syncSelectAllState();
            });
        }

        function setRecordingUI(isRecording) {
            if (isRecording) {
                $('#record-btn').addClass('recording');
                $('#recording-status').addClass('active');
                $('#record-btn i').removeClass('fa-microphone').addClass('fa-stop');
            } else {
                $('#record-btn').removeClass('recording');
                $('#recording-status').removeClass('active');
                $('#record-btn i').removeClass('fa-stop').addClass('fa-microphone');
            }
        }

        function getPreviewTextFromEvent(message) {
            if (message.message) {
                return message.message.length > 30 ? message.message.substring(0, 30) + '...' : message.message;
            }

            if (message.file_path) {
                const ext = (message.extension || '').toLowerCase();

                if (['jpg', 'jpeg', 'png'].includes(ext)) return '📷 Photo';
                if (['mp4', 'avi', 'mkv', 'webm'].includes(ext)) return '🎥 Video';
                if (['mp3', 'ogg', 'wav'].includes(ext)) return '🎤 Voice message';
                return '📎 File';
            }

            return 'No messages yet.';
        }

        function moveContactToTop(contactItem) {
            const contactsList = document.getElementById('contacts-list');
            if (contactsList && contactItem) {
                contactsList.prepend(contactItem);
            }
        }

        function updateSidebarLive(messageData) {
            const contactItem = document.querySelector(
                '#contacts-list .contact[data-conversation-id="' + messageData.conversation_id + '"]'
            );

            if (!contactItem) return;

            const previewEl = contactItem.querySelector('.preview');
            const badgeEl = contactItem.querySelector('.unread-badge');
            const isActiveConversation = String(messageData.conversation_id) === String(conversationId);

            if (previewEl) {
                previewEl.textContent = getPreviewTextFromEvent(messageData);
            }

            if (parseInt(messageData.user_id) !== parseInt(currentUserId) && !isActiveConversation && badgeEl) {
                let currentCount = parseInt(badgeEl.textContent) || 0;
                currentCount++;
                badgeEl.style.display = 'inline-flex';
                badgeEl.textContent = currentCount > 9 ? '9+' : currentCount;
            }

            if (isActiveConversation && badgeEl) {
                badgeEl.style.display = 'none';
                badgeEl.textContent = '0';
            }

            moveContactToTop(contactItem);
        }

        scrollChatToBottom();
        bindMessageCheckboxEvents();
        syncSelectAllState();

        $('#file-upload').on('change', function() {
            const file = this.files[0];
            renderSelectedFilePreview(file);
        });

        $('#remove-preview-btn').on('click', function() {
            clearFilePreview();
        });

        $('#select-all-messages').on('change', function() {
            $('.message-select').prop('checked', $(this).is(':checked'));
            syncSelectAllState();
        });

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            let messageText = $('#message-input').val().trim();
            let selectedFile = fileInput ? fileInput.files[0] : null;

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
                        messageId = response.message_id || response.id || '';

                        if (!extension && selectedFile) {
                            let parts = selectedFile.name.split('.');
                            extension = parts.length > 1 ? parts.pop() : '';
                        }
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
        let recordingState = false;

        $('#record-btn').on('click', function(e) {
            e.preventDefault();

            if (!recordingState) {
                navigator.mediaDevices.getUserMedia({
                    audio: true
                }).then(function(stream) {
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];

                    mediaRecorder.ondataavailable = function(event) {
                        audioChunks.push(event.data);
                    };

                    mediaRecorder.onstop = function() {
                        let audioBlob = new Blob(audioChunks, {
                            type: 'audio/wav'
                        });

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
                    setRecordingUI(true);
                }).catch(function(error) {
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
            setRecordingUI(false);
        }

        $('#delete-selected').on('click', function() {
            let selectedMessages = [];

            $('.message-select:checked').each(function() {
                selectedMessages.push($(this).val());
            });

            if (selectedMessages.length === 0) {
                alert('Please select at least one message to delete.');
                return;
            }

            if (!confirm('Are you sure you want to delete selected messages?')) {
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
                        $('.message-select[value="' + messageId + '"]').closest('li').remove();
                    });

                    syncSelectAllState();
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

        if (typeof window.Echo !== 'undefined') {
            window.Echo.channel('chat')
                .listen('.message.sent', function(e) {
                    const message = e.message || e;

                    updateSidebarLive(message);

                    if (String(message.conversation_id) === String(conversationId) &&
                        parseInt(message.user_id) !== parseInt(currentUserId)) {

                        appendIncomingMessage(
                            message.message || '',
                            message.file_path || '',
                            message.extension || '',
                            message.id || message.message_id || ''
                        );
                    }
                });
        }


        function refreshSidebarWithoutReload() {
            fetch(window.location.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newContactsList = doc.querySelector('#contacts-list');
                    const currentContactsList = document.querySelector('#contacts-list');

                    if (newContactsList && currentContactsList) {
                        currentContactsList.innerHTML = newContactsList.innerHTML;
                    }
                })
                .catch(error => {
                    console.log('Sidebar refresh error:', error);
                });
        }

        // refresh sidebar every 3 seconds
        setInterval(function() {
            refreshSidebarWithoutReload();
        }, 3000);
    </script>
</body>

</html> --}}




@extends('backend.layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <main class="dashboard-main">
        {{-- @include('backend.layouts.partials.header') --}}


@php
    use App\Models\Conversation;

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
                'px;border-radius:50%;object-fit:cover;">';
        }

        $letter = strtoupper(substr($user->name ?? 'U', 0, 1));

        return '<div style="width:' .
            $size .
            'px;height:' .
            $size .
            'px;border-radius:50%;background:#14532d;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:bold;">' .
            $letter .
            '</div>';
    }

    function getMessagePreview($message)
    {
        if (!$message) {
            return 'No messages yet.';
        }

        if (!empty($message->message)) {
            return \Illuminate\Support\Str::limit($message->message, 30);
        }

        if (!empty($message->file_path)) {
            $ext = strtolower(pathinfo($message->file_path, PATHINFO_EXTENSION));

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
                return '📷 Photo';
            }

            if (in_array($ext, ['mp4', 'avi', 'mkv', 'webm'])) {
                return '🎥 Video';
            }

            if (in_array($ext, ['mp3', 'ogg', 'wav'])) {
                return '🎤 Voice message';
            }

            return '📎 File';
        }

        return 'No messages yet.';
    }

    $sortedUsers = collect($users)
        ->map(function ($user) {
            $conversation = Conversation::where(function ($q) use ($user) {
                $q->where('user_1_id', auth()->id())->where('user_2_id', $user->id);
            })
                ->orWhere(function ($q) use ($user) {
                    $q->where('user_1_id', $user->id)->where('user_2_id', auth()->id());
                })
                ->with([
                    'messages' => function ($q) {
                        $q->latest();
                    },
                ])
                ->first();

            $lastMessage = $conversation?->messages->sortByDesc('created_at')->first();

            $unreadCount = 0;

            if ($conversation) {
                $unreadCount = $conversation->messages()->where('user_id', $user->id)->where('is_read', 0)->count();
            }

            $user->chat_conversation = $conversation;
            $user->last_message = $lastMessage;
            $user->last_message_time = $lastMessage?->created_at;
            $user->unread_count = $unreadCount;
            $user->preview_text = getMessagePreview($lastMessage);

            return $user;
        })
        ->sortByDesc(function ($user) {
            return $user->last_message_time ?? now()->subYears(10);
        });
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
            /* min-height: 100vh; */
            margin: 0;
            overflow: hidden;
        }

        #frame {
            display: flex;
            width: 70%;
            max-width: 900px;
            height: 92vh;
            margin: 4vh auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.18);
        }

        #sidepanel {
            background: #23343b;
            color: #f5f5f5;
            width: 35%;
            min-width: 280px;
            padding: 12px;
            overflow-y: auto;
            scrollbar-width: none;
        }

        #sidepanel::-webkit-scrollbar {
            display: none;
        }

        #profile {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 12px;
        }

        #profile p {
            margin: 0;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
        }

        #search {
            margin-bottom: 12px;
        }

        #search input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 24px;
            border: none;
            background: #31464f;
            color: #fff;
            font-size: 13px;
            outline: none;
        }

        #search input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        #contacts ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #contacts ul li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            cursor: pointer;
            border-radius: 12px;
            margin-bottom: 6px;
            transition: 0.25s ease;
        }

        #contacts ul li:hover,
        #contacts ul li.active-contact {
            background: rgba(255, 255, 255, 0.08);
        }

        .contact-left {
            display: flex;
            align-items: center;
            flex: 1;
            min-width: 0;
        }

        .user_overview {
            margin-left: 10px;
            min-width: 0;
            flex: 1;
        }

        .contact-top-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .contact-top-row .name {
            margin: 0;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.72);
            margin: 2px 0 0 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-badge {
            min-width: 20px;
            height: 20px;
            padding: 0 6px;
            border-radius: 10px;
            background: #25d366;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .content {
            width: 65%;
            display: flex;
            flex-direction: column;
            background: #f6f8fa;
            padding: 12px;
            min-width: 0;
        }

        .contact-profile {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            background: #fff;
            border-radius: 14px;
            margin-bottom: 8px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            flex-wrap: wrap;
        }

        .contact-profile-left {
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .contact-profile-left p {
            margin: 0 0 0 10px;
            font-size: 16px;
            font-weight: 700;
            color: #23343b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .chat-header-actions .form-check {
            margin: 0;
            padding: 6px 12px 6px 28px;
            background: #f2f4f6;
            border-radius: 20px;
        }

        #delete-selected {
            background: #dc3545;
            color: #fff;
            border: none;
            border-radius: 22px;
            padding: 7px 14px;
            font-weight: 600;
        }

        #delete-selected:hover {
            background: #c82333;
            color: #fff;
        }

        .messages {
            flex: 1;
            overflow-y: auto;
            background: #f4f7f9;
            border-radius: 14px;
            padding: 12px 10px 6px 10px;
            margin-bottom: 8px;
            scrollbar-width: none;
            min-height: 0;
        }

        .messages::-webkit-scrollbar {
            display: none;
        }

        .messages ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .messages ul li {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }

        .messages ul li.sent {
            flex-direction: row-reverse;
        }

        .messages ul li p {
            background: #fff;
            padding: 10px 14px;
            border-radius: 16px;
            max-width: 72%;
            margin: 0;
            word-break: break-word;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: inline-block;
        }

        .messages ul li.sent p {
            background: #dff3e5;
        }

        .message-select {
            margin-right: 0;
        }

        .chat-image-link {
            display: inline-block;
            margin: 0 4px;
        }

        .chat-image-link img {
            width: 90px;
            height: 90px;
            border-radius: 12px;
            object-fit: cover;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        .message-input-wrapper {
            background: #fff;
            border-radius: 14px;
            padding: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
        }

        .selected-file-preview {
            display: none;
            margin-bottom: 8px;
        }

        .preview-box {
            position: relative;
            display: inline-block;
            background: #f7f9fb;
            border: 1px solid #e4eaee;
            border-radius: 12px;
            padding: 8px;
            max-width: 180px;
        }

        .remove-preview-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 22px;
            height: 22px;
            border: none;
            border-radius: 50%;
            background: #dc3545;
            color: #fff;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .message-input {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-input input[type="text"] {
            flex: 1;
            padding: 10px 14px;
            border-radius: 24px;
            border: 1px solid #dce5eb;
            font-size: 13px;
            outline: none;
        }

        .message-input button,
        .message-input label {
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 50%;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0;
            border: none;
        }

        #send-message {
            background: #0d6efd;
            color: #fff;
        }

        #file-label-btn {
            background: #f0ad4e;
            color: #fff;
            cursor: pointer;
        }

        #record-btn {
            background: #e74c3c;
            color: #fff;
        }

        #record-btn.recording {
            background: #28a745;
        }

        .recording-status {
            display: none;
            font-size: 12px;
            color: #dc3545;
            font-weight: 700;
        }

        .recording-status.active {
            display: inline-block;
        }

        .file-thumb-img {
            width: 90px;
            height: 90px;
            border-radius: 8px;
            object-fit: cover;
        }

        .file-thumb-video {
            width: 120px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .file-name-box {
            padding: 8px 12px;
            background: #e9ecef;
            border-radius: 8px;
            font-size: 12px;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            body {
                overflow: auto;
            }

            #frame {
                width: 100%;
                max-width: 100%;
                height: 100vh;
                margin: 0;
                border-radius: 0;
                flex-direction: column;
            }

            #sidepanel {
                width: 100%;
                min-width: 100%;
                max-height: 34vh;
                padding: 10px;
            }

            .content {
                width: 100%;
                height: 66vh;
                padding: 10px;
            }

            .contact-profile {
                padding: 10px;
                margin-bottom: 6px;
            }

            .chat-header-actions {
                width: 100%;
                justify-content: space-between;
            }

            .messages {
                padding: 10px 8px 5px 8px;
                margin-bottom: 6px;
            }

            .messages ul li p {
                max-width: 78%;
                font-size: 13px;
            }

            .message-input {
                flex-wrap: wrap;
            }

            .message-input input[type="text"] {
                width: 100%;
                flex: 0 0 100%;
                margin-bottom: 4px;
            }

            .chat-image-link img {
                width: 80px;
                height: 80px;
            }
        }

        @media (max-width: 480px) {
            #profile p {
                font-size: 14px;
            }

            .contact-top-row .name {
                font-size: 13px;
            }

            .preview {
                font-size: 11px;
            }

            .contact-profile-left p {
                font-size: 14px;
            }

            .chat-header-actions .form-check {
                font-size: 12px;
            }

            #delete-selected {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>
    <div id="frame">
        <div id="sidepanel">
            <div id="profile">
                {!! userAvatar(auth()->user(), 42) !!}
                <p>{{ auth()->user()->name }}</p>
            </div>

            <span>gggggggggg</span>

            <div id="search">
                <input type="text" id="contact-search" placeholder="Search contacts...">
            </div>

            <div id="contacts">
                <ul id="contacts-list">
                    @foreach ($sortedUsers as $user)
                        <li class="contact {{ isset($otherUser) && $otherUser && $otherUser->id == $user->id ? 'active-contact' : '' }}"
                            data-name="{{ strtolower($user->name) }}" data-user-id="{{ $user->id }}"
                            data-conversation-id="{{ $user->chat_conversation?->id }}"
                            onclick="window.location.href='{{ route('chat.startConversation', $user->id) }}'">
                            <div class="contact-left">
                                {!! userAvatar($user, 42) !!}

                                <div class="meta user_overview">
                                    <div class="contact-top-row">
                                        <h6 class="name">{{ $user->name }}</h6>

                                        <span class="unread-badge"
                                            style="{{ $user->unread_count > 0 ? '' : 'display:none;' }}">
                                            {{ $user->unread_count > 9 ? '9+' : $user->unread_count }}
                                        </span>
                                    </div>

                                    <p class="preview">{{ $user->preview_text }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="content">
            @if ($conversation)
                @php
                    $otherUserId =
                        $conversation->user_1_id == auth()->id() ? $conversation->user_2_id : $conversation->user_1_id;

                    $otherUser = \App\Models\User::find($otherUserId);
                @endphp

                <div class="contact-profile">
                    <div class="contact-profile-left">
                        @if ($otherUser)
                            {!! userAvatar($otherUser, 44) !!}
                            <p>{{ $otherUser->name }}</p>
                        @else
                            <p>No user available in this conversation.</p>
                        @endif
                    </div>

                    <div class="chat-header-actions">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="select-all-messages">
                            <label class="form-check-label ml-2" for="select-all-messages">Select All</label>
                        </div>

                        <button type="button" id="delete-selected" class="btn btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="messages" id="chat-messages">
                    <ul id="messages-list">
                        @foreach ($conversation->messages as $message)
                            <li class="{{ $message->user->id == auth()->id() ? 'sent' : 'replies' }}"
                                data-message-id="{{ $message->id }}">
                                <div class="form-check mb-3" style="display: inline-flex;">
                                    <input type="checkbox" class="form-check-input message-select"
                                        value="{{ $message->id }}">
                                </div>

                                <div>
                                    {!! userAvatar($message->user, 30) !!}
                                </div>

                                @if ($message->message)
                                    <div style="{{ $message->user->id == auth()->id() ? 'text-align:right;' : '' }}">
                                        <p style="display: grid-lanes; text-align:left;">{{ $message->message }}</p>
                                        @if ($message->user->id == auth()->id())
                                            <div class="message-read-status"
                                                data-message-id="{{ $message->id }}"
                                                style="font-size:12px; margin-top:4px; color:{{ !empty($message->is_read) ? '#2196f3' : '#6c757d' }};">
                                                @if (!empty($message->is_read))
                                                    <i class="fa fa-check-double"></i>
                                                @else
                                                    <i class="fa fa-check"></i>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if ($message->file_path)
                                    @php
                                        $ext = strtolower(pathinfo($message->file_path, PATHINFO_EXTENSION));
                                    @endphp

                                    @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                        <div style="{{ $message->user->id == auth()->id() ? 'text-align:right;' : '' }}">
                                            <a href="{{ asset($message->file_path) }}" target="_blank"
                                                class="chat-image-link">
                                                <img src="{{ asset($message->file_path) }}" alt="Image">
                                            </a>
                                            @if ($message->user->id == auth()->id() && !$message->message)
                                                <div class="message-read-status"
                                                    data-message-id="{{ $message->id }}"
                                                    style="font-size:12px; margin-top:4px; color:{{ !empty($message->is_read) ? '#2196f3' : '#6c757d' }};">
                                                    @if (!empty($message->is_read))
                                                        <i class="fa fa-check-double"></i>
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @elseif(in_array($ext, ['mp4', 'avi', 'mkv', 'webm']))
                                        <div style="{{ $message->user->id == auth()->id() ? 'text-align:right;' : '' }}">
                                            <video width="220" height="160" controls
                                                style="border-radius: 10px; margin: 0 6px;">
                                                <source src="{{ asset($message->file_path) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                            @if ($message->user->id == auth()->id() && !$message->message)
                                                <div class="message-read-status"
                                                    data-message-id="{{ $message->id }}"
                                                    style="font-size:12px; margin-top:4px; color:{{ !empty($message->is_read) ? '#2196f3' : '#6c757d' }};">
                                                    @if (!empty($message->is_read))
                                                        <i class="fa fa-check-double"></i>
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @elseif(in_array($ext, ['mp3', 'ogg', 'wav']))
                                        <div style="{{ $message->user->id == auth()->id() ? 'text-align:right;' : '' }}">
                                            <audio controls style="margin: 0 6px;">
                                                <source src="{{ asset($message->file_path) }}">
                                                Your browser does not support the audio element.
                                            </audio>
                                            @if ($message->user->id == auth()->id() && !$message->message)
                                                <div class="message-read-status"
                                                    data-message-id="{{ $message->id }}"
                                                    style="font-size:12px; margin-top:4px; color:{{ !empty($message->is_read) ? '#2196f3' : '#6c757d' }};">
                                                    @if (!empty($message->is_read))
                                                        <i class="fa fa-check-double"></i>
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div style="{{ $message->user->id == auth()->id() ? 'text-align:right;' : '' }}">
                                            <a href="{{ asset($message->file_path) }}" download="{{ $message->file_name ?? basename($message->file_path) }}"
                                                style="margin: 0 6px;">Download File</a>
                                            @if ($message->user->id == auth()->id() && !$message->message)
                                                <div class="message-read-status"
                                                    data-message-id="{{ $message->id }}"
                                                    style="font-size:12px; margin-top:4px; color:{{ !empty($message->is_read) ? '#2196f3' : '#6c757d' }};">
                                                    @if (!empty($message->is_read))
                                                        <i class="fa fa-check-double"></i>
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="message-input-wrapper">
                    <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div id="selected-file-preview" class="selected-file-preview">
                            <div class="preview-box">
                                <button type="button" class="remove-preview-btn" id="remove-preview-btn">
                                    <i class="fa fa-times"></i>
                                </button>
                                <div id="file-preview-content"></div>
                            </div>
                        </div>

                        <div class="message-input">
                            <input type="text" id="message-input" name="message" placeholder="Write your message..."
                                class="form-control">

                            <input type="file" id="file-upload" name="file" style="display: none;">

                            <input type="hidden" id="audio-file" name="audio_file" value="">

                            <button type="submit" id="send-message" class="btn">
                                <i class="fa fa-paper-plane"></i>
                            </button>

                            <label for="file-upload" class="btn" id="file-label-btn">
                                <i class="fa fa-paperclip"></i>
                            </label>

                            <button type="button" id="record-btn" class="btn">
                                <i class="fa fa-microphone"></i>
                            </button>

                            <span id="recording-status" class="recording-status">Recording...</span>
                        </div>
                    </form>
                </div>
            @else
                <div class="card border-0 shadow-sm h-100">
                    <div
                        class="card-body d-flex flex-column align-items-center justify-content-center text-center py-5 px-4">
                        <div class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="width: 110px; height: 110px; background-color: rgba(0, 0, 207, 0.1);">
                            <i class="fas fa-comments text-success" style="font-size: 42px;"></i>
                        </div>

                        <h2 class="font-weight-bold text-dark mb-2">Welcome to Chat</h2>
                        <div class="bg-success rounded-pill mb-4" style="width: 70px; height: 4px;"></div>

                        <p class="text-muted mb-4">
                            Select a conversation from the left to start messaging
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chat-messages');
        const messagesList = document.getElementById('messages-list');
        const fileInput = document.getElementById('file-upload');
        const selectedFilePreview = document.getElementById('selected-file-preview');
        const filePreviewContent = document.getElementById('file-preview-content');
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const conversationId = @json($conversation ? $conversation->id : '');
        const currentUserId = @json(auth()->id());
        const currentUserAvatar = @json(userAvatar(auth()->user(), 30));
        const otherUserAvatar = @json(isset($otherUser) && $otherUser ? userAvatar($otherUser, 30) : '');

        function scrollChatToBottom() {
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        function escapeHtml(text) {
            return $('<div>').text(text || '').html();
        }

        function getMessageStatusHtml(messageId, isRead = 0) {
            const icon = parseInt(isRead) === 1 ? 'fa-check-double' : 'fa-check';
            const color = parseInt(isRead) === 1 ? '#2196f3' : '#6c757d';

            return `<div class="message-read-status" data-message-id="${messageId}" style="font-size:12px; margin-top:4px; color:${color};"><i class="fa ${icon}"></i></div>`;
        }

        function createFilePreviewFromUrl(fileUrl, extension, messageId = '', isRead = 0, isOwn = true) {
            if (!fileUrl || !extension) return '';

            extension = extension.toLowerCase();
            const statusHtml = isOwn ? getMessageStatusHtml(messageId, isRead) : '';
            const alignStyle = isOwn ? 'text-align:right;' : '';

            if (['jpg', 'jpeg', 'png'].includes(extension)) {
                return `
                    <div style="${alignStyle}">
                        <a href="${fileUrl}" target="_blank" class="chat-image-link">
                            <img src="${fileUrl}" alt="Image">
                        </a>
                        ${statusHtml}
                    </div>
                `;
            }

            if (['mp4', 'avi', 'mkv', 'webm'].includes(extension)) {
                return `
                    <div style="${alignStyle}">
                        <video width="220" height="160" controls style="border-radius: 10px; margin: 0 6px;">
                            <source src="${fileUrl}">
                            Your browser does not support the video tag.
                        </video>
                        ${statusHtml}
                    </div>
                `;
            }

            if (['mp3', 'ogg', 'wav'].includes(extension)) {
                return `
                    <div style="${alignStyle}">
                        <audio controls style="margin: 0 6px;">
                            <source src="${fileUrl}">
                            Your browser does not support the audio element.
                        </audio>
                        ${statusHtml}
                    </div>
                `;
            }

            return `
                <div style="${alignStyle}">
                    <a href="${fileUrl}" download style="margin: 0 6px;">Download File</a>
                    ${statusHtml}
                </div>
            `;
        }

        function appendMessageToChat(messageText = '', fileUrl = '', extension = '', messageId = '', isRead = 0) {
            const safeMessage = escapeHtml(messageText);
            const filePreview = createFilePreviewFromUrl(fileUrl, extension, messageId, isRead, true);

            const html = `
                <li class="sent" data-message-id="${messageId}">
                    <div class="form-check" style="display: inline-flex;">
                        <input type="checkbox" class="form-check-input message-select" value="${messageId}">
                    </div>
                    <div>${currentUserAvatar}</div>
                    ${safeMessage ? `
                        <div style="text-align:right;">
                            <p>${safeMessage}</p>
                            ${getMessageStatusHtml(messageId, isRead)}
                        </div>
                    ` : ''}
                    ${filePreview}
                </li>
            `;

            messagesList.insertAdjacentHTML('beforeend', html);
            bindMessageCheckboxEvents();
            syncSelectAllState();
            scrollChatToBottom();
        }

        function appendIncomingMessage(messageText = '', fileUrl = '', extension = '', messageId = '') {
            const safeMessage = escapeHtml(messageText);
            const filePreview = createFilePreviewFromUrl(fileUrl, extension, messageId, 0, false);

            const html = `
                <li class="replies" data-message-id="${messageId}">
                    <div class="form-check mb-3" style="display: inline-flex;">
                        <input type="checkbox" class="form-check-input message-select" value="${messageId}">
                    </div>
                    <div>${otherUserAvatar}</div>
                    ${safeMessage ? `<p>${safeMessage}</p>` : ''}
                    ${filePreview}
                </li>
            `;

            messagesList.insertAdjacentHTML('beforeend', html);
            bindMessageCheckboxEvents();
            syncSelectAllState();
            scrollChatToBottom();
        }

        function clearFilePreview() {
            if (fileInput) {
                fileInput.value = '';
            }

            if (selectedFilePreview) {
                selectedFilePreview.style.display = 'none';
            }

            if (filePreviewContent) {
                filePreviewContent.innerHTML = '';
            }
        }

        function renderSelectedFilePreview(file) {
            if (!file) {
                clearFilePreview();
                return;
            }

            const fileName = file.name.toLowerCase();
            const extension = fileName.split('.').pop();

            selectedFilePreview.style.display = 'block';

            if (['jpg', 'jpeg', 'png'].includes(extension)) {
                const imageUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `<img src="${imageUrl}" alt="Preview" class="file-thumb-img">`;
            } else if (['mp4', 'avi', 'mkv', 'webm'].includes(extension)) {
                const videoUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <video controls class="file-thumb-video">
                        <source src="${videoUrl}">
                        Your browser does not support the video tag.
                    </video>
                `;
            } else if (['mp3', 'ogg', 'wav'].includes(extension)) {
                const audioUrl = URL.createObjectURL(file);
                filePreviewContent.innerHTML = `
                    <audio controls style="width: 150px;">
                        <source src="${audioUrl}">
                        Your browser does not support the audio element.
                    </audio>
                `;
            } else {
                filePreviewContent.innerHTML = `<div class="file-name-box">${escapeHtml(file.name)}</div>`;
            }
        }

        function syncSelectAllState() {
            const allCheckbox = $('#select-all-messages');
            const checkboxes = $('.message-select');
            const checked = $('.message-select:checked');

            if (!checkboxes.length) {
                allCheckbox.prop('checked', false).prop('indeterminate', false);
                return;
            }

            if (checked.length === 0) {
                allCheckbox.prop('checked', false).prop('indeterminate', false);
            } else if (checked.length === checkboxes.length) {
                allCheckbox.prop('checked', true).prop('indeterminate', false);
            } else {
                allCheckbox.prop('checked', false).prop('indeterminate', true);
            }
        }

        function bindMessageCheckboxEvents() {
            $('.message-select').off('change').on('change', function() {
                syncSelectAllState();
            });
        }

        function setRecordingUI(isRecording) {
            if (isRecording) {
                $('#record-btn').addClass('recording');
                $('#recording-status').addClass('active');
                $('#record-btn i').removeClass('fa-microphone').addClass('fa-stop');
            } else {
                $('#record-btn').removeClass('recording');
                $('#recording-status').removeClass('active');
                $('#record-btn i').removeClass('fa-stop').addClass('fa-microphone');
            }
        }

        function getPreviewTextFromEvent(message) {
            if (message.message) {
                return message.message.length > 30 ? message.message.substring(0, 30) + '...' : message.message;
            }

            if (message.file_path || message.file_url) {
                const ext = (message.extension || '').toLowerCase();

                if (['jpg', 'jpeg', 'png'].includes(ext)) return '📷 Photo';
                if (['mp4', 'avi', 'mkv', 'webm'].includes(ext)) return '🎥 Video';
                if (['mp3', 'ogg', 'wav'].includes(ext)) return '🎤 Voice message';
                return '📎 File';
            }

            return 'No messages yet.';
        }

        function moveContactToTop(contactItem) {
            const contactsList = document.getElementById('contacts-list');
            if (contactsList && contactItem) {
                contactsList.prepend(contactItem);
            }
        }

        function updateSidebarLive(messageData) {
            const contactItem = document.querySelector(
                '#contacts-list .contact[data-conversation-id="' + messageData.conversation_id + '"]'
            );

            if (!contactItem) return;

            const previewEl = contactItem.querySelector('.preview');
            const badgeEl = contactItem.querySelector('.unread-badge');
            const isActiveConversation = String(messageData.conversation_id) === String(conversationId);

            if (previewEl) {
                previewEl.textContent = getPreviewTextFromEvent(messageData);
            }

            if (parseInt(messageData.user_id) !== parseInt(currentUserId) && !isActiveConversation && badgeEl) {
                let currentCount = parseInt(badgeEl.textContent) || 0;
                currentCount++;
                badgeEl.style.display = 'inline-flex';
                badgeEl.textContent = currentCount > 9 ? '9+' : currentCount;
            }

            if (isActiveConversation && badgeEl) {
                badgeEl.style.display = 'none';
                badgeEl.textContent = '0';
            }

            moveContactToTop(contactItem);
        }

        function updateMessageReadStatusesFromHtml(doc) {
            const updatedStatuses = doc.querySelectorAll('.message-read-status');
            updatedStatuses.forEach(function(statusEl) {
                const messageId = statusEl.getAttribute('data-message-id');
                const currentEl = document.querySelector('.message-read-status[data-message-id="' + messageId + '"]');
                if (currentEl) {
                    currentEl.outerHTML = statusEl.outerHTML;
                }
            });
        }

        function refreshCurrentChatWithoutReload() {
            if (!conversationId) return;

            fetch(window.location.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newMessages = doc.querySelectorAll('#messages-list li');
                    newMessages.forEach(function(newMessage) {
                        const messageId = newMessage.getAttribute('data-message-id');
                        if (!document.querySelector('#messages-list li[data-message-id="' + messageId + '"]')) {
                            messagesList.insertAdjacentHTML('beforeend', newMessage.outerHTML);
                        }
                    });

                    updateMessageReadStatusesFromHtml(doc);
                    bindMessageCheckboxEvents();
                    syncSelectAllState();
                    scrollChatToBottom();
                })
                .catch(error => {
                    console.log('Chat refresh error:', error);
                });
        }

        scrollChatToBottom();
        bindMessageCheckboxEvents();
        syncSelectAllState();

        $('#file-upload').on('change', function() {
            const file = this.files[0];
            renderSelectedFilePreview(file);
        });

        $('#remove-preview-btn').on('click', function() {
            clearFilePreview();
        });

        $('#select-all-messages').on('change', function() {
            $('.message-select').prop('checked', $(this).is(':checked'));
            syncSelectAllState();
        });

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            let messageText = $('#message-input').val().trim();
            let selectedFile = fileInput ? fileInput.files[0] : null;

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
                    let isRead = 0;

                    if (response && typeof response === 'object') {
                        fileUrl = response.file_url || response.file_path || '';
                        extension = response.extension || '';
                        messageId = response.message_id || response.id || '';
                        isRead = response.is_read || 0;

                        if (!extension && selectedFile) {
                            let parts = selectedFile.name.split('.');
                            extension = parts.length > 1 ? parts.pop() : '';
                        }
                    } else if (selectedFile) {
                        let parts = selectedFile.name.split('.');
                        extension = parts.length > 1 ? parts.pop() : '';
                    }

                    appendMessageToChat(messageText, fileUrl, extension, messageId, isRead);

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
        let recordingState = false;

        $('#record-btn').on('click', function(e) {
            e.preventDefault();

            if (!recordingState) {
                navigator.mediaDevices.getUserMedia({
                    audio: true
                }).then(function(stream) {
                    mediaRecorder = new MediaRecorder(stream);
                    audioChunks = [];

                    mediaRecorder.ondataavailable = function(event) {
                        audioChunks.push(event.data);
                    };

                    mediaRecorder.onstop = function() {
                        let audioBlob = new Blob(audioChunks, {
                            type: 'audio/wav'
                        });

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
                                let isRead = 0;

                                if (response && typeof response === 'object') {
                                    fileUrl = response.file_url || response.file_path || '';
                                    extension = response.extension || 'wav';
                                    messageId = response.message_id || response.id || '';
                                    isRead = response.is_read || 0;
                                }

                                appendMessageToChat('', fileUrl, extension, messageId, isRead);
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
                    setRecordingUI(true);
                }).catch(function(error) {
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
            setRecordingUI(false);
        }

        $('#delete-selected').on('click', function() {
            let selectedMessages = [];

            $('.message-select:checked').each(function() {
                selectedMessages.push($(this).val());
            });

            if (selectedMessages.length === 0) {
                alert('Please select at least one message to delete.');
                return;
            }

            if (!confirm('Are you sure you want to delete selected messages?')) {
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
                        $('.message-select[value="' + messageId + '"]').closest('li').remove();
                    });

                    syncSelectAllState();
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

        if (typeof window.Echo !== 'undefined') {
            window.Echo.channel('chat')
                .listen('.message.sent', function(e) {
                    const message = e.message || e;

                    updateSidebarLive(message);

                    if (String(message.conversation_id) === String(conversationId) &&
                        parseInt(message.user_id) !== parseInt(currentUserId)) {

                        if (!document.querySelector('#messages-list li[data-message-id="' + (message.id || message.message_id || '') + '"]')) {
                            appendIncomingMessage(
                                message.message || '',
                                message.file_path || message.file_url || '',
                                message.extension || '',
                                message.id || message.message_id || ''
                            );
                        }
                    }
                });
        }

        function refreshSidebarWithoutReload() {
            fetch(window.location.href, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');

                    const newContactsList = doc.querySelector('#contacts-list');
                    const currentContactsList = document.querySelector('#contacts-list');

                    if (newContactsList && currentContactsList) {
                        currentContactsList.innerHTML = newContactsList.innerHTML;
                    }
                })
                .catch(error => {
                    console.log('Sidebar refresh error:', error);
                });
        }

        setInterval(function() {
            refreshSidebarWithoutReload();
            refreshCurrentChatWithoutReload();
        }, 3000);
        
    </script>
    
</body>

</html>


@endsection