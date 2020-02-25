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
        $evaluated_user = array();
        $tobe_evaluate_user = array();
        $users = DB::table('users')->selectRaw('count(evaluations.user_id) as count_user , last_name, first_name, users.id as id')
            ->join('evaluations','users.id','=','evaluations.user_id')->groupBy('evaluations.user_id')->get();
        foreach ($users as $user){
            if($user->count_user ==3){
                array_push($evaluated_user,['id'=>$user->id,'last_name'=>$user->last_name,'first_name'=>$user->first_name]);
            }else{
                array_push($tobe_evaluate_user,['id'=>$user->id,'last_name'=>$user->last_name,'first_name'=>$user->first_name]);
            }
        }
        $user_2 = DB::table('users')
            ->select('last_name','first_name','users.id as id')
            ->join('evaluations','users.id','=','evaluations.user_id','left outer')
            ->where('type','=','Trainee')->where('evaluations.user_id','=',null)->get();
        foreach ($user_2 as $user){
            array_push($tobe_evaluate_user,['id'=>$user->id,'last_name'=>$user->last_name,'first_name'=>$user->first_name]);
        }
        return $tobe_evaluate_user;
    }
    public function fillPeriodSelect(Request $request){
        $id = $request->id;
        $period = array('First Evaluation','Midterm Evaluation','Final Evaluation');
        $result = array();
        $evaluations = DB::table('evaluations')->where('user_id','=',$id)->get();
        foreach ($evaluations as $evaluation){
            if($evaluation->period == 'First Evaluation'){
                unset($period[0]);
            }
            if($evaluation->period == 'Midterm Evaluation'){
                unset($period[1]);
            }
            if($evaluation->period == 'Final Evaluation'){
                unset($period[2]);
            }
            $result = array_values($period);
        }
        if(count($period) == 3){
            return $period;
        }else{
            return $result;
        }

    }
    public function saveEvaluation(Request $request){
        $validatedData = $request->validate([
            'logical_thinking' => 'required',
            'skills' => 'required',
            'attitudes' => 'required',
            'user_id' => 'required',
            'period' => 'required',
            'date'=>'required'
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
        $evaluation->date = $request->input('date');
        $evaluation->save();
        return back()->with('success','Evaluation has updated');
    }
    public function deleteEvaluation(Request $request){
        Evaluation::find($request->txt_id)->delete();
        return back()->with('success','Evaluation has deleted!');
    }
    public function fillTraineeSelectForUpdate(){
        $trainees = DB::table('users')->where('type','=','Trainee')->get();
        return $trainees;
    }
}
