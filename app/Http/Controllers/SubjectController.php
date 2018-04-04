<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Http\Resources\Subject\SubjectResource;

class SubjectController extends Controller
{
    public function index()
    {
    	$subjects = Subject::get();
    	return SubjectResource::collection($subjects);
    }
}
