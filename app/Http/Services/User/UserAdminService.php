<?php

namespace App\Http\Services\User;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidMail($request)
    {
        if ($request->input('email') == null)
        {
            Session::flash('error', 'Please enter the phone number');
            return false;
        }


        return true;
    }

    public function insert($request)
    {
        $isValidMail = $this->isValidMail($request);
        if ($isValidMail === false) return false;

        try {
            $request->except('_token');
            User::create($request->all());

            Session::flash('success', 'User added successfully');
        } catch (\Exception $err) {
            Session::flash('error', 'Add error user');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function get()
    {
        return User::with('menu')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $user)
    {
        $isValidMail = $this->isValidMail($request);
        if ($isValidMail === false) return false;

        try {
            $user->fill($request->input());
            $user->save();
            Session::flash('success', 'Update successful');
        } catch (\Exception $err) {
            Session::flash('error', 'There was an error, please try again');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
