<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'id'=>$row[0],
            'name'=>$row[1] ,
            'email'=>$row[2],
            'email_verified_at'=>$row[3],
            'password'=>$row[4] ?? '',
            'last_login'=>$row[5],
            'ip_address	'=>$row[6],
            'remember_token	'=>$row[7] ?? '',
            'created_at	'=>$row[8],
            'updated_at	'=>$row[9],
            'active'=>$row[10],
            'delete'=>$row[11] ?? '',
            'group'=>$row[12] ?? '',
        ]);
    }
}
