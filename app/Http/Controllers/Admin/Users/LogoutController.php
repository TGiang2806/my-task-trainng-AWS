<?php
namespace App\Http\Controllers\Admin\Users;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LogoutController extends Controller

{
//    public function logout()
//    {
//        Auth::logout();
//        return redirect('/admin/users/login'); // Redirect to the desired page after logout
//    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('admin'); // Redirect to your admin page route
    }

}
