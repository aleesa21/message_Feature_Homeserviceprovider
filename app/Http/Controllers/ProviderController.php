<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\Feedback;


class ProviderController extends Controller
{
    public function dashboard($id)
    {
        // Get the provider's details from the users table
        $provider = User::where('id', $id)
            ->where('role', 'Service-provider')
            ->firstOrFail();

        return view('provider.providerdash', compact('provider'));
    }

    public function edit($id)
    {
        // Retrieve the provider's details
        $provider = User::findOrFail($id);

        // Pass the provider to the view
        return view('provider.providerprofileupdate', compact('provider'));
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        // Ensure the authenticated user is an instance of User
        if (!$user instanceof User) {
            return back()->withErrors(['error' => 'Invalid user model instance.']);
        }

        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string',
            'service_type' => 'required|array',  // Expecting an array for service types
            'service_type.*' => 'string',        // Each service type should be a string
            'photo' => 'nullable|image|mimes:jpg,png,jpegs'
        ]);

        // Convert service types array to JSON and store it
        $validatedData['service_type'] = json_encode($request->service_type);







        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }

            // Store the photo and get the relative path
            $photoPath = $request->file('photo')->store('profile_photos', 'public');

            // Store the relative path without the 'storage/' prefix
            $validatedData['photo'] = $photoPath; // This stores 'profile_photos/filename.jpg'
        }






        // Update the user's record with the validated data
        $user->update($validatedData);

        // Redirect to the dashboard with a success message
        return redirect()->route('pdash', ['id' => $user->id])->with('success', 'Profile updated successfully!');
    }
    public function review($providerId)
    {
        // Fetch provider
        $provider = User::findOrFail($providerId);

        // Fetch feedback for the provider
        $feedbacks = Feedback::where('provider_id', $providerId)->orderBy('created_at', 'desc')->get();

        // Return the provider.review view with data
        return view('provider.review', compact('provider', 'feedbacks'));
    }
    public function home()
    {
        // Get the currently authenticated provider
        $provider = Auth::user();

        // Fetch all other providers except the logged-in one
        $otherProviders = User::where('role', 'Service-provider')
            ->where('id', '!=', $provider->id) // Exclude logged-in user
            ->get();
        return view('provider.providerhome', compact('provider', 'otherProviders'));
    }
    public function otherproviderdetails($id)
    {
        $provider = User::findOrFail($id);
        return view('provider.otherproviderdetails', compact('provider'));
    }
    public function profileedit()
    {
        // Get the current logged-in user
        $user = Auth::user();  // This gets the authenticated user

        // Decode the service_type JSON into an array
        $serviceTypes = json_decode($user->service_type, true);

        // Return the view with user data and decoded service types
        return view('provider.profileupdate', compact('user', 'serviceTypes'));
    }
    public function profileupdate(Request $req)
    {
        // Validate the form inputs
        $req->validate([
            'service-type' => 'required|array|min:1',
            'service-type.*' => 'string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Handle photo upload if exists
        $photoPath = null;
        if ($req->hasFile('photo')) {
            $photoPath = $req->file('photo')->store('profile_photos', 'public');
        }

        // Get current logged-in user and find them in the database
        $user = User::find(Auth::id());  // This ensures $user is an Eloquent model

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Update the user's data
        $user->update([
            'service_type' => json_encode($req->input('service-type')), // Convert array to JSON  
            'photo' => $photoPath,
        ]);

        // Redirect back to the dashboard with a success message
        return redirect()->route('pdash', ['id' => $user->id])->with('success', 'Profile updated successfully');
    }
}
