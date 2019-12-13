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
        $users = ['John Smith', 'Laura Stone', 'Jon Olson'];
        foreach ($users as $user) {
            App\User::firstOrCreate(['name' => $user]);
        }
    }
}
