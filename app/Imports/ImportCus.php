<?php

namespace App\Imports;

use App\Models\UserCustomers;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportCus implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserCustomers([
            'id'=>$row[0],
            'name'=>$row[1],
            'email'=>$row[2],
            'email_verified_at'=>$row[3],
            'phone_number'=>$row[4],
            'password'=>$row[5],
            'last_login'=>$row[6],
            'ip_address	'=>$row[7],
            'remember_token	'=>$row[8],
            'created_at	'=>$row[9],
            'updated_at	'=>$row[10],
            'active'=>$row[11],
            'type'=>$row[12],
            'gender'=>$row[13],
        ]);
    }
}
