<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Administrator',
            'nip' => '0',
            'alamat' => '-',
            'telepon' => '-',
            'tanggal_lahir' => Carbon::now(),
            'tempat_lahir' => 'Laboratorium',
            'jabatan_id' => 1,
            'bidang_id' => 1,
            'status' => 'Aktif',
            'username' => 'admin',
            'password' => bcrypt(123456),
            'role' => 'Admin'
        ]);
    }
}
