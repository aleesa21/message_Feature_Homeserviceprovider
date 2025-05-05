<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('homepage.register'); // Adjust the path to your register view
    }
    public function register(Request $req)
    {
        // Validate the form inputs
        $req->validate([
            'register-as' => 'required|in:Customer,Service-provider',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users|max:10',
            'address' => 'required|string|max:500',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
        ]);

        // Save user data to the database
        $user = User::create([
            'role' => $req->input('register-as'),
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'phone' => $req->input('phone'),
            'address' => $req->input('address'),
            'password' => Hash::make($req->input('password')),
        ]);

        // Ensure that $user is properly defined before calling Auth::login()
        if ($user) {
            // Automatically log in the user
            Auth::login($user);  // Log the user in

            // Redirect based on role
            if ($user->role === 'Service-provider') {
                // Redirect to the service provider's dashboard
                return redirect()->route('profile.update');
            } else {
                // Redirect to the home page for normal users
                return redirect('userdash');
            }
        }

        // If user is not created, return back with an error
        return back()->withErrors(['registration' => 'An error occurred during registration. Please try again.']);
    }
}
