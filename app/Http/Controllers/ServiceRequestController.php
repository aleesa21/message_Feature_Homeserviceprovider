<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\User; // Assuming you'll have a User model for providers
use App\Models\ServiceRequest; // Assuming you'll have a ServiceRequest model
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function submitRequest(Request $request, $provider)
    {
        // 1. Validate the incoming request data
        $validatedData = $request->validate([
            'service_details' => 'required|string|max:500',
            'preferred_time' => 'nullable|date|after:now',
            'contact_info' => 'required|string|max:255',
        ]);

        // 2. Create a new ServiceRequest record
        $serviceRequest = new ServiceRequest();
        $serviceRequest->user_id = Auth::id();
        $serviceRequest->provider_id = $provider;
        $serviceRequest->service_details = $validatedData['service_details'];
        $serviceRequest->preferred_time = $validatedData['preferred_time'];
        $serviceRequest->contact_info = $validatedData['contact_info'];
        $serviceRequest->status = 'pending'; // Set initial status
        $serviceRequest->save();

        // 3. Optionally, notify the provider about the new request
        // You might use events, emails, or database notifications here

        // 4. Redirect the user back with a success message
        return redirect()->back()->with('success', 'Your service request has been submitted successfully!');
    }



    public function showProviderRequests()
    {
        $providerId = Auth::id();
        $provider = User::findOrFail($providerId); // Assuming providers are in the User model
        $serviceRequests = ServiceRequest::where('provider_id', $providerId)
                                        ->with('user')
                                        ->latest()
                                        ->get();
    
        return view('provider.servicerequests', compact('serviceRequests', 'provider'));
    }

//     public function show($id)
// {
//     $providerId = Auth::id();
//     $serviceRequest = ServiceRequest::where('id', $id)
//                                     ->where('provider_id', $providerId)
//                                     ->with('user')
//                                     ->firstOrFail();

//     return view('provider.show', compact('serviceRequest')); 
// }
public function show($id)
{
    $providerId = Auth::id();
    $serviceRequest = ServiceRequest::where('id', $id)
        ->where('provider_id', $providerId)
        ->with('user')
        ->firstOrFail();

    // Get the currently logged-in user, who is the provider
    $provider = Auth::user();

    return view('provider.show', compact('serviceRequest', 'provider'));
}



// public function acceptRequest(Request $request, $id)
//     {
//         $providerId = Auth::id();
//         $serviceRequest = ServiceRequest::where('id', $id)
//             ->where('provider_id', $providerId)
//             ->where('status', 'pending')
//             ->firstOrFail();

//         $serviceRequest->update(['status' => 'accepted']);

//         return redirect()->route('provider.requests.index')->with('success', 'Service request accepted successfully.');
//     }



public function acceptRequest(Request $request, $id)
{
    $providerId = Auth::id();
    $serviceRequest = ServiceRequest::where('id', $id)
        ->where('provider_id', $providerId)
        ->where('status', 'pending')
        ->firstOrFail();

    $serviceRequest->update(['status' => 'accepted']);

    return redirect()->route('chat.show', $id); // Redirect to the chat page
}

    public function rejectRequest(Request $request, $id)
    {
        $providerId = Auth::id();
        $serviceRequest = ServiceRequest::where('id', $id)
            ->where('provider_id', $providerId)
            ->where('status', 'pending')
            ->firstOrFail();

        $serviceRequest->update(['status' => 'rejected']);

        return redirect()->route('provider.requests.index')->with('success', 'Service request rejected successfully.');
    }
    // public function destroy(ServiceRequest $request)
    // {
    //     // Ensure the user owns the request before deleting
    //     if ($request->user_id !== Auth::id()) {
    //         return abort(403, 'Unauthorized action.');
    //     }

    //     // Perform the deletion
    //     $request->delete();

    //     // Redirect back to the user's messages page with a success message
    //     return redirect()->route('user.messages')->with('success', 'Service request deleted successfully.');
    // }

}