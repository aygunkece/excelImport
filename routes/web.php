<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\PersonalNewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/users/import', [UserController::class, 'import'])->name('users.import');

Route::post('/users/importable', [UserController::class, 'userImportable'])->name('users.importable');

Route::post('/users/collection-import', [UserController::class, 'collectionImport'])->name('users.collection-import');

Route::post('/file/upload',[UserController::class, 'importFromUpload'])->name('file.upload');

Route::post('/file/export',[UserController::class, 'export'])->name('file.export');


Route::post('/personal/import',[PersonalController::class, 'import'])->name('personal.import');

Route::post('/file/delete', [UserController::class, 'deleteAllData'])->name('file.delete');
Route::post('/file/seed', [UserController::class, 'randomUserSeed'])->name('file.seed');
Route::post('/personal/export', [PersonalController::class, 'export'])->name('personal.export');

Route::post('/personal/excel-save', [PersonalNewController::class,'excelSave'])->name('personal.excel-save');
