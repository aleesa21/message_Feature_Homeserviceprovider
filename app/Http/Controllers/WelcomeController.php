<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch all service providers from the database
        $providers = User::where('role', 'Service-provider')->get(); // Adjust role column if different

        // Pass the providers to the welcome view
        return view('welcome', compact('providers'));
    }

    public function search(Request $request)
    {
        // Get the search term from the query input
        $searchTerm = $request->input('query');
        
        // Search ONLY Service Providers by service type, name, and address
        $users = User::where('role', 'Service-provider') // Ensure only service providers
                     ->where(function ($q) use ($searchTerm) {
                         $q->whereJsonContains('service_type', $searchTerm)  // Search in JSON column
                           ->orWhere('name', 'like', "%$searchTerm%")  // Search in the name
                           ->orWhere('address', 'like', "%$searchTerm%");  // Search in the address
                     })
                     ->get();
    
        // Return the search results to the view
        return view('search_results', compact('users'));
    }
        
    public function searchSuggestions(Request $request)
    {
        $query = strtolower($request->input('query')); // Convert query to lowercase
    
        // Fetch only Service-Providers matching service_type, name, or address
        $services = User::where('role', 'Service-provider') // Only service providers
                        ->where(function ($q) use ($query) {
                            $q->whereRaw("LOWER(name) LIKE ?", ["%$query%"])
                              ->orWhereRaw("LOWER(address) LIKE ?", ["%$query%"])
                              ->orWhereRaw("LOWER(service_type) LIKE ?", ["%$query%"]);
                        })
                        ->get(['name', 'address', 'service_type']); // Select only needed fields
    
        // Extract unique values (name, address, and decoded service_type)
        $results = collect($services)->flatMap(function ($user) use ($query) {
            $serviceTypes = is_array($user->service_type) ? 
                            $user->service_type : 
                            json_decode($user->service_type, true) ?? [];
    
            // If the query matches exactly, only return that match
            if (in_array($query, $serviceTypes)) {
                return [$query];
            }
    
            return array_merge($serviceTypes, [$user->name, $user->address]);
        })->unique()->values(); // Remove duplicates and re-index
    
        return response()->json($results);
    }
    

  

    

}
