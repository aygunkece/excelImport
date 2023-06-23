<?php

namespace App\Jobs;

use App\Imports\PersonalImport;
use App\Models\Personal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct(public $publicPath)
    {
    }

    public function handle(): void
    {
        $file = $this->publicPath;
        Excel::import(new PersonalImport, $file);
      //  Storage::delete($this->filePath);

    }
}
