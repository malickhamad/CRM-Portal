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
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        
        $conversations = Conversation::where('user_1_id', auth()->id())
            ->orWhere('user_2_id', auth()->id())
            ->get();

        return view('backend.chat.index', compact('conversations', 'users'));
    }

    // Start a new conversation between two users
    public function startConversation($userId)
    {
        $user = User::findOrFail($userId);

        $conversation = Conversation::where(function($query) use ($user) {
            $query->where('user_1_id', auth()->id())
                  ->where('user_2_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('user_1_id', $user->id)
                  ->where('user_2_id', auth()->id());
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_1_id' => auth()->id(),
                'user_2_id' => $user->id,
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    // Show the messages for a specific conversation
    public function showConversation($conversationId)
    {
        $conversation = Conversation::with('messages.user')->findOrFail($conversationId);
        return view('backend.chat.show', compact('conversation'));
    }

    // Send a message in a conversation

public function sendMessage(Request $request, $conversationId)
{
    // Validate the text message and files
    $request->validate([
        'message' => 'nullable|string|max:255',
        'file' => 'nullable|mimes:jpeg,jpg,png,mp4,mp3,avi,mkv|max:10240', // Validate media files (max 10MB)
    ]);

    $filePath = null;
    $fileName = null;
    $fileType = null;

    // Define the directory path in the public folder
    $directory = 'chat_files';
    $publicPath = public_path($directory);

    // Check if the chat_files directory exists inside the public directory, if not, create it
    if (!file_exists($publicPath)) {
        mkdir($publicPath, 0777, true); // Create directory with permissions
    }

    // Handle the file upload if present
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        
        // Generate a unique file name to avoid overwriting files
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Store the file in the public/chat_files folder
        $filePath = $directory . '/' . $fileName;
        // dd($filePath);

        $file->move($publicPath, $fileName); // Move the file to the public folder

        // Store the file type (MIME type) in the database
        $fileType = $file->getClientMimeType();
        // dd($fileType);
    }

    // Create the message with or without media
    $message = Message::create([
        'conversation_id' => $conversationId,
        'user_id' => auth()->id(),
        'message' => $request->message,  // The text message
        'file_path' => $filePath,  // Save the file path (if any)
        'file_name' => $fileName,  // Save the file name (if any)
        'file_type' => $fileType,  // Save the file type (if any)
    ]);

    // Broadcast the message in real-time
    broadcast(new MessageSent($message));

    return back();
}
}