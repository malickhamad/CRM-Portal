{{-- @extends('backend.layouts.app')

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
                                @foreach ($conversation->users as $user)
                                    @if ($user->id != auth()->id())
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </strong>
                        </div>
                        <div class="card-body" id="chat-box">
                            <!-- Display messages -->
                            @foreach ($conversation->messages as $message)
                                <div class="{{ $message->user->id == auth()->id() ? 'sent' : 'received' }}">
                                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}

                                    <!-- If there's a file, display it -->
                                    @if ($message->file_path)
                                        @if (in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                            <img src="{{ asset($message->file_path) }}" alt="Image"
                                                style="max-width: 100%; height: auto;">
                                        @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp4', 'avi', 'mkv']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset($message->file_path) }}"
                                                    type="video/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp3', 'ogg', 'wav']))
                                            <!-- Audio (Voice message) -->
                                            <audio controls>
                                                <source src="{{ asset($message->file_path) }}"
                                                    type="audio/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <a href="{{ asset($message->file_path) }}" download>Download File</a>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Text message input -->
                                <input type="text" id="chat-input" name="message" class="form-control"
                                    placeholder="Type a message">
                                <!-- Audio message input (hidden) -->
                                <input type="hidden" id="audio-file" name="audio_file" value="">

                                <button type="submit" class="btn btn-primary mt-2">Send</button>
                            </form>

                            <!-- Voice Message Recording -->
                            <button id="record-btn" class="btn btn-danger mt-2">Record Voice</button>
                            <audio id="audio-player" controls style="display: none;"></audio> <!-- Audio playback -->

                            <!-- File Upload Option -->
                            <input type="file" id="file-upload" name="file" class="form-control mt-2">
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
            // Variables for recording
            let mediaRecorder;
            let audioChunks = [];
            let audioBlob;
            let recordingState = false; // Track recording state

            // Get CSRF Token from the meta tag
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            // Start recording when the user clicks on the "Record Voice" button
            $('#record-btn').on('click', function() {
                console.log('Record button clicked');
                if (!recordingState) {
                    // Check if the user has permissions to access the microphone
                    navigator.mediaDevices.getUserMedia({
                            audio: true
                        })
                        .then(function(stream) {
                            console.log('Microphone access granted');
                            // Create a MediaRecorder to record the audio stream
                            mediaRecorder = new MediaRecorder(stream);

                            // When the recording stops, store the recorded audio in audioChunks
                            mediaRecorder.ondataavailable = function(event) {
                                audioChunks.push(event.data);
                                console.log('Audio data available');
                            };

                            // Once the recording stops, create a Blob from the audio data
                            mediaRecorder.onstop = function() {
                                console.log('Recording stopped');
                                audioBlob = new Blob(audioChunks, {
                                    type: 'audio/wav'
                                });

                                // Create an audio file URL to preview
                                let audioUrl = URL.createObjectURL(audioBlob);
                                $('#audio-player').attr('src', audioUrl).show(); // Show the audio player

                                // Create the FormData object and append the recorded audio file
                                let file = new File([audioBlob], 'voice_message.wav', {
                                    type: 'audio/wav'
                                });
                                let formData = new FormData();
                                formData.append('file', file);
                                formData.append('message', ''); // Add an empty message field

                                // Automatically submit the form with the audio file once the recording stops
                                $.ajax({
                                    url: '/chat/send/' + {{ $conversation->id }},
                                    method: 'POST',
                                    data: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken // Pass CSRF token here
                                    },
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        console.log(
                                            'Audio file uploaded and message sent successfully!'
                                            );
                                        $('#audio-file').val(response
                                        .file_path); // Update the hidden input with the file path
                                    },
                                    error: function(error) {
                                        console.log('Error sending the audio file:', error);
                                    }
                                });

                                // Reset button to allow new recording
                                resetRecordingState();
                            };

                            // Start recording the audio
                            mediaRecorder.start();
                            $(this).text('Stop Recording'); // Change button text to "Stop Recording"
                            $(this).removeClass('btn-danger').addClass('btn-success'); // Change button color
                            recordingState = true; // Update the recording state
                            console.log('Recording started');
                        })
                        .catch(function(error) {
                            console.log('Error accessing microphone:', error);
                        });
                } else {
                    // Stop recording when the button is clicked again
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                        $(this).text('Recording Stopped'); // Change button text to "Recording Stopped"
                        $(this).removeClass('btn-success').addClass('btn-warning'); // Change button color
                        console.log('Recording stopped manually');
                    }
                }
            });

            // Function to reset the recording state
            function resetRecordingState() {
                $('#record-btn').text('Record Voice').removeClass('btn-warning').removeClass('btn-success').addClass(
                    'btn-danger');
                recordingState = false;
                audioChunks = [];
                $('#audio-player').hide(); // Hide the audio player
            }
        </script>
    </main>
