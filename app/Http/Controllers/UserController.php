<?php

namespace App\Http\Controllers;

use App\Evaluation;
use Carbon\Carbon;
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

        if($user->type == 'Trainee'){
            session(['trainee_detail_tab' => 'about']);
        }
//        return redirect('/user')->with('success', 'User updated successful');
        return redirect('user/trainee_detail/'.$user->id);
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
        if($request->id == -1){
            $traineeInfo = new Trainee_info;
        }else{
            $traineeInfo = Trainee_info::find($request->id);
        }

        $traineeInfo->user_id = $request->user_id;
        $traineeInfo->internship_status = $request->internship_status;
        $traineeInfo->contract_start = $request->contract_start;
        $traineeInfo->contract_end = $request->contract_end;
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

        session(['trainee_detail_tab' => 'more']);

        return redirect('user/trainee_detail/'.$request->user_id);

    }

    public function showDashboard(){
        $colors = array('#d11141', '#f37735', '#00b159', '#00aedb', '#ffc425', '#3d1e6d', ' #ff3377', ' #854442', '#008744', '#009688', '#4a4e4d', '#851e3e', '#3b5998');

        $currentYear = Carbon::now()->year;

        $totalTrainee = sizeof(DB::table('trainee_infos')->where('internship_status', '=', 'Doing Internship')->get());

        $technology = DB::table('trainee_infos')->select(['position'])->distinct()->get();
        $traineeEachTechnologyPosition = array();
        $traineeEachTechnologyNumber = array();

        foreach ($technology as $t) {
            $numberOfPeople = sizeof(DB::table('trainee_infos')->where('internship_status', '=', 'Doing Internship')->where('position', '=', $t->position)->get());
            array_push($traineeEachTechnologyPosition, $t->position);
            array_push($traineeEachTechnologyNumber, $numberOfPeople);
        }
        $traineeEachTechnologyColor = array();
        for($i = 0; $i < sizeof($traineeEachTechnologyNumber); $i++){
            array_push($traineeEachTechnologyColor, $colors[$i]);
        }


        // get month that has evaluation
        $evaluationMonths = DB::table('evaluations')->selectRaw('month(date) as month')->whereYear('date', '=', $currentYear)->distinct()->get();
        $temp = array();
        foreach ($evaluationMonths as $month){
            array_push($temp, $month->month);
        }
        $evaluationMonths = $temp;
        sort($evaluationMonths);

        $allEvaluationData = array();

        // get evaluation for each month
        foreach ($evaluationMonths as $month) {
            $evaluationGradeA = 0;
            $evaluationGradeB = 0;
            $evaluationGradeC = 0;
            $evaluations = DB::table('evaluations')
                ->join('users', 'evaluations.user_id', '=', 'users.id')
                ->join('trainee_infos', 'users.id', '=', 'trainee_infos.user_id')
                ->where('trainee_infos.internship_status', '=', 'Doing Internship')
                ->whereMonth('evaluations.date', $month)
                ->get();

            foreach ($evaluations as $evaluation){
                $logicalThinkingScore = $evaluation->logical_thinking;
                if($logicalThinkingScore == 'A'){
                    $logicalThinkingScore = 100;
                }else if($logicalThinkingScore == 'B'){
                    $logicalThinkingScore = 75;
                }else{
                    $logicalThinkingScore = 50;
                }
                $logicalThinkingScore = ($logicalThinkingScore * 35) / 100;

                $skillScore = $evaluation->skills;
                if($skillScore == 'A'){
                    $skillScore = 100;
                }else if($skillScore == 'B'){
                    $skillScore = 75;
                }else{
                    $skillScore = 50;
                }
                $skillScore = ($skillScore * 35) / 100;

                $attitudeScore = $evaluation->attitudes;
                if($attitudeScore == 'A'){
                    $attitudeScore = 100;
                }else if($attitudeScore == 'B'){
                    $attitudeScore = 75;
                }else{
                    $attitudeScore = 50;
                }
                $attitudeScore = ($attitudeScore * 30) / 100;

                $totalScore = $logicalThinkingScore + $skillScore + $attitudeScore;

                if($totalScore >= 75){
                    $totalScore = 'A';
                    $evaluationGradeA += 1;
                }else if($totalScore >= 50 && $totalScore < 75){
                    $totalScore = 'B';
                    $evaluationGradeB += 1;
                }else if($totalScore < 50){
                    $totalScore = 'C';
                    $evaluationGradeC += 1;
                }

            }
            array_push($allEvaluationData, array('month' => $month, 'a' => $evaluationGradeA, 'b' => $evaluationGradeB, 'c' => $evaluationGradeC));
        }
        $evaluationMonths = array();
        $evaluationGradeAs = array();
        $evaluationGradeBs = array();
        $evaluationGradeCs = array();
        foreach ($allEvaluationData as $evaluation){
            array_push($evaluationMonths, $this->numericMonthToText($evaluation['month']));
            array_push($evaluationGradeAs, $evaluation['a']);
            array_push($evaluationGradeBs, $evaluation['b']);
            array_push($evaluationGradeCs, $evaluation['c']);
        }



        $months = DB::table('trainee_infos')->selectRaw('month(contract_start) as month')->where('internship_status', '=', 'Doing Internship')->whereYear('contract_start', '=', $currentYear)->orderBy('contract_start')->get();
        $distinctMonths = array();


        foreach ($months as $month) {
            if(in_array($month->month, $distinctMonths)){
                continue;
            }else{
                array_push($distinctMonths, $month->month);
            }
        }


        $min_month = min($distinctMonths);
        $max_month = max($distinctMonths);

        $numberOfTraineePerMonthMonth = array();
        $numberOfTraineePerMonthNumber = array();
        for ($i = $min_month; $i <= $max_month; $i++){
            $number = DB::table('trainee_infos')
                ->selectRaw('month(contract_start) as month')
                ->whereYear('contract_start', '=', $currentYear)
                ->whereMonth('contract_start', '<=', $i)
                ->where('internship_status', '=', 'Doing Internship')
                ->get()->count();

            array_push($numberOfTraineePerMonthMonth, $this->numericMonthToText($i));
            array_push($numberOfTraineePerMonthNumber, $number);
        }

        $numberOfTraineePerMonthByStatusMonths = array();
        $numberOfTraineePerMonthByStatusFails = array();
        $numberOfTraineePerMonthByStatusStops = array();
        $numberOfTraineePerMonthByStatusContinues = array();
        $numberOfTraineePerMonthByStatusDoingInternships = array();
        $months = DB::table('trainee_infos')->selectRaw('month(contract_start) as month')->whereYear('contract_start', '=', $currentYear)->orderBy('contract_start')->get();
        $distinctMonths = [];

        foreach ($months as $month) {
            if(in_array($month->month, $distinctMonths)){
                continue;
            }else{
                array_push($distinctMonths, $month->month);
            }
        }
        foreach ($distinctMonths as $month){
            $doing_internship = DB::table('trainee_infos')
                ->whereYear('contract_start', '=', $currentYear)
                ->whereMonth('contract_start', '<=', $month)
                ->where('internship_status', '=', 'Doing Internship')
                ->get()->count();
            $continue = DB::table('trainee_infos')
                ->whereYear('contract_start', '=', $currentYear)
                ->whereMonth('contract_start', '<=', $month)
                ->where('internship_status', '=', 'Continue')
                ->get()->count();
            $fail = DB::table('trainee_infos')
                ->whereYear('contract_start', '=', $currentYear)
                ->whereMonth('contract_start', '<=', $month)
                ->where('internship_status', '=', 'Fail')
                ->get()->count();
            $stop = DB::table('trainee_infos')
                ->whereYear('contract_start', '=', $currentYear)
                ->whereMonth('contract_start', '<=', $month)
                ->where('internship_status', '=', 'Stop')
                ->get()->count();
            array_push($numberOfTraineePerMonthByStatusMonths, $this->numericMonthToText($month));
            array_push($numberOfTraineePerMonthByStatusFails, $fail);
            array_push($numberOfTraineePerMonthByStatusStops, $stop);
            array_push($numberOfTraineePerMonthByStatusContinues, $continue);
            array_push($numberOfTraineePerMonthByStatusDoingInternships, $doing_internship);
        }

        return view('trainer.dashboard')
            ->with('colors', $colors)
            ->with('total_trainee', $totalTrainee)

            ->with('trainee_each_tech_position', $traineeEachTechnologyPosition)
            ->with('trainee_each_tech_number', $traineeEachTechnologyNumber)
            ->with('trainee_each_tech_color', $traineeEachTechnologyColor)

            ->with('evaluation_months', $evaluationMonths)
            ->with('evaluation_grade_a', $evaluationGradeAs)
            ->with('evaluation_grade_b', $evaluationGradeBs)
            ->with('evaluation_grade_c', $evaluationGradeCs)

            ->with('trainee_per_month_month', $numberOfTraineePerMonthMonth)
            ->with('trainee_per_month_number', $numberOfTraineePerMonthNumber)

            ->with('trainee_per_month_by_status_month', $numberOfTraineePerMonthByStatusMonths)
            ->with('trainee_per_month_by_status_fail', $numberOfTraineePerMonthByStatusFails)
            ->with('trainee_per_month_by_status_stop', $numberOfTraineePerMonthByStatusStops)
            ->with('trainee_per_month_by_status_continue', $numberOfTraineePerMonthByStatusContinues)
            ->with('trainee_per_month_by_status_doing_internship', $numberOfTraineePerMonthByStatusDoingInternships);
    }

    public function numericMonthToText($month){
        $months = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        return $months[$month];
    }
}
