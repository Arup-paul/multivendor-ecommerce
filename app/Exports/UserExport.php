<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select(['id','name','email','mobile','address','city','country','pincode','created_at'])->whereStatus(1)->latest()->get();
    }

    public function headings(): array
    {
       return [
           'ID',
           'Name',
           'Email',
           'Mobile',
           'address',
           'city',
           'country',
           'pincode',
           'Registered At',
       ];
    }
}
