<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps =false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'created_at',
        'updated_at',
        'thumb'
    ];
    protected $primaryKey='id';
    protected $table='Products';
    public function menu()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['name' => '']);
    }
    //thêm local scope
    //global scope
    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%');
        }


        return $query;
    }

}

