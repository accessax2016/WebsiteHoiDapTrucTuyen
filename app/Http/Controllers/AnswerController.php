<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Http\Resources\Answer\AnswerList;

class AnswerController extends Controller
{
    public function index($question_id)
    {
    	return AnswerList::collection(Question::find($question_id)->answers->where('active', true));
    }
}
