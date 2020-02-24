<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Education;
use App\Language;
use App\Skill;
use App\Trainee_info;
use App\Work_exp;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function createAccount(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['regex:/^0[1-9][0-9]{7,8}$/'],
            'type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (request('cropedImage2') != null) {
            $base64 = explode(',', request('cropedImage2'))[1];
            $image = base64_decode($base64);
            $photo = imagecreatefromstring($image);

            $name = time() . $request->first_name . '_' . $request->last_name . '_profile_pic.png';
            $destinationPath = 'img/' . $name;
            imagepng($photo, $destinationPath, 9);
            $photo = 'img/' . $name;
        } else {
            if ($request->sex == 'Female') {
                $photo = 'img/woman_profile_icon.png';
            } else {
                $photo = 'img/man_profile_icon.png';
            }
        }

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'photo' => $photo,
            'type' => $request->type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/user');
    }

    public function viewProfile(){
        if(Auth::user()->type == 'Admin' || Auth::user()->type == 'Trainer'){
            $user = Auth::user();
            return view('trainer.view_user_detail')->with('user', $user);
        }else{
            $trainee = Auth::user();

            $traineeInfo = DB::table('trainee_infos')
                ->where('user_id', '=', $trainee->id)
                ->first();
            $skills = Skill::all()->where('user_id', '=', $trainee->id);
            $workExperiences = Work_exp::all()->where('user_id', '=', $trainee->id);
            $educations = Education::all()->where('user_id', '=', $trainee->id);
            $languages = Language::all()->where('user_id', '=', $trainee->id);


            return view('trainer.view_trainee_detail')
                ->with('trainee', $trainee)
                ->with('traineeInfo', $traineeInfo)
                ->with('skills', $skills)
                ->with('workExperiences', $workExperiences)
                ->with('educations', $educations)
                ->with('languages', $languages);
        }

    }

    public function submitImage(Request $request, $id)
    {
        if ($request->cropedImage != null) {
            $base64 = explode(',', request('cropedImage'))[1];
            $image = base64_decode($base64);
            $photo = imagecreatefromstring($image);

            $name = time() . $request->first_name . '_' . $request->last_name . '_profile_pic.png';
            $destinationPath = 'img/' . $name;
            imagepng($photo, $destinationPath, 9);
            $photo = 'img/' . $name;
        }

        $user = User::find($id);

        $user->photo = $photo;

        $user->save();

        return back();
    }

    public function show()
    {
        $admin = User::all()->where('type', '=', 'Admin');
        $trainer = User::all()->where('type', '=', 'Trainer');
        $trainee = User::all()
            ->where('type', '=', 'Trainee');
        return view('trainer.view_user')->with('admins', $admin)->with('trainers', $trainer)->with('trainees', $trainee);
    }

    public function showUserDetail($id)
    {
        $user = User::find($id);
        return view('trainer.view_user_detail')->with('user', $user);
    }

    public function showTraineeDetail($id)
    {
        $trainee = User::find($id);

        $traineeInfo = DB::table('trainee_infos')
            ->where('user_id', '=', $id)
            ->first();
        $skills = Skill::all()->where('user_id', '=', $id);
        $workExperiences = Work_exp::all()->where('user_id', '=', $id);
        $educations = Education::all()->where('user_id', '=', $id);
        $languages = Language::all()->where('user_id', '=', $id);


        return view('trainer.view_trainee_detail')
            ->with('trainee', $trainee)
            ->with('traineeInfo', $traineeInfo)
            ->with('skills', $skills)
            ->with('workExperiences', $workExperiences)
            ->with('educations', $educations)
            ->with('languages', $languages);
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->txt_id);

        // delete photo
        if($user->photo != 'img/man_profile_icon.png' && $user->photo != 'img/woman_profile_icon.png'){
            if(File::exists(public_path($user->photo))){
                File::delete(public_path($user->photo));
            }
        }

        $user->delete();
        return redirect('/user')->with('success', 'Deleted successful');
    }

    public function deleteTrainee(Request $request)
    {
        $user = User::find($request->txt_id);

        // delete photo
        if($user->photo != 'img/man_profile_icon.png' && $user->photo != 'img/woman_profile_icon.png'){
            if(File::exists(public_path($user->photo))){
                File::delete(public_path($user->photo));
            }
        }

        $user->delete();
        return redirect('/user')->with('success', 'Deleted successful');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('trainer.edit_user')->with('user', $user);
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->input('id'));
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'sex' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        if (request('cropedImage2') != null) {
            $base64 = explode(',', request('cropedImage2'))[1];
            $image = base64_decode($base64);
            $photo = imagecreatefromstring($image);

            $name = time() . $request->first_name . '_' . $request->last_name . '_profile_pic.png';
            $destinationPath = 'img/' . $name;
            imagepng($photo, $destinationPath, 9);
            $photo = 'img/' . $name;
        } else {
            if ($request->sex == 'Female') {
                $photo = 'img/woman_profile_icon.png';
            } else {
                $photo = 'img/man_profile_icon.png';
            }
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->sex = $request->input('sex');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->photo = $photo;
        $user->save();
        return redirect('/user')->with('success', 'User updated successful');
    }

    public function editTrainee($id){
//        $user = DB::table('users')
//            ->leftJoin('trainee_infos','trainee_infos.user_id','=','users.id')
//            ->where('users.id','=',$id)->get();
//        $language =  DB::table('users')
//                    ->leftJoin('languages','languages.user_id','=','users.id')
//                    ->where('users.id','=',$id)->get();

        $trainee = User::find($id);

        $traineeInfo = DB::table('trainee_infos')
            ->where('user_id', '=', $id)
            ->first();
        $skills = Skill::all()->where('user_id', '=', $id);
        $workExperiences = Work_exp::all()->where('user_id', '=', $id);
        $educations = Education::all()->where('user_id', '=', $id);
        $languages = Language::all()->where('user_id', '=', $id);

        return view('trainer.edit_trainee')
            ->with('trainee', $trainee)
            ->with('traineeInfo', $traineeInfo)
            ->with('skills', $skills)
            ->with('workExperiences', $workExperiences)
            ->with('educations', $educations)
            ->with('languages', $languages);
    }

    public function updateTraineeCvInfo(Request $request){
        $request->validate([
            'internship_status' => 'required', Rule::in(['Doing Internship', 'Fail', 'Continue', 'Stop']),
            'position' => 'required',
            'address' => 'required',
            'height' => 'required|numeric',
            'dob' => 'required|date',
            'place_of_birth' => 'required',
            'nationality' => 'required',
            'marital_status' => 'required',
            'hobbies' => 'required',
            'reference_name' => 'required',
            'reference_position' => 'required',
            'reference_phone' => 'required',
            'reference_email' => 'required',
        ]);

        $traineeInfo = Trainee_info::find($request->id);
        $traineeInfo->internship_status = $request->internship_status;
        $traineeInfo->position = $request->position;
        $traineeInfo->address = $request->address;
        $traineeInfo->height = $request->height;
        $traineeInfo->dob = $request->dob;
        $traineeInfo->place_of_birth = $request->place_of_birth;
        $traineeInfo->nationality = $request->nationality;
        $traineeInfo->marital_status = $request->marital_status;
        $traineeInfo->hobbies = $request->hobbies;
        $traineeInfo->reference_name = $request->reference_name;
        $traineeInfo->reference_position = $request->reference_position;
        $traineeInfo->reference_phone = $request->reference_phone;
        $traineeInfo->reference_email = $request->reference_email;
        $traineeInfo->save();

        $skill = Skill::all()->where('user_id', '=', $request->user_id);
        if(sizeof($skill) > 0){
            foreach ($skill as $s) {
                Skill::destroy($s->id);
            }
        }

        $workExp = Work_exp::all()->where('user_id', '=', $request->user_id);
        if(sizeof($workExp) > 0){
            foreach ($workExp as $w) {
                Work_exp::destroy($w->id);
            }
        }

        $education = Education::all()->where('user_id', '=', $request->user_id);
        if(sizeof($education) > 0){
            foreach ($education as $e) {
                Education::destroy($e->id);
            }
        }

        $language = Language::all()->where('user_id', '=', $request->user_id);
        if(sizeof($language) > 0){
            foreach ($language as $l) {
                Language::destroy($l->id);
            }
        }


        $numberOfSkillInput = intval($request->skills);
        for($i = 1; $i <= $numberOfSkillInput; $i++){
            DB::table('skills')->insert([
                'skill' => $request->get('skill'.$i),
                'rate' => $request->get('skill_rate'.$i),
                'user_id' => $request->user_id
            ]);
        }

        $numberOfWorkExperienceInput = intval($request->work_exps);
        for ($i = 1; $i <= $numberOfWorkExperienceInput; $i++){
            DB::table('work_exps')->insert([
                'date' => $request->get('work_experience_date'.$i),
                'description' => $request->get('work_experience_description'.$i),
                'user_id' => $request->user_id
            ]);
        }

        $numberOfEducationInput = intval($request->edus);
        for($i = 1; $i <= $numberOfEducationInput; $i++){
            DB::table('education')->insert([
                'date' => $request->get('education_date'.$i),
                'description' => $request->get('education_description'.$i),
                'user_id' => $request->user_id
            ]);
        }

        $numberOfLanguageInput = intval($request->langs);
        for($i = 1; $i <= $numberOfLanguageInput; $i++){
            DB::table('languages')->insert([
                'language' => $request->get('language'.$i),
                'description' => $request->get('language_description'.$i),
                'user_id' => $request->user_id
            ]);
        }

        return redirect('user/trainee_detail/'.$request->user_id);

    }


}
