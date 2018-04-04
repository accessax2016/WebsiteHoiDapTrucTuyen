<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Documentation;
use App\Answer;
use App\Vote;
use Auth;
use App\Http\Requests\VoteRequest;
use Illuminate\Support\Collection;

class VoteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->only('store');
	}

    public function store(VoteRequest $request, $type, $id)
    {
    	switch ($type) {
    		case 'question':
    			$object = Question::find($id)->votes->where('user_id', Auth::id())->last();
    			if ($object) {
    				$vote = $object;
    			}
    			else {
    				$vote = new Vote;
    			}
    			$vote->votable_type = 'App\Question';
    			break;
    		case 'documentation':
    			$object = Documentation::find($id)->votes->where('user_id', Auth::id())->last();
    			if ($object) {
    				$vote = $object;
    			}
    			else {
    				$vote = new Vote;
    			}
    			$vote->votable_type = 'App\Documentation';
    			break;
    		case 'answer':
    			$object = Answer::find($id)->votes->where('user_id', Auth::id())->last();
    			if ($object) {
    				$vote = $object;
    			}
    			else {
    				$vote = new Vote;
    			}
    			$vote->votable_type = 'App\Answer';
    			break;
    		default:
    			# code...
    			break;
    	}
    	$vote->user_id = Auth::id();
    	$vote->vote_action = $request->action;
    	$vote->votable_id = $id;
    	if ($vote->save()) {
    		return [
    			'success' => 'Vote successfully'
    		];
    	}
    	return [
    		'errors' => 'Vote errors'
    	];
    }
}
