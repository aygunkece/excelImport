<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserCollectionImport implements ToCollection,WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    /*ToCollection --> verileri collection olarak almamızı sağlar */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row)
        {
            User::create([
                'name' => $row['name'],
                'email' => $row['email'],
                'phone_number' => $row['phone_number']
            ]);
        }
    }
}
