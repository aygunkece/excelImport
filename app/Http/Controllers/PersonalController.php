<?php

namespace App\Http\Controllers;

use App\Exports\PersonalExport;
use App\Exports\UsersExport;
use App\Jobs\ImportExcelJob;
use App\Jobs\PersonalExportJob;
use App\Models\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PersonalController extends Controller
{
    public function import(Request $request)
    {
        if ($request->hasFile('files'))
        {
            $files = $request->file('files');
            $i = 0;

            foreach ($files as $file) {
                $i = $i++;
                $fileName ='users'. $i. '.' . $file->getClientOriginalExtension();
                $file->move(public_path('excel/'), $fileName);

                $publicPath = public_path('excel/'.  $fileName);

                ImportExcelJob::dispatch($publicPath);
            }
            return redirect()->back()->with('success','Veri aktarımı başarılı');
        }
        return "Dosya yüklenemedi.";


    }

    public function export()
    {
        Excel::download(new UsersExport, 'personal.xlsx');
       // PersonalExportJob::dispatch();
        return redirect()->back();


       // return Excel::queue(new PersonalExport, 'personal.xlsx');

    }
}
