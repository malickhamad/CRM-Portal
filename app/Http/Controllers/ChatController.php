<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;

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
        $request->validate(['message' => 'required|string|max:255']);

        $message = Message::create([
            'conversation_id' => $conversationId,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        // Broadcast the message in real-time
        broadcast(new MessageSent($message));

        return back();
    }
}