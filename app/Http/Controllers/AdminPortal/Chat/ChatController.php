<?php

namespace App\Http\Controllers\AdminPortal\Chat;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('theme.admin_portal.chat.all');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        try {
            // Fire the real-time event
            broadcast(new MessageSent($message))->toOthers();
    
            return response()->json([
                'status' => true,
                'message' => 'Message sent successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send message!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
