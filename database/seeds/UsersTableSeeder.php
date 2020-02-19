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
            'sex' => 'Female',
            'phone' => '012345678',
            'photo' => 'img/woman_profile_icon.png',
            'type' => 'Admin',
            'email' => 'mrs.admin@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Vithuroath',
            'last_name' => 'Vun',
            'sex' => 'Male',
            'phone' => '012345679',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainer',
            'email' => 'vithuroath.vun@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Ratanak',
            'last_name' => 'Mak',
            'sex' => 'Male',
            'phone' => '012345677',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainee',
            'email' => 'ratanak.mak@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Chanda',
            'last_name' => 'Som',
            'sex' => 'Male',
            'phone' => '012345676',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainee',
            'email' => 'chanda.som@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Sievphygn',
            'last_name' => 'Cheath',
            'sex' => 'Male',
            'phone' => '012345675',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainee',
            'email' => 'sievphygn.cheath@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);

        DB::table('users')->insert([
            'first_name' => 'Chanmony',
            'last_name' => 'Keat',
            'sex' => 'Male',
            'phone' => '012345674',
            'photo' => 'img/man_profile_icon.png',
            'type' => 'Trainee',
            'email' => 'chanmony.keat@allweb.com.kh',
            'password' => Hash::make('12345678'),

        ]);
    }
}
