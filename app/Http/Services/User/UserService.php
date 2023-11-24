<?php

namespace App\Http\Services\User;
use App\Models\User;

class UserService
{

    const LIMIT = 16;

    public function get($page = null)
    {
        return User::select('id', 'name', 'email', 'password')
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    public function show($id)
    {
        return User::where('id', $id)
            ->where('active', 1)
            ->with('type')
            ->firstOrFail();
    }

    public function more($id)
    {
        return User::select('id', 'name', 'email', 'password')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }
}
