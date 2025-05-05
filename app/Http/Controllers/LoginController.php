<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('homepage.login'); // Adjust the path to your login view
    }
    // Handle the login form submission
    public function login(Request $req)
    {
        // Validate the login form inputs
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
            $user = Auth::user();
            
            // Regenerate the session ID to prevent session fixation
            $req->session()->regenerate();

            // // Check if a redirect URL exists
            // if ($req->has('redirect')) {
            //     return redirect($req->redirect);
            // }
            // Ensure the redirect URL is valid
        if ($req->filled('redirect') && filter_var($req->redirect, FILTER_VALIDATE_URL)) {
            return redirect($req->redirect);
        }
    

            // Redirect based on user role
            if ($user->role === 'Admin') {
                return redirect()->route('adash'); // Redirect admin dashboard
            } 
            elseif ($user->role === 'Service-provider') {
                return redirect()->route('pdash', ['id' => $user->id]); // Redirect provider dashboard
            }
        
            return redirect()->route('udash'); // Redirect normal users
        }

        // If authentication fails, return back with the input and error message
        return back()->withInput()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
