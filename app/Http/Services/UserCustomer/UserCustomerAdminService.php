<?php

namespace App\Http\Services\UserCustomer;
use App\Models\Menu;
use App\Models\UserCustomers;
use Illuminate\Support\Facades\Session;

class UserCustomerAdminService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidPhone($request)
    {
        if ($request->input('phone_number') == null)
        {
            Session::flash('error', 'Please Enter Number phone');
            return false;
        }


        return true;
    }

    public function insert($request)
    {
        $isValidPhone = $this->isValidPhone($request);
        if ($isValidPhone === false) return false;

        try {
            $request->except('_token');
            UserCustomers::create($request->all());

            Session::flash('success', 'Customer added successfully');
        } catch (\Exception $err) {
            Session::flash('error', 'Add error customer');
            \Log::info($err->getMessage());
            return false;
        }

        return true;
    }

    public function get()
    {
        return UserCustomers::with('menu')
            ->orderByDesc('id')->paginate(15);
    }

    public function update($request, $userCustomers)
    {
        $isValidPhone = $this->isValidPhone($request);
        if ($isValidPhone === false) return false;

        try {
            $userCustomers->fill($request->input());
            $userCustomers->save();
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
        $userCustomers = UserCustomers::where('id', $request->input('id'))->first();
        if ($userCustomers) {
            $userCustomers->delete();
            return true;
        }

        return false;
    }
}