@endsection --}}







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
                                @foreach ($conversation->users as $user)
                                    @if ($user->id != auth()->id())
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </strong>
                        </div>
                        <div class="card-body" id="chat-box">
                            <!-- Display messages -->
                            @foreach ($conversation->messages as $message)
                                <div class="{{ $message->user->id == auth()->id() ? 'sent' : 'received' }}">

                                    <div class="form-check" style="display: inline-block; margin-right: 5px;">
                                        <input type="checkbox" class="form-check-input message-select"
                                            value="{{ $message->id }}">
                                    </div>
                                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}

                                    <!-- If there's a file, display it -->
                                    @if ($message->file_path)
                                        @if (in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                            <img src="{{ asset($message->file_path) }}" alt="Image"
                                                style="max-width: 100%; height: auto;">
                                        @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp4', 'avi', 'mkv']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset($message->file_path) }}"
                                                    type="video/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp3', 'ogg', 'wav']))
                                            <!-- Audio (Voice message) -->
                                            <audio controls>
                                                <source src="{{ asset($message->file_path) }}"
                                                    type="audio/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <a href="{{ asset($message->file_path) }}" download>Download File</a>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Text message input -->
                                <input type="text" id="chat-input" name="message" class="form-control"
                                    placeholder="Type a message">
                                <!-- Audio message input (hidden) -->
                                <input type="hidden" id="audio-file" name="audio_file" value="">
                                <input type="file" id="file-upload" name="file" class="form-control mt-2">

                                <button type="submit" class="btn btn-primary mt-2">Send</button>
                            </form>

                            <!-- Voice Message Recording -->
                            <button id="record-btn" class="btn btn-danger mt-2">Record Voice</button>
                            <audio id="audio-player" controls style="display: none;"></audio> <!-- Audio playback -->

                            <!-- File Upload Option -->
                            {{-- <input type="file" id="file-upload" name="file" class="form-control mt-2"> --}}

                        </div>
                        <button id="delete-selected" class="btn btn-danger mt-2">Delete Selected</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Include jQuery and Laravel Echo -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <script>
            $('#chat-form').on('submit', function(e) {
                e.preventDefault(); // Prevent form from submitting normally

                var formData = new FormData(this); // Create FormData object from the form

                // Use AJAX to submit the form data (including file)
                $.ajax({
                    url: $(this).attr('action'), // Submit to the form action URL
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    processData: false, // Prevent jQuery from transforming the data into a query string
                    contentType: false, // Prevent setting content type, letting FormData handle it
                    success: function(response) {
                        console.log('Message sent successfully');
                        // Optionally, you can append the new message to the chat UI here
                    },
                    error: function(xhr, status, error) {
                        console.log('Error sending message:', error);
                    }
                });
            });



            // Variables for recording
            let mediaRecorder;
            let audioChunks = [];
            let audioBlob;
            let recordingState = false; // Track recording state

            // Get CSRF Token from the meta tag
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            // Start recording when the user clicks on the "Record Voice" button
            $('#record-btn').on('click', function() {
                console.log('Record button clicked');
                if (!recordingState) {
                    // Check if the user has permissions to access the microphone
                    navigator.mediaDevices.getUserMedia({
                            audio: true
                        })
                        .then(function(stream) {
                            console.log('Microphone access granted');
                            // Create a MediaRecorder to record the audio stream
                            mediaRecorder = new MediaRecorder(stream);

                            // When the recording stops, store the recorded audio in audioChunks
                            mediaRecorder.ondataavailable = function(event) {
                                audioChunks.push(event.data);
                                console.log('Audio data available');
                            };

                            // Once the recording stops, create a Blob from the audio data
                            mediaRecorder.onstop = function() {
                                console.log('Recording stopped');
                                audioBlob = new Blob(audioChunks, {
                                    type: 'audio/wav'
                                });

                                // Create an audio file URL to preview
                                let audioUrl = URL.createObjectURL(audioBlob);
                                $('#audio-player').attr('src', audioUrl).show(); // Show the audio player

                                // Create the FormData object and append the recorded audio file
                                let file = new File([audioBlob], 'voice_message.wav', {
                                    type: 'audio/wav'
                                });
                                let formData = new FormData();
                                formData.append('file', file);
                                formData.append('message', ''); // Add an empty message field

                                // Automatically submit the form with the audio file once the recording stops
                                $.ajax({
                                    url: '/chat/send/' + {{ $conversation->id }},
                                    method: 'POST',
                                    data: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken // Pass CSRF token here
                                    },
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        console.log(
                                            'Audio file uploaded and message sent successfully!'
                                        );
                                        $('#audio-file').val(response
                                            .file_path
                                        ); // Update the hidden input with the file path
                                    },
                                    error: function(error) {
                                        console.log('Error sending the audio file:', error);
                                    }
                                });

                                // Reset button to allow new recording
                                resetRecordingState();
                            };

                            // Start recording the audio
                            mediaRecorder.start();
                            $(this).text('Stop Recording'); // Change button text to "Stop Recording"
                            $(this).removeClass('btn-danger').addClass('btn-success'); // Change button color
                            recordingState = true; // Update the recording state
                            console.log('Recording started');
                        })
                        .catch(function(error) {
                            console.log('Error accessing microphone:', error);
                        });
                } else {
                    // Stop recording when the button is clicked again
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                        $(this).text('Recording Stopped'); // Change button text to "Recording Stopped"
                        $(this).removeClass('btn-success').addClass('btn-warning'); // Change button color
                        console.log('Recording stopped manually');
                    }
                }
            });

            // Function to reset the recording state
            function resetRecordingState() {
                $('#record-btn').text('Record Voice').removeClass('btn-warning').removeClass('btn-success').addClass(
                    'btn-danger');
                recordingState = false;
                audioChunks = [];
                $('#audio-player').hide(); // Hide the audio player
            }



            $('#delete-selected').on('click', function() {
                // Get all selected message IDs
                let selectedMessages = [];
                $('input.message-select:checked').each(function() {
                    selectedMessages.push($(this).val());
                });

                // If no messages are selected, show an alert
                if (selectedMessages.length === 0) {
                    alert('Please select at least one message to delete.');
                    return;
                }

                // Send the selected message IDs to the server for deletion
                $.ajax({
                    url: '/chat/delete-messages', // Define the route for deleting messages
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        message_ids: selectedMessages
                    },
                    success: function(response) {
                        // On success, remove deleted messages from the DOM
                        selectedMessages.forEach(function(messageId) {
                            $('input.message-select[value="' + messageId + '"]').closest(
                                '.sent, .received').remove();
                        });
                        alert('Selected messages deleted successfully!');
                    },
                    error: function() {
                        alert('Error deleting selected messages.');
                    }
                });
            });
        </script>

        <style>
            /* Ensure checkboxes are aligned properly */
            .message-select {
                margin-right: 10px;
                /* Add margin for alignment */
            }

            .form-check {
                display: flex;
                align-items: center;
            }
        </style>
    </main>
