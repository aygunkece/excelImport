<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UserNewImport implements WithMultipleSheets,WithChunkReading, ShouldQueue
    //ToModel, WithHeadingRow,WithChunkReading, ShouldQueue
{
    use Importable;

    public function model(array $row)
    {
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone_number' => $row['phone_number']
        ]);

    }
    /* WithChunkReading-> Dosyaları bölerek işlenmesini sağlar ShouldQueue ile birlikte kullanılır. chunsize() fonk içinde kaça böleceğimizi belirleriz. */
    public function chunkSize(): int
    {
        return 20;
    }

    public function sheets(): array
    {
        return [
           0 => new FirstSheetImport(),
           1 => new SecondSheetImport()
        ];
    }

}
