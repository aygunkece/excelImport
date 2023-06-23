<?php

namespace App\Exports;

use App\Models\RandomUser;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RandomUser::query()->get(['name','email','phone']);


    }
}
