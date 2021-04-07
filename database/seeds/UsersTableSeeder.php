<?php

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
        //\App\Models\User::truncate();
        \App\Models\User::create([
            'name' => 'Admin Admin',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'status' => config('constants.STATUS.ACTIVE'),
        ]);
    }
}
