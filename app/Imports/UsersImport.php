<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Row;

class UsersImport implements ToModel,WithHeadingRow, WithUpserts, WithUpsertColumns,WithChunkReading,ShouldQueue  //OnEachRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*  WithHeadingRow --> Exceldeki kayıtları satır başlıklarına göre ayırmasını sağlar. */
    public function model(array $row)
    {
            return new User([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'phone_number' => $row['phone_number'],
            ]);
    }

    public function chunkSize(): int
    {
        return 500;
    }

/* WithUpserts sınıfı--> Excel dosyasını veritabanına aktarırken kayıtların var olup olmadığını kontrol etmek ve mevcut kayıtları güncellemek için kullanılır.
   Bu özellik, veritabanında aynı kayıtları tekrar tekrar oluşturmak yerine, mevcut kayıtları güncelleyerek veritabanının performansını artırır.
        uniqueBy() fonksiyonu ile email sütununa göre kayıtların benzersiz olduğu belirtildi.
         */
    public function uniqueBy()
    {
        return 'email';
    }
/*
WithUpsertColumns Sınıfı--> Excel dosyasındaki verileri veritabanına aktarırken
hangi sütunların güncellenmesi veya dikkate alınması gerektiğini belirlemek için kullanılır.

upsertUsingColumns() --> güncelleme işlemi için hangi sütunları dikkate alacağınızı belirtir.
 'email' ve 'phone_number' sütunlarındaki değerlerin güncellenmesi gerektiğini belirttik. */


    public function upsertColumns()
    {
        return ['email', 'phone_number'];
    }


    /**
     * @param Row $row
     * @return void
     */
   /* onRow() --> her satır için çalışacak işlemleri tanımlar.
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        $group = Group::firstOrCreate([
            'name' => $row[1],
        ]);

        $group->users()->create([
            'name' => $row[0],
        ]);

    }
   */

}
