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
        Jabatan::insert(
            [
                [
                    'nama_jabatan' => 'Administrator',
                    'eselon' => '-',
                    'status' => 'Aktif'
                ],
                [
                    'nama_jabatan' => 'Kepala Badan',
                    'eselon' => 'II',
                    'status' => 'Aktif'
                ],
                [
                    'nama_jabatan' => 'Sekertaris',
                    'eselon' => 'III',
                    'status' => 'Aktif'
                ],
                [
                    'nama_jabatan' => 'Kepala Bidang',
                    'eselon' => 'III',
                    'status' => 'Aktif'
                ],
            ]
        );
    }
}
