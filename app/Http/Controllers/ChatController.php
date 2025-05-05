<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // public function show(Request $request, $service_request_id)
    // {
    //     $serviceRequest = ServiceRequest::findOrFail($service_request_id);

    //     // Authorization: Ensure the logged-in user is either the requester or the provider
    //     if ($serviceRequest->user_id !== Auth::id() && $serviceRequest->provider_id !== Auth::id()) {
    //         abort(403, 'Unauthorized to view this chat.');
    //     }

    //     $messages = Message::where('service_request_id', $service_request_id)
    //         ->orderBy('created_at')
    //         ->get();

    //     // Mark messages as read for the current user
    //     Message::where('service_request_id', $service_request_id)
    //         ->where('sender_id', '!=', Auth::id())
    //         ->whereNull('read_at')
    //         ->update(['read_at' => now()]);

    //     // Fetch the other participant's information for display
    //     $otherParticipant = null;
    //     if (Auth::user()->role === 'user') {
    //         $otherParticipant = $serviceRequest->provider;
    //     } elseif (Auth::user()->role === 'provider') {
    //         $otherParticipant = $serviceRequest->user;
    //     }

    //     return view('chat.show', compact('serviceRequest', 'messages', 'otherParticipant'));
    // }
    // public function show(Request $request, $service_request_id)
    // {
    //     $serviceRequest = ServiceRequest::findOrFail($service_request_id);

    //     if ($serviceRequest->user_id !== Auth::id() && $serviceRequest->provider_id !== Auth::id()) {
    //         abort(403, 'Unauthorized to view this chat.');
    //     }

    //     $messages = Message::where('service_request_id', $service_request_id)
    //         ->orderBy('created_at')
    //         ->get();

    //     Message::where('service_request_id', $service_request_id)
    //         ->where('sender_id', '!=', Auth::id())
    //         ->whereNull('read_at')
    //         ->update(['read_at' => now()]);

    //     $otherParticipant = null;
    //     if (Auth::user()->role === 'Customer') {
    //         $otherParticipant = $serviceRequest->provider;
    //         return view('chat.user', compact('serviceRequest', 'messages', 'otherParticipant'));
    //     } elseif (Auth::user()->role === 'Service-provider') {
    //         $otherParticipant = $serviceRequest->user;
    //         return view('chat.provider', compact('serviceRequest', 'messages', 'otherParticipant'));
    //     }

    //     // Fallback in case of unknown role
    //     abort(403, 'Unauthorized access.');
    // }



    public function show(Request $request, $service_request_id)
    {
        $serviceRequest = ServiceRequest::findOrFail($service_request_id);

        // Authorization: Ensure the logged-in user is either the requester or the provider
        if ($serviceRequest->user_id !== Auth::id() && $serviceRequest->provider_id !== Auth::id()) {
            abort(403, 'Unauthorized to view this chat.');
        }

        $messages = Message::where('service_request_id', $service_request_id)
            ->orderBy('created_at')
            ->get();

        // Mark messages as read for the current user
        Message::where('service_request_id', $service_request_id)
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        // Fetch the other participant's information for display
        $otherParticipant = null;
        $provider = null; // Initialize $provider

        if (Auth::user()->role === 'Customer') {
            $otherParticipant = $serviceRequest->provider;
            // For the user view, we might still need provider info
            $provider = $serviceRequest->provider;
            return view('chat.user', compact('serviceRequest', 'messages', 'otherParticipant', 'provider'));
        } elseif (Auth::user()->role === 'Service-provider') {
            $otherParticipant = $serviceRequest->user;
            // For the provider view, the logged-in user is the provider
            $provider = Auth::user();
            return view('chat.provider', compact('serviceRequest', 'messages', 'otherParticipant', 'provider'));
        }

        // Fallback in case of unknown role
        abort(403, 'Unauthorized access.');
    }






    public function sendMessage(Request $request, $service_request_id)
    {
        $serviceRequest = ServiceRequest::findOrFail($service_request_id);

        // Authorization: Ensure the logged-in user is either the requester or the provider
        if ($serviceRequest->user_id !== Auth::id() && $serviceRequest->provider_id !== Auth::id()) {
            abort(403, 'Unauthorized to send messages in this chat.');
        }

        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        Message::create([
            'service_request_id' => $service_request_id,
            'sender_id' => Auth::id(),
            'sender_type' => Auth::user()->role === 'service-provider' ? 'Service-provider' : 'User',
            'message' => $request->input('message'),
        ]);

        return redirect()->route('chat.show', $service_request_id);
    }
}
