<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Evaluation;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

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
    public function fillTraineeSelect(){
        $trainee = DB::table('users')->where('type','=','Trainee')->get();
        return $trainee;
    }
    public function fillPeriodSelect(Request $request){
        $id = $request->id;
//        $period = array('First Evaluation','Midterm Evaluation','Final Evaluation');$t=array();
        $evaluation = DB::table('evaluations')->where('user_id','=',$id)->get();
        return $evaluation;
    }
    public function saveEvaluation(Request $request){
        $validatedData = $request->validate([
            'logical_thinking' => 'required',
            'skills' => 'required',
            'attitudes' => 'required',
            'user_id' => 'required',
            'period' => 'required',
        ]);

        Evaluation::create($validatedData);
        return redirect('/trainer/evaluation_list')->with('success','Evaluation created!');
    }
    public function editEvaluation(Request $request){
        $evaluation = DB::table('evaluations')->where('id','=',$request->id)->get();
        return $evaluation;
    }
    public function updateEvaluation(Request $request){
        $evaluation = Evaluation::find($request->input('id'));
        $evaluation->logical_thinking = $request->input('logical_thinking');
        $evaluation->skills = $request->input('skills');
        $evaluation->attitudes = $request->input('attitudes');
        $evaluation->period = $request->input('period');
        $evaluation->user_id = $request->input('user_id');
        $evaluation->save();
        return back()->with('success','Evaluation has updated');
    }
    public function deleteEvaluation(Request $request){
        Evaluation::find($request->txt_id)->delete();
        return back()->with('success','Evaluation has deleted!');
    }
}
