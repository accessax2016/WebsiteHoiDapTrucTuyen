<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Comment;
use App\Http\Resources\Question\QuestionList;
use App\Http\Resources\Question\QuestionDetail;
use App\Http\Resources\Question\QuestionInformation;
use Illuminate\Support\Collection;
use App\Http\Resources\Question\QuestionRelated;
use App\Http\Requests\QuestionRequest;
use Auth;
use Carbon\Carbon;
use App\Events\TagEvent;
use App\Events\PointReputationEvent;
use App\Events\RemoveReferencesEvent;
use App\Exceptions\NotOwnerException;
use Illuminate\Pagination\LengthAwarePaginator;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'update', 'destroy');
    }

    public function index(Request $request)
    {
        switch ($request->sort) {
            case 'view':
                $questions = Question::where('active', true)->orderByDesc('view')->orderByDesc('updated_at')->paginate(5);
                break;
            case 'answer':
                $questions = Question::where('questions.active', true)->leftJoin('answers','questions.id','=','answers.question_id')->
                selectRaw('questions.*, count(answers.question_id) AS `count`')->
                groupBy('questions.id')->
                orderByDesc('count')->orderByDesc('updated_at')->
                paginate(5);
                break;
            case 'vote':
                $questions = Question::where('active', true)->get();
                $questions = $questions->sortByDesc('updated_at')->sortByDesc(function($question) {
                    $countvotes_up = $question->votes->where('vote_action', 'up')->count();
                    $countvotes_down = $question->votes->where('vote_action', 'down')->count();
                    return $countvotes_up - $countvotes_down;
                });
                $questions = $this->paginate($questions, 5, $request->page,['path' => LengthAwarePaginator::resolveCurrentPath()]);
                break;
            default:    //newest
                $questions = Question::where('active', true)->orderByDesc('updated_at')->paginate(5);
                break;
        }
    	return QuestionList::collection($questions);
    }

    public function show($id)
    {
    	return new QuestionDetail(Question::where('active', true)->find($id));
    }

    public function informationQuestion()
    {
    	$count_question = Question::where('active', true)->count();
    	$count_answer = Answer::where('active', true)->count();
    	$count_comment = Comment::where('active', true)->where('commentable_type', 'App\Question')->count();
        $result = collect([

            'questions' => $count_question, 
            'answers' => $count_answer, 
            'comments' => $count_comment
        ]);
        return new QuestionInformation($result);
    }

    public function relatedQuestion($id) {
        $question = Question::where('active', true)->find($id);
        $tags = $question->tags;
        $all_question_related = new Collection;   
        foreach ($tags as $tag) {
            $questions_related = $tag->questions->where('id', '!=', $question->id)->unique()->values();
            foreach ($questions_related as $qs) {
                $all_question_related->push($qs);
            }  
        }
        $top10_question_related = $all_question_related->unique()->sortByDesc(function($question) {
            $countvotes_up = $question->votes->where('vote_action', 'up')->count();
            $countvotes_down = $question->votes->where('vote_action', 'down')->count();
            return $countvotes_up - $countvotes_down;
        })->values()->take(10);
        return QuestionRelated::collection($top10_question_related);
    }

    public function store(QuestionRequest $request)
    {
        // Create Model Question and set properties
        $question = new Question;
        $question->user_id = Auth::id();
        $question->title = $request->title;
        $question->title_url = changeTitle($request->title);
        $question->content = $request->content;
        $question->created_at = Carbon::now();
        $question->updated_at = Carbon::now();
        $question->save();

        event(new TagEvent($question, $request->tags));
        event((new PointReputationEvent(1, 10)));

        return new QuestionDetail(Question::find($question->id));
    }

    public function update(QuestionRequest $request, $id)
    {
        $question = Question::find($id);

        $this->CheckOwner($question);

        $question->title = $request->title;
        $question->title_url = changeTitle($request->title);
        $question->content = $request->content;
        $question->save();

        event(new TagEvent($question, $request->tags));

        return new QuestionDetail(Question::find($question->id));
    }

    public function destroy($id)
    {
        $question = Question::find($id);

        $this->CheckOwner($question);

        event(new RemoveReferencesEvent($question));

        $question->delete();

        return null;
    }

    public function CheckOwner($object)
    {
        if (Auth::id() !== $object->user_id) {
            throw new NotOwnerException;
        }
    }

    public function search(Request $request)
    {
        $searchByKeyWord = $this->searchByKeyWord($request->keyword);
        $searchByTag = $this->searchByTag($request->tags);
        $collection = $searchByKeyWord->intersect($searchByTag)->sortByDesc('updated_at')
        ->sortByDesc(function($question) {
            $countvotes_up = $question->votes->where('vote_action', 'up')->count();
            $countvotes_down = $question->votes->where('vote_action', 'down')->count();
            return $countvotes_up - $countvotes_down;
        });
        $questions = $this->paginate($collection, 5, $request->page,['path' => LengthAwarePaginator::resolveCurrentPath()]);
        return QuestionList::collection($questions);
    }

    public function searchByKeyWord($keyword) {
        if ($keyword == null) {
            return Question::where('active', true)->get();
        }
        else {
            $words = explode(' ', $keyword);
            $questions = Question::where('active', true)->where(function ($query)use($words) {
                foreach($words as $word) {
                    $query->orWhere('title', 'LIKE', '%' . $word . '%');
                }
            })->get();
            return $questions;
        }
    }

    public function searchByTag($tags) {
        if ($tags == null) {
            return Question::where('active', true)->get();
        }
        else {
            $questions = Question::where('questions.active', true)->join('taggables', function($join) {
                $join->on('questions.id', '=', 'taggables.taggable_id')
                ->where('taggables.taggable_type', '=', 'App\Question');
            })->join('tags', function($join) use ($tags) {
                $join->on('taggables.tag_id', '=', 'tags.id')
                ->whereIn('tags.id', explode(',', $tags));
            })
            ->select('questions.*')->distinct()->get();
            return $questions;
        }
    }
}
