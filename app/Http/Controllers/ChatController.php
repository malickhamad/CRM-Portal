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

        if ($conversation) {
    $conversation->messages()
        ->where('user_id', '!=', auth()->id())
        ->where('is_read', 0)
        ->update(['is_read' => 1]);
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

        // dd($request->all());
        //   if ($request->hasFile('file')) {
        //         $file = $request->file('file');
        //         dd($file);
        //   }
        // Validate the text message and files
        $request->validate([
            'message' => 'nullable|string|max:255',
            'file' => 'nullable|mimes:jpeg,jpg,png,mp4,mp3,avi,mkv,wav,pdf,webm|max:10240', // Include webm for video files
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
            // dd('dddd  ddd');
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

        // dd('dddd  f f ddd');

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

        return response()->json([
            'success' => true,
            'id' => $message->id,
            'message_id' => $message->id,
            'message' => $message->message,
            'file_path' => $message->file_path ? asset($message->file_path) : null,
            'file_url' => $message->file_path ? asset($message->file_path) : null,
            'extension' => $message->file_path ? pathinfo($message->file_path, PATHINFO_EXTENSION) : null,
            'file_name' => $message->file_name,
            'file_type' => $message->file_type,
        ]);
    }




    public function deleteMultipleMessages(Request $request)
    {
        // Validate the request (ensure the message_ids are provided)
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:messages,id', // Ensure each ID exists in the messages table
        ]);

        // Get the message IDs from the request
        $messageIds = $request->message_ids;

        // Delete all selected messages
        Message::whereIn('id', $messageIds)->delete();

        return response()->json(['success' => true]);
    }
}
