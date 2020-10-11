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
        $user = \App\User::create([
            'name' => 'mohamedelmeleeh',
            'email' => 'superadministrator@app.com',
            'password' => bcrypt('123456'),
            'image' =>  'mohamed.jpeg',
        ]);
        
        return $user->attachRole('superadministrator');
    }
}
