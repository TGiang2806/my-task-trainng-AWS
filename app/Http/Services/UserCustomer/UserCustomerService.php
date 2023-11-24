<?php

namespace App\Http\Services\UserCustomer;
use App\Models\UserCustomers;

class UserCustomerService
{

    const LIMIT = 16;

    public function get($page = null)
    {
        return UserCustomers::select('id', 'name', 'email', 'phone_number', 'password')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return UserCustomers::where('id', $id)
            ->where('active', 1)
            ->with('type')
            ->firstOrFail();
    }

    public function more($id)
    {
        return UserCustomers::select('id', 'name', 'email', 'phone_number', 'password')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }
}
