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
//        DB::table('trainee_infos')->insert([
//            'internship_status' => 'Doing Intern',
//            'position' => 'Web Intern',
//            'address'=>'PP',
//            'martial_status' => 'Single',
//            'height' => 1.67,
//            'nationality' => 'Khmer',
//            'dob' => '1999/02/20',
//            'hobbies' => 'Love coding',
//            'place_of_birth' => 'PP',
//            'start_date' =>'2020/02/03',
//            'end_date' =>'2020/04/03',
//            'reference_name' => 'dara',
//            'reference_position' => 'sale',
//            'reference_phone' => '093737373',
//            'reference_email' => 'dara@gmail.com',
//            'user_id' =>4
//        ]);
//
//        DB::table('education')->insert([
//            'date' => '2016-present',
//            'description' => 'A student who study at NPTTIC IT',
//            'user_id'=>4
//        ]);
//
//        DB::table('languages')->insert([
//            'language' => 'Khmer',
//            'description' => 'Mother tongue',
//            'user_id'=>4
//        ]);
//        DB::table('languages')->insert([
//            'language' => 'English ',
//            'description' => 'Good in Speaking, Listening, Reading and Writing',
//            'user_id'=>4
//        ]);
//        DB::table('skills')->insert([
//            'skill' => 'PHP',
//            'rate' => 5,
//            'user_id'=>4
//        ]);
//        DB::table('skills')->insert([
//            'skill' => 'laravel',
//            'rate' => 9,
//            'user_id'=>4
//        ]);
//        DB::table('work_exps')->insert([
//            'date' => '2016-2017 ',
//            'description' => 'Internship laravel at AllWeb',
//            'user_id'=>4
//        ]);

        DB::table('trainee_infos')->insert([
            'internship_status' => 'Doing Internship',
            'position' => 'Web Intern',
            'address'=>'PP',
            'martial_status' => 'Single',
            'height' => 1.67,
            'nationality' => 'Khmer',
            'dob' => '1999/02/20',
            'hobbies' => 'Coding, reading book , playing football, listening on Radio, finding solution for any problem, searching on internet.',
            'place_of_birth' => 'PP',
            'start_date' =>'2020/02/03',
            'end_date' =>'2020/04/03',
            'reference_name' => 'dara',
            'reference_position' => 'sale',
            'reference_phone' => '093737373',
            'reference_email' => 'dara@gmail.com',
            'user_id' => 4
        ]);

        DB::table('education')->insert([
            'date' => '2017-present',
            'description' => 'Third-year students at SETEC Institute in Major Management Information System.',
            'user_id'=>4
        ]);
        DB::table('education')->insert([
            'date' => '2017-present',
            'description' => 'Third-year students at National University of Management in Major Information',
            'user_id'=>4
        ]);

        DB::table('languages')->insert([
            'language' => 'Khmer',
            'description' => 'Mother tongue',
            'user_id'=>4
        ]);
        DB::table('languages')->insert([
            'language' => 'English ',
            'description' => 'Good in Speaking, Listening, Reading and Writing',
            'user_id'=>3
        ]);
        DB::table('skills')->insert([
            'skill' => 'PHP',
            'rate' => 5,
            'user_id'=>4
        ]);
        DB::table('skills')->insert([
            'skill' => 'laravel',
            'rate' => 5,
            'user_id'=>4
        ]);
        DB::table('work_exps')->insert([
            'date' => '2016-2017 ',
            'description' => 'Teaching English at private school at Takeo province',
            'user_id'=>4
        ]);
    }
}
