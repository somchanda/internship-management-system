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
        $position = array('PHP Intern', 'Java Intern');
        $start_date = array('2020-02-01', '2020-01-01', '2020-03-01');
        $end_date = array('2020-04-30', '2020-03-31', '2020-05-31');

        for ($i = 3; $i <= 6; $i++) {
            $index = rand(0, 2);

            DB::table('trainee_infos')->insert([
                'contract_start' => $start_date[$index],
                'contract_end' => $end_date[$index],
                'internship_status' => 'Doing Internship',
                'position' => $position[array_rand($position, 1)],
                'address' => 'Phnom Penh',
                'marital_status' => 'Single',
                'height' => 1.67,
                'nationality' => 'Khmer',
                'dob' => '1999-02-20',
                'hobbies' => 'Love coding',
                'place_of_birth' => 'Siem Reap',
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
