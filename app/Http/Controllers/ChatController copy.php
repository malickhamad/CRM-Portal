<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Fetch all conversations for the authenticated user
    public function index(Request $request)
    {
        // Get all users except the logged-in user
        $users = User::where('id', '!=', auth()->id())->get();

        // Fetch conversations for the authenticated user
        $conversations = Conversation::with('users', 'messages') // Eager load users and messages
            ->where('user_1_id', auth()->id())
            ->orWhere('user_2_id', auth()->id())
            ->get();

        // Fetch the conversation if it's provided in the request
        $conversation = null;
        if ($request->has('conversation_id')) {
            $conversation = Conversation::with('messages.user') // Eager load messages with users
                ->find($request->conversation_id);

            // If no conversation is found, return to the conversations list
            if (!$conversation) {
                return redirect()->route('chat');
            }
        }

        // Return the chat page with the conversations and users
        return view('backend.chat.index', compact('conversations', 'users', 'conversation'));
    }

    // Start a new conversation between two users
    public function startConversation($userId)
    {
        $user = User::findOrFail($userId);

        // Check if a conversation already exists between these two users
        $conversation = Conversation::where(function ($query) use ($user) {
            $query->where('user_1_id', auth()->id())
                ->where('user_2_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('user_1_id', $user->id)
                ->where('user_2_id', auth()->id());
        })->first();

        // If no conversation exists, create a new one
        if (!$conversation) {
            $conversation = Conversation::create([
                'user_1_id' => auth()->id(),
                'user_2_id' => $user->id,
            ]);
        }

        // Redirect to the chat page with the new conversation
        return redirect()->route('chat', ['conversation_id' => $conversation->id]);
    }

    // Send a message in a conversation
    public function sendMessage(Request $request, $conversationId)
    {
        // Validate the incoming message and file
        $request->validate([
            'message' => 'nullable|string|max:255',
            'file' => 'nullable|mimes:jpeg,jpg,png,mp4,mp3,avi,mkv,wav,pdf,webm|max:10240', // Allow files with specific extensions
        ]);

        $filePath = null;
        $fileName = null;
        $fileType = null;

        // Define the directory path in the public folder
        $directory = 'chat_files';
        $publicPath = public_path($directory);

        // Check if the chat_files directory exists inside the public directory, if not, create it
        if (!file_exists($publicPath)) {
            mkdir($publicPath, 0777, true); // Create the directory with appropriate permissions
        }

        // Handle the file upload if a file is present
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $directory . '/' . $fileName;

            // Move the uploaded file to the public directory
            $file->move($publicPath, $fileName);

            // Store the MIME type of the file in the database
            $fileType = $file->getClientMimeType();
        }

        // Create the message with or without a file
        $message = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => auth()->id(),
            'message' => $request->message,  // The message text
            'file_path' => $filePath,  // Save the file path if it exists
            'file_name' => $fileName,  // Save the file name if it exists
            'file_type' => $fileType,  // Save the file type if it exists
        ]);

        // Broadcast the message in real-time
        broadcast(new MessageSent($message));

        return back();
    }

    // Delete multiple selected messages
    public function deleteMultipleMessages(Request $request)
    {
        // Validate the request to ensure message IDs are provided
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id', // Ensure each message ID exists in the database
        ]);

        // Get the message IDs from the request
        $messageIds = $request->message_ids;

        // Delete the selected messages
        Message::whereIn('id', $messageIds)->delete();

        return response()->json(['success' => true]);
    }
}