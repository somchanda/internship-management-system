<?php

use Illuminate\Database\Seeder;

class Trainee_infosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 3; $i <= 6; $i++) {
            DB::table('trainee_infos')->insert([
                'contract_start' => '2020-03-01',
                'contract_end' => '2020-05-30',
                'internship_status' => 'Doing Internship',
                'position' => 'PHP Intern',
                'address' => 'Phnom Penh',
                'marital_status' => 'Single',
                'height' => 1.67,
                'nationality' => 'Khmer',
                'dob' => '1999-02-20',
                'hobbies' => 'Love coding',
                'place_of_birth' => 'Siem Reap',
                'start_date' => '2020-02-03',
                'end_date' => '2020-04-03',
                'reference_name' => 'Dara',
                'reference_position' => 'Sale',
                'reference_phone' => '093737373',
                'reference_email' => 'dara@gmail.com',
                'user_id' => $i
            ]);

            DB::table('education')->insert([
                'date' => '2016 - present',
                'description' => 'Studied at University of Information Technology',
                'user_id' => $i
            ]);
            DB::table('education')->insert([
                'date' => '2013 - 2016',
                'description' => 'Study general knowledge at High School',
                'user_id' => $i
            ]);


            DB::table('languages')->insert([
                'language' => 'Khmer',
                'description' => 'Mother tongue',
                'user_id' => $i
            ]);
            DB::table('languages')->insert([
                'language' => 'English ',
                'description' => 'Good in Speaking, Listening, Reading and Writing',
                'user_id' => $i
            ]);


            DB::table('skills')->insert([
                'skill' => 'PHP',
                'rate' => 5,
                'user_id' => $i
            ]);
            DB::table('skills')->insert([
                'skill' => 'laravel',
                'rate' => 9,
                'user_id' => $i
            ]);


            DB::table('work_exps')->insert([
                'date' => '2018-2019 ',
                'description' => 'Internship laravel at AllWeb',
                'user_id' => $i
            ]);
            DB::table('work_exps')->insert([
                'date' => '2019-2020 ',
                'description' => 'Internship Symfony at AllWeb',
                'user_id' => $i
            ]);
        }
    }

}
