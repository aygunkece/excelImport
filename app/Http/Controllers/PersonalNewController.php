<?php

namespace App\Http\Controllers;

use App\Exports\PersonalNewExport;
use App\Jobs\SaveToExcelJob;
use App\Models\Personal;
use App\Models\RandomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;


class PersonalNewController extends Controller
{

    public function excelSave()
    {
        //Fast excel paketi kurulur. yüksek veriye sahip tablodaki veriler
        // limit_Sete takılmamak için cursor() ilke birlikte yield kullanılarak
        //satırların tek tek işlenmesi sağlanır.
        //
        //NOT: İmport aşaması seeder içerisindedir. Bunu command'a taşımak daha sağlıklı olur.
        //controllerden commandı tetiklemek için call() fonksiyonu ile command çağrılır.
        function usersGenerator() {
            foreach (Personal::cursor() as $user) {
                yield $user;
            }

        }
         (new FastExcel(usersGenerator()))->export('deneme10.xlsx');

        return redirect()->back();

    }

}
