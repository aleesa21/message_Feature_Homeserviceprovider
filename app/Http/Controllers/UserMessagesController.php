<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserMessagesController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $requests = ServiceRequest::where('user_id', $user->id) // Get your service requests
            ->with('provider:id,name')
            ->latest()
            ->get()
            ->map(function ($request) use ($user) {
                // Count messages in this service request's chat
                $unreadCount = Message::where('service_request_id', $request->id)
                    ->where('sender_id', '!=', $user->id) // That were NOT sent by you
                    ->whereNull('read_at')                 // And have not been read yet
                    ->count();

                $request->unread_count = $unreadCount; // Add this count to the service request data
                return $request;
            });

        return view('user.messages', compact('requests'));
    }
}