<?php

use App\Posisi;
use Illuminate\Database\Seeder;

class PosisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Posisi::create([
            'nama_posisi' => 'Operator',
            'status' => 'Aktif',
        ]);
    }
}
