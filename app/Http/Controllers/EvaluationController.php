<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function showList(){
        $evaluations = Evaluation::all();

        $evaluation_data_first = array();
        $evaluation_data_midterm = array();
        $evaluation_data_final = array();
        foreach ($evaluations as $evaluation){
            $user = DB::table('users')
                ->where('id', '=', $evaluation->user_id)
                ->select(['first_name', 'last_name'])->first();

            $data = $evaluation->attributesToArray();
            $data = array_merge($data, array('name' => $user->first_name.' '.$user->last_name));

            if($evaluation->period == 'First Evaluation'){
                array_push($evaluation_data_first, (array) $data);
            }else if($evaluation->period == 'Midterm Evaluation'){
                array_push($evaluation_data_midterm, (array) $data);
            }else{
                array_push($evaluation_data_final, (array) $data);
            }

        }
        $evaluation_datas = array(
            'first_evaluation' => $evaluation_data_first,
            'midterm_evaluation' => $evaluation_data_midterm,
            'final_evaluation' => $evaluation_data_final
        );

        return view('trainer.evaluation_list')->with('evaluation_datas', $evaluation_datas);
    }
}
