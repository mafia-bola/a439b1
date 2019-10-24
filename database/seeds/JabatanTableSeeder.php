<?php

use App\Jabatan;
use Illuminate\Database\Seeder;

class JabatanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jabatan::create([
            'nama_jabatan' => 'Administrator',
            'eselon' => '-',
            'status' => 'Tidak Aktif'
        ]);
    }
}
