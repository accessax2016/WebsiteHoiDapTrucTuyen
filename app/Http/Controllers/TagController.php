<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Resources\Tag\TagCommon;

class TagController extends Controller
{
	public function commonTag()
	{
		$result = Tag::where('tags.active', true)->
				join('taggables','taggables.tag_id','=','tags.id')->
				selectRaw('count(taggables.tag_id) AS `kount`, tags.id, tags.name')->
				groupBy('tags.id')->
				orderBy('kount', 'desc')->
				get()->take(10);
		return TagCommon::collection($result);
	}
}
