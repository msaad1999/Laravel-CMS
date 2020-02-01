<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'          => 'administrator',
            'description'   => 'Application owner, has all privileges.',
        ]);

        Role::create([
            'name'          => 'subscriber',
        ]);

        Role::create([
            'name'          => 'author',
        ]);
    }
}
