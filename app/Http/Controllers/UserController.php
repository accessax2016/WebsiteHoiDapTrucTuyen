<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User\UserLeaderBoard;

class UserController extends Controller
{
    public function leaderboard()
    {
    	$result = User::where('active', true)->orderByDesc('point_reputation')->orderBy('name')->get()->take(10);
    	return UserLeaderBoard::collection($result);
    }
}
