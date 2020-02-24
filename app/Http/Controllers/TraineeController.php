<?php

namespace App\Http\Controllers;
use App\Education;
use App\Evaluation;
use App\Skill;
use App\Trainee_info;
use App\Work_exp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TraineeController extends Controller
{
    public function showEvaluation(){
        $evaluation = Evaluation::all()->where('user_id','=',Auth::user()->id);
//        return $evaluation;
        return view('trainee.view_evaluation')->with('evaluations',$evaluation);
    }
    public function viewProfile(){
        $trainee_infos = Trainee_info::all()->where('user_id','=',Auth::user()->id);
        $skill = Skill::all()->where('user_id','=',Auth::user()->id);
        $exp = Work_exp::all()->where('user_id','=',Auth::user()->id);
        $edu = Education::all()->where('user_id','=',Auth::user()->id);
        return view('trainee.view_profile')->with('trainees',$trainee_infos)->with('skills',$skill)->with('exps',$exp)->with('edus',$edu);
    }
}
