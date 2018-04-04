<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User\UserLeaderBoard;
use App\Http\Resources\User\UserList;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use App\Http\Resources\User\UserInformation;
use App\Http\Requests\UserInformationRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('update');
    }

    public function leaderboard()
    {
    	$result = User::where('active', true)->orderByDesc('point_reputation')->orderBy('name')->get()->take(10);
    	return UserLeaderBoard::collection($result);
    }

    public function index(Request $request)
    {
    	$words = explode(' ', $request->keyword);
		$users = User::where('users.active', true)
		->where(function ($query)use($words) {
			foreach ($words as $word) {
				$query->orWhere('name', 'LIKE', '%' . $word . '%');
			}
		})->get();
		switch ($request->sort) {
			case 'name':
			$users = $users->sortBy('name_url');
			break;
			case 'newest':
			$users = $users->sortByDesc('created_at');
			break;
            default:    //point
            $users = $users->sortByDesc('point_reputation');
            break;
        }
    	return UserList::collection($users);
    }

    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->name_url = changeTitle($request->name);
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();

        if ($user->save()) {
            return [
                'success' => 'Register successfully'
            ];
        }
        return [
            'errors' => 'Register errors'
        ];
    }

    public function show($id)
    {
        return new UserInformation(User::where('active', true)->find($id));
    }

    public function update(UserInformationRequest $request)
    {
        
    }
}