@endsection





{{-- @extends('backend.layouts.app')

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
                                @foreach ($conversation->users as $user)
                                    @if ($user->id != auth()->id())
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </strong>
                        </div>
                        <div class="card-body" id="chat-box">
                            <!-- Display messages -->
                            @foreach ($conversation->messages as $message)
                                <div class="{{ $message->user->id == auth()->id() ? 'sent' : 'received' }}">
                                    <div class="form-check" style="display: inline-block; margin-right: 5px;">
                                        <input type="checkbox" class="form-check-input message-select"
                                            value="{{ $message->id }}">
                                    </div>

                                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}

                                    <!-- If there's a file, display it -->
                                    @if ($message->file_path)
                                        @if (in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                            <img src="{{ asset($message->file_path) }}" alt="Image"
                                                style="max-width: 100%; height: auto;">
                                        @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp4', 'avi', 'mkv']))
                                            <video width="320" height="240" controls>
                                                <source src="{{ asset($message->file_path) }}"
                                                    type="video/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif(in_array(pathinfo($message->file_path, PATHINFO_EXTENSION), ['mp3', 'ogg', 'wav']))
                                            <!-- Audio (Voice message) -->
                                            <audio controls>
                                                <source src="{{ asset($message->file_path) }}"
                                                    type="audio/{{ pathinfo($message->file_path, PATHINFO_EXTENSION) }}">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <a href="{{ asset($message->file_path) }}" download>Download File</a>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <form id="chat-form" method="POST" action="{{ route('chat.send', $conversation->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Text message input -->
                                <input type="text" id="chat-input" name="message" class="form-control"
                                    placeholder="Type a message">
                                <!-- Audio message input (hidden) -->
                                <input type="hidden" id="audio-file" name="audio_file" value="">

                                <button type="submit" class="btn btn-primary mt-2">Send</button>
                            </form>

                            <!-- Voice Message Recording -->
                            <button id="record-btn" class="btn btn-danger mt-2">Record Voice</button>
                            <audio id="audio-player" controls style="display: none;"></audio> <!-- Audio playback -->

                            <!-- File Upload Option -->
                            <input type="file" id="file-upload" name="file" class="form-control mt-2">
                        </div>

                        <button id="delete-selected" class="btn btn-danger mt-2">Delete Selected</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Include jQuery and Laravel Echo -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.3/dist/echo.js"></script>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

        <script>
            // Variables for recording
            let mediaRecorder;
            let audioChunks = [];
            let audioBlob;
            let recordingState = false; // Track recording state

            // Get CSRF Token from the meta tag
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            // Start recording when the user clicks on the "Record Voice" button
            $('#record-btn').on('click', function() {
                console.log('Record button clicked');
                if (!recordingState) {
                    // Check if the user has permissions to access the microphone
                    navigator.mediaDevices.getUserMedia({
                            audio: true
                        })
                        .then(function(stream) {
                            console.log('Microphone access granted');
                            // Create a MediaRecorder to record the audio stream
                            mediaRecorder = new MediaRecorder(stream);

                            // When the recording stops, store the recorded audio in audioChunks
                            mediaRecorder.ondataavailable = function(event) {
                                audioChunks.push(event.data);
                                console.log('Audio data available');
                            };

                            // Once the recording stops, create a Blob from the audio data
                            mediaRecorder.onstop = function() {
                                console.log('Recording stopped');
                                audioBlob = new Blob(audioChunks, {
                                    type: 'audio/wav'
                                });

                                // Create an audio file URL to preview
                                let audioUrl = URL.createObjectURL(audioBlob);
                                $('#audio-player').attr('src', audioUrl).show(); // Show the audio player

                                // Create the FormData object and append the recorded audio file
                                let file = new File([audioBlob], 'voice_message.wav', {
                                    type: 'audio/wav'
                                });
                                let formData = new FormData();
                                formData.append('file', file);
                                formData.append('message', ''); // Add an empty message field

                                // Automatically submit the form with the audio file once the recording stops
                                $.ajax({
                                    url: '/chat/send/' + {{ $conversation->id }},
                                    method: 'POST',
                                    data: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken // Pass CSRF token here
                                    },
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        console.log(
                                            'Audio file uploaded and message sent successfully!'
                                        );
                                        $('#audio-file').val(response
                                            .file_path
                                        ); // Update the hidden input with the file path
                                    },
                                    error: function(error) {
                                        console.log('Error sending the audio file:', error);
                                    }
                                });

                                // Reset button to allow new recording
                                resetRecordingState();
                            };

                            // Start recording the audio
                            mediaRecorder.start();
                            $(this).text('Stop Recording'); // Change button text to "Stop Recording"
                            $(this).removeClass('btn-danger').addClass('btn-success'); // Change button color
                            recordingState = true; // Update the recording state
                            console.log('Recording started');
                        })
                        .catch(function(error) {
                            console.log('Error accessing microphone:', error);
                        });
                } else {
                    // Stop recording when the button is clicked again
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                        $(this).text('Recording Stopped'); // Change button text to "Recording Stopped"
                        $(this).removeClass('btn-success').addClass('btn-warning'); // Change button color
                        console.log('Recording stopped manually');
                    }
                }
            });

            // Function to reset the recording state
            function resetRecordingState() {
                $('#record-btn').text('Record Voice').removeClass('btn-warning').removeClass('btn-success').addClass(
                    'btn-danger');
                recordingState = false;
                audioChunks = [];
                $('#audio-player').hide(); // Hide the audio player
            }

            <
            !--Include jQuery-- >

            // Handle deletion of selected messages
            $('#delete-selected').on('click', function() {
                // Get all selected message IDs
                let selectedMessages = [];
                $('input.message-select:checked').each(function() {
                    selectedMessages.push($(this).val());
                });

                // If no messages are selected, show an alert
                if (selectedMessages.length === 0) {
                    alert('Please select at least one message to delete.');
                    return;
                }

                // Send the selected message IDs to the server for deletion
                $.ajax({
                    url: '/chat/delete-messages', // Define the route for deleting messages
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        message_ids: selectedMessages
                    },
                    success: function(response) {
                        // On success, remove deleted messages from the DOM
                        selectedMessages.forEach(function(messageId) {
                            $('input.message-select[value="' + messageId + '"]').closest(
                                '.sent, .received').remove();
                        });
                        alert('Selected messages deleted successfully!');
                    },
                    error: function() {
                        alert('Error deleting selected messages.');
                    }
                });
            });
        </script>
        <style>
            /* Ensure checkboxes are aligned properly */
            .message-select {
                margin-right: 10px;
                /* Add margin for alignment */
            }

            .form-check {
                display: flex;
                align-items: center;
            }
        </style>

    </main>
@endsection --}}
