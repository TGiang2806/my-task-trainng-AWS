<?php

namespace App\Exports;

use App\Models\UserCustomers;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCus implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserCustomers::all();
    }
}