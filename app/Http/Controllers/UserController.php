<?php

namespace App\Http\Controllers;

use App\Education;
use App\Language;
use App\Skill;
use App\Trainee_info;
use App\Work_exp;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(){
        $admin = User::all()->where('type','=','Admin');
        $trainer = User::all()->where('type','=','Trainer');
        $trainee = User::all()
            ->where('type','=','Trainee');
        return view('trainer.view_user')->with('admins',$admin)->with('trainers',$trainer)->with('trainees',$trainee);
    }
    public function showUserDetail($id){
        $user = User::all()->where('id','=',$id);
        return view('trainer.view_user_detail')->with('users',$user);
    }
    public function showTraineeDetail($id){
        $trainee = DB::table('users')
            ->leftJoin('trainee_infos','trainee_infos.user_id','=','users.id')
            ->where('users.id','=',$id)
            ->get();
        $skill = Skill::all()->where('user_id','=',$id);
        $work = Work_exp::all()->where('user_id','=',$id);
        $education = Education::all()->where('user_id','=',$id);
        $language = Language::all()->where('user_id','=',$id);
        return view('trainer.view_trainee_detail')
            ->with('trainees',$trainee)
            ->with('skills',$skill)
            ->with('works',$work)
            ->with('educations',$education)
            ->with('languages',$language);
    }
    public function deleteUser(Request $request){
        $user = User::find($request->txt_id);
        $user->delete();
        return redirect('/user')->with('success','Deleted successful');
    }
    public function deleteTrainee(Request $request){
        $id = $request->txt_id;
        Trainee_info::where('user_id',$id)->delete();
        User::where('id',$id)->delete();
        Skill::where('user_id',$id)->delete();
        Work_exp::where('user_id',$id)->delete();
        Language::where('user_id',$id)->delete();
        Education::where('user_id',$id)->delete();

        return redirect('/user')->with('success','Deleted successful');
    }
    public function editUser($id){
        $user = User::all()->where('id','=',$id);
        return view('trainer.edit_user')->with('users',$user);
    }
    public function updateUser(Request $request){
        $user = User::find($request->input('id'));
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->sex = $request->input('sex');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->save();
        return redirect('/user')->with('success','User updated successful');
    }
    public function editTrainee($id){
        $user = DB::table('users')
            ->leftJoin('trainee_infos','trainee_infos.user_id','=','users.id')
            ->where('users.id','=',$id)->get();
        $language =  DB::table('users')
                    ->leftJoin('languages','languages.user_id','=','users.id')
                    ->where('users.id','=',$id)->get();
        return view('trainer.edit_trainee')->with('users',$user)->with('languages',$language);
    }
}
