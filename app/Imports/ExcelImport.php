<?php

namespace App\Imports;

use App\Models\Product;

use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'id' =>$row[0],
            'name'=>$row[1],
            'description'=>$row[2],
            'content'=>$row[3],
            'menu_id'=>$row[4],
            'price'=>$row[5],
            'price_sale'=>$row[6],
            'active'=>$row[7],
//            'created_at'=>$row[8],
//            'updated_at'=>$row[9],
            'thumb'=>$row[8],


        ]);
    }
}
