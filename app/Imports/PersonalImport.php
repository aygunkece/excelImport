<?php

namespace App\Imports;

use App\Models\Personal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class PersonalImport implements ToModel,WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function model(array $row)
    {

        return new Personal([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone']
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
