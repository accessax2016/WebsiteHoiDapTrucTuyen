<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documentation;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        switch ($request->sort) {
            case 'view':
                $documentations = Documentation::where('active', true)->orderByDesc('view')->orderByDesc('updated_at')->paginate(5);
                break;
            case 'answer':
                $documentations = Documentation::where('documentations.active', true)->leftJoin('answers','documentations.id','=','answers.question_id')->
                selectRaw('documentations.*, count(answers.question_id) AS `count`')->
                groupBy('documentations.id')->
                orderByDesc('count')->orderByDesc('updated_at')->
                paginate(5);
                break;
            case 'vote':
                $documentations = Documentation::where('active', true)->get();
                $documentations = $documentations->sortByDesc('updated_at')->sortByDesc(function($question) {
                    $countvotes_up = $question->votes->where('vote_action', 'up')->count();
                    $countvotes_down = $question->votes->where('vote_action', 'down')->count();
                    return $countvotes_up - $countvotes_down;
                });
                $documentations = $this->paginate($documentations, 5, $request->page,['path' => LengthAwarePaginator::resolveCurrentPath()]);
                break;
            default:    //newest
                $documentations = Documentation::where('active', true)->orderByDesc('updated_at')->paginate(5);
                break;
        }
    	return DocumentationList::collection($documentations);
    }
}
