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
            'name'          => 'viewer',
            'description'   => 'Users registering for the festival.',
        ]);

        Role::create([
            'name'          => 'moderator',
            'description'   => 'Application moderator, has limited management privileges.',
        ]);

        Role::create([
            'name'          => 'monitor',
            'description'   => 'User granted the privilege of viewing application data.',
        ]);
    }
}
