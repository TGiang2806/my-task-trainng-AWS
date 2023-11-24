<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User; // Import the User model
class LoginController extends Controller
{


    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('admin'); // Redirect to dashboard if already logged in
        }

        return view('admin.users.login', ['title' => 'Login System']);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->session()->get('user_session_id') === $user->session_id) {
                // User's session identifier matches the stored one
                return redirect()->back();
            } else {

                Auth::logout();


                $user->session_id = $request->session()->getId();
                $user->save();

                $request->session()->put('user_session_id', $user->session_id);


                Auth::login($user);

                return redirect()->back();
            }
        }


    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ], $request->input('remember'))) {
            $user = Auth::user();
            $user->last_login = now();
            $user->ip_address = $request->ip();
            $user->session_id = $request->session()->getId(); // Update the user's session ID
            $user->save();

            return redirect()->route('admin');
        }

        session()->flash('error', 'Email or Password is incorrect');
        return redirect()->back();
    }

}
