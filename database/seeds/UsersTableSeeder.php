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
           'name'  => 'Link',
           'email' => 'link@zelda.com',
           'password' => '123123',
           'phone' => '5555555',
           'username' => 'Admin',
           'address' => 'Madrid 222',
           'admin' => true,
        ]);
    }
}
