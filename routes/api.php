<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Question
Route::group(['prefix' => 'questions'], function() {
    Route::get('', 'QuestionController@index');
    Route::post('', 'QuestionController@store');
    Route::get('{question_id}', 'QuestionController@show');
    Route::put('{question_id}', 'QuestionController@update');
    Route::delete('{question_id}', 'QuestionController@destroy');
    Route::get('{question_id}/answers', 'AnswerController@index');
    Route::get('{question_id}/related-question', 'QuestionController@relatedQuestion'); 
});

// Statistic
Route::group(['prefix' => 'statistics'], function() {
    Route::get('information-question', 'QuestionController@informationQuestion');
    Route::get('leaderboard', 'UserController@leaderboard');
    Route::get('common-tag', 'TagController@commonTag');
});

Route::group(['prefix' => 'search'], function() {
    Route::get('questions', 'QuestionController@search');
});
