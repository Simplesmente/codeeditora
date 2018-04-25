<?php

use Illuminate\Database\Seeder;
use CodePub\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'André',
                      'email' => 'admin@domain.com',
                      'password' => bcrypt('secret'),
                      'remember_token' => str_random(10)]);

        factory(\CodePub\User::class, 9)->create();
    }
}
