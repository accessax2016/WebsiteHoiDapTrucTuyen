<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Resources\Tag\TagCommon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\TagRequest;
use App\Http\Resources\Tag\TagList;
use Auth;
use Carbon\Carbon;

class TagController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api')->only('store');
	}

	public function commonTag()
	{
		$result = Tag::join('taggables','taggables.tag_id','=','tags.id')->
		selectRaw('count(taggables.tag_id) AS `kount`, tags.id, tags.name')->
		groupBy('tags.id')->
		orderBy('kount', 'desc')->
		get()->take(10);
		return TagCommon::collection($result);
	}

	public function index(Request $request)
	{
		$words = explode(' ', $request->keyword);
		$tags = Tag::where(function ($query)use($words) {
			foreach ($words as $word) {
				$query->orWhere('name', 'LIKE', '%' . $word . '%');
			}
		})
		->leftJoin('taggables','taggables.tag_id','=','tags.id')->
		selectRaw('count(taggables.tag_id) AS `kount`, tags.*')->
		groupBy('tags.id')->get();
		switch ($request->sort) {
			case 'name':
			$tags = $tags->sortBy('name_url');
			break;
			case 'newest':
			$tags = $tags->sortByDesc('created_at');
			break;
            default:    //popular
            $tags = $tags->sortByDesc('kount');
            break;
        }
        $tags = $this->paginate($tags, 16, $request->page,['path' => LengthAwarePaginator::resolveCurrentPath()]);
        return TagList::collection($tags);
    }

    public function store(TagRequest $request)
    {
        // Create Model Tag and set properties
    	$tag = new Tag;
    	$tag->user_id = Auth::id();
    	$tag->name = $request->name;
    	$tag->name_url = changeTitle($request->name);
    	$tag->description = $request->description;
    	$tag->created_at = Carbon::now();
    	$tag->updated_at = Carbon::now();
    	$tag->save();
    	
    	return new TagList($tag);  
    }
}
