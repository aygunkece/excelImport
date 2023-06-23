<?php

namespace Database\Seeders;

use App\Exports\PersonalNewExport;
use App\Models\Personal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class ExcelExportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collection = (new FastExcel)->import(public_path('deneme.xlsx'));

        $cs = $collection->chunk(500);

        $arr = [];
        foreach ($cs as $key => $value)
        {
            foreach ($value as $key2 => $value2)
            {
                unset($value2["id"]);
                unset($value2["created_at"]);
                unset($value2["updated_at"]);
                $arr[] = $value2;
            }
            DB::table("personals")->insert($arr);
            $arr = [];
        }


    }
}
