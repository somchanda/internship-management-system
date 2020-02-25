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
        $evaluationValue = array('A', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'B');
        $evaluationPeriod = array('First Evaluation', 'Midterm Evaluation', 'Final Evaluation');
        $date = array('2020-01-01', '2020-02-01', '2020-03-01', '2020-04-01');

        for($i = 3; $i <= 17; $i++){
            foreach ($evaluationPeriod as $period){
                DB::table('evaluations')->insert([
                    'logical_thinking' => $evaluationValue[array_rand($evaluationValue, 1)],
                    'skills' => $evaluationValue[array_rand($evaluationValue, 1)],
                    'attitudes' => $evaluationValue[array_rand($evaluationValue, 1)],
                    'period' => $period,
                    'date' => $date[array_rand($date, 1)],
                    'user_id' => $i.'',
                ]);
            }
        }



    }
}
