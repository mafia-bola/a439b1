<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(JabatanTableSeeder::class);
        $this->call(BidangTableSeeder::class);
        $this->call(PosisiSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
