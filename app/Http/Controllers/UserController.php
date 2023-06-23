<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UserCollectionImport;
use App\Imports\UserNewImport;
use App\Imports\UsersImport;
use App\Jobs\ImportUsersJob;
use App\Models\RandomUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function import()
    {

        ImportUsersJob::dispatch(public_path('excel/users.xlsx'));
        return redirect('/')->with('success', 'İşlem Başarılı!');
    }

    public function importFromUpload(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');
            $fileName = 'users.' . $file->getClientOriginalExtension();

            // Dosyayı public klasörüne kaydet
            $file->move(public_path('excel/'), $fileName);

            // Opsiyonel olarak dosyanın tam yolunu döndürebilirsiniz
            $publicPath = public_path('excel/' . $fileName);


            ImportUsersJob::dispatch($publicPath);
            return redirect('/')->with('success', 'İşlem Başarılı!');
        }
        return "Dosya yüklenemedi.";
    }

    public function collectionImport()
    {
        Excel::import(new UserCollectionImport(), public_path('excel/users.xlsx'));
        return redirect()->back();
    }

    public function userImportable()
    {
        // IMPORTABLES traiti satesinde import() metodunu kullanabilir ve Sınıf tanımlamadan import işlemini yapabiliriz.
                //(new UserNewImport)->import('users.xlsx', 'local', \Maatwebsite\Excel\Excel::XLSX);

        (new UserNewImport)->queue(public_path('excel/users.xlsx'));
        return redirect()->back();

    }
        //Dosyayı dışa aktarma
    public function export()
    {
        return Excel::download(new UsersExport, 'users_10000_a.xlsx');

    }

    public function deleteAllData()
    {
        DB::table('random_users')->truncate();
        return redirect()->back();
    }

    public function randomUserSeed()
    {
        Artisan::call('db:seed', [
            '--class' => 'RandomUserSeeder',
        ]);
        return redirect()->back();
    }


}
