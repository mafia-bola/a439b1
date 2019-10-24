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
        Bidang::create([
            'nama_bidang' => 'Administrator',
            'status' => 'Tidak Aktif'
        ]);
    }
}
