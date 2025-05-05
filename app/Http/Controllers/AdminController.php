<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback; // Import the User model

class AdminController extends Controller
{
    public function index()
    {
        // Fetch counts for each category
        $totalAdmins = User::where('role', 'Admin')->count(); // Total admins
        $totalProviders = User::where('role', 'Service-provider')->count(); // Total providers
        $totalUsers = User::where('role', 'Customer')->count(); // Total users

        // Count services by checking how many users have a non-null 'service_type' 
        $totalServices = User::whereNotNull('service_type')->count(); // Total services (non-null service_type)

        // Pass the counts to the view
        return view('admin.admindash', compact('totalAdmins', 'totalProviders', 'totalUsers', 'totalServices'));
    }

    public function show()
    {
        // Fetch only users with the role "Service-provider"
        $providers = User::where('role', 'Service-provider')->get();

        // Pass the providers to the view
        return view('admin.adminproprofile', compact('providers'));
    }
    public function review($providerId, $filter = null)
    {
        // Fetch the provider details
        $provider = User::findOrFail($providerId);

        // Fetch feedback for this provider
        $query = Feedback::where('provider_id', $providerId);

        // Apply filter if it's set
        if ($filter == 'bad') {
            $query->where('rating', '<=', 2); // Bad reviews
        } elseif ($filter == 'good') {
            $query->where('rating', '>=', 4); // Good reviews
        } elseif ($filter == 'neutral') {
            $query->where('rating', '=', 3); // Neutral reviews
        }

        // Fetch the filtered reviews
        $feedbacks = $query->orderBy('created_at', 'desc')->get();

        // Return the view with the provider and filtered reviews
        return view('admin.adminproreview', compact('provider', 'feedbacks'));
    }

    public function deleteProvider($providerId)
    {
        // Find the provider by ID and delete
        $provider = User::findOrFail($providerId);
        $provider->delete();

        // Redirect back with a success message
        return redirect()->route('adashpprofile')->with('success', 'Provider deleted successfully!');
    }
    public function user()
    {
        // Fetch only users with the role "Service-provider"
        $providers = User::where('role', 'Customer')->get();

        // Pass the providers to the view
        return view('admin.adminuser', compact('providers'));
    }
    public function deleteUser($providerId)
    {
        // Find the provider by ID and delete
        $provider = User::findOrFail($providerId);
        $provider->delete();

        // Redirect back with a success message
        return redirect()->route('admin.adminuser')->with('success', 'Provider deleted successfully!');
    }
}
