<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;

class EvaluationController extends Controller
{
    public function showList(){
        return view('trainer.evaluation_list');
    }
}
