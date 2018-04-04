<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Question;
use App\Documentation;
use App\Answer;
use App\Http\Requests\CommentRequest;
use Auth;
use App\Events\ActivityEvent;
use App\Http\Resources\Comment\CommentList;

class CommentController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->only('store', 'update', 'destroy');
	}

    public function store(CommentRequest $request, $type, $id)
    {
    	$comment = new Comment;
    	$comment->user_id = Auth::id();
    	$comment->commentable_id = $id;
    	switch ($type) {
    		case 'question':
    			$comment->commentable_type = 'App\Question';
    			$object = Question::find($id);
    			break;
    		case 'documentation':
    			$comment->commentable_type = 'App\Documentation';
    			$object = Documentation::find($id);
    			break;
    		case 'answer':
    			$comment->commentable_type = 'App\Answer';
    			$object = Answer::find($id);
    			break;
    		default:
    			# code...
    			break;
    	}
    	$comment->content = $request->content;
    	$comment->save();

    	event(new ActivityEvent($object, 'đã bình luận'));

    	return new CommentList($comment);
    }

    public function update(CommentRequest $request, $id)
    {
    	$comment = Comment::find($id);

    	$this->CheckOwner($comment);

    	$comment->content = $request->content;
    	$comment->save();

    	event(new ActivityEvent($comment, 'đã chỉnh sửa'));

    	return new CommentList($comment);
    }

    public function destroy($id)
    {
    	$comment = Comment::find($id);

    	$this->CheckOwner($comment);

    	event(new ActivityEvent($comment, 'đã xóa'));

    	$comment->delete();

    	return null;
    }
}
