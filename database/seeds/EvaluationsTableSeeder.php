<?php

use Illuminate\Database\Seeder;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluationValue = array('A', 'B', 'B');
        $evaluationPeriod = array('First Evaluation', 'Midterm Evaluation', 'Final Evaluation');

        for($i = 3; $i <= 6; $i++){
            foreach ($evaluationPeriod as $period){
                DB::table('evaluations')->insert([
                    'logical_thinking' => $evaluationValue[array_rand($evaluationValue, 1)],
                    'skills' => $evaluationValue[array_rand($evaluationValue, 1)],
                    'attitudes' => $evaluationValue[array_rand($evaluationValue, 1)],
                    'period' => $period,
                    'user_id' => $i.'',
                ]);
            }
        }



    }
}
