<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class UserController extends Controller
{
    public function show(){

        $providers= User::where('role', 'Service-provider')->get();
        
        // Return the view with the providers data
        return view('user.userdash', compact('providers'));
    }
    public function provider($id)
    {
        $provider = User::findOrFail($id);
        return view('user.providerprofileforuser', compact('provider'));
    }
}
