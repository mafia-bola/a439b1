<?php

use App\Bidang;
use Illuminate\Database\Seeder;

class BidangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bidang::create(
            [
                'nama_bidang' => 'Sekertariat',
                'status' => 'Aktif'
            ],
        );

        Bidang::create(
            [
                'nama_bidang' => 'Pelaporan',
                'status' => 'Aktif'
            ],
        );
    }
}
