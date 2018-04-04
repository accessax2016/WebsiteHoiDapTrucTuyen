<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Http\Resources\Answer\AnswerList;
use App\Http\Requests\AnswerRequest;
use Auth;
use App\Events\ActivityEvent;
use App\Events\PointReputationEvent;
use App\Events\RemoveReferencesEvent;
use Illuminate\Pagination\LengthAwarePaginator;

class AnswerController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->only('store', 'update', 'destroy');
	}

	public function index($question_id)
	{
		$answers = Question::find($question_id)->answers->sortByDesc('best_answer')
			->sortByDesc(function($answer) {
				$countvotes_up = $answer->votes->where('vote_action', 'up')->count();
				$countvotes_down = $answer->votes->where('vote_action', 'down')->count();
				return $countvotes_up - $countvotes_down;
			});
		// $answers = $this->paginate($answers, 10, $request->page,['path' => LengthAwarePaginator::resolveCurrentPath()]);
		return AnswerList::collection($answers);
	}

	public function store(AnswerRequest $request, $question_id)
	{
		$question = Question::find($question_id);

		$answer = new Answer;
		$answer->user_id = Auth::id();
		$answer->question_id = $question->id;
		$answer->content = $request->content;
		$answer->save();

		event(new ActivityEvent($question, 'đã trả lời'));
		event((new PointReputationEvent(1, 10)));

		return new AnswerList($answer);
	}

	public function update(AnswerRequest $request, $id)
	{
		$answer = Answer::find($id);

		$this->CheckOwner($answer);

		$answer->content = $request->content;
		$answer->save();

		event(new ActivityEvent($answer, 'đã chỉnh sửa'));

		return new AnswerList($answer);
	}

	public function destroy($id)
	{
		$answer = Answer::find($id);

		$this->CheckOwner($answer);

		event(new ActivityEvent($answer, 'đã xóa'));
		event(new RemoveReferencesEvent($answer));
		event((new PointReputationEvent(0, 10)));

		$answer->delete();

		return null;
	}
}
