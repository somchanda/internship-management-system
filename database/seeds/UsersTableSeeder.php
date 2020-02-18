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
        DB::table('users')->insert([
            'first_name' => 'Mrs',
            'last_name' => 'Admin',
            'phone' => '012345678',
            'photo' => 'img/woman_profile_icon.png',
            'type' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Vithuroath',
            'last_name' => 'Vun',
            'phone' => '012345679',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainer',
            'email' => 'vithouroth@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Ratanak',
            'last_name' => 'Mak',
            'phone' => '012345677',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainee',
            'email' => 'mak.ratanak@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Chanda',
            'last_name' => 'Som',
            'phone' => '012345676',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainee',
            'email' => 'som.chanda@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);
    }
}
