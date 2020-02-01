<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name'          => 'supahot',
            'role_id'       => '1',
            'email'         => 'supahot@a.aa',
            'password'      => 'aaaaaaaa',
        ]);
    }
}
