<?php

use App\Role;
use App\User;
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
            'name' => 'Json Statan',
            'email' => 'json@gmail.com',
            'password' => 'hola123',
            'position' => 'Admin',
            'role_id' => Role::where('name','administrador')->first()->id
        ]);
    }
}
