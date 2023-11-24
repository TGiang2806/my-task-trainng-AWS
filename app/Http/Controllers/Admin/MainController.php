<?php

namespace App\Http\Controllers\Admin;

use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     *  View home page after login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
 */
    //
    public function index()
    {
        return view('admin.home',[
            'title'=> 'Admin administration page'
        ]);

    }
}
