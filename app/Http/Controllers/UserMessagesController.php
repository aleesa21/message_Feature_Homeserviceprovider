<?php
namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserMessagesController extends Controller
{
    /**
     * Display a listing of the user's service requests.
     */
    public function index(): View
    {
        $user = Auth::user();
        $requests = ServiceRequest::where('user_id', $user->id)
            ->with('provider:id,name') // Eager load provider name (if needed)
            ->latest()
            ->get();

        return view('user.messages', compact('requests'));
    }
}
