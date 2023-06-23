<?php

namespace App\Exports;
use App\Models\Personal;
use App\Models\RandomUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PHPUnit\Event\Code\Throwable;

class PersonalNewExport implements FromQuery, ShouldQueue
{
    use Exportable;


    public function query()
    {
        ini_set("memory_limit", -1);

        return Personal::query();

    }

    public function failed(Throwable $exception)
    {
        dd($exception->message());
    }


}
