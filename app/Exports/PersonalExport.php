<?php
namespace App\Exports;

use App\Models\Personal;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class PersonalExport implements FromQuery,WithChunkReading
{
    use Exportable;
    public function query()
    {
       return Personal::query();

    }


    public function chunkSize(): int
    {
        return 100;
    }
}
