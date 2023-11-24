<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomers extends Model

{

    use HasFactory;

    protected $fillable = [

        'name',
        'email',
        'email_verified_at',
        'phone_number',
        'password',
        'last_login',
        'ip_address',
        'remember_token',
        'created_at',
        'updated_at',
        'active',
        'type',
        'gender',
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'type')
            ->withDefault(['name' => '']);
    }
    //thêm local scope
    //global scope
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }
        if ($phone = request()->phone) {
            $query = $query->where('phone_number', 'like', '%' . $phone . '%');
        }

        return $query;
    }
}
