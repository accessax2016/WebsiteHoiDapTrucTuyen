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
    return [
        'data' => [
            'id' => $request->user()->id,
            'name' => $request->user()->name,
            'name_url' => $request->user()->name_url,
        ] 
    ];
});

// Question
Route::group(['prefix' => 'questions'], function() {
    Route::get('', 'QuestionController@index');
    Route::post('', 'QuestionController@store');
    Route::get('{question_id}', 'QuestionController@show');
    Route::put('{question_id}', 'QuestionController@update');
    Route::delete('{question_id}', 'QuestionController@destroy');
    Route::get('{question_id}/related', 'QuestionController@related'); 
});

// Answer
Route::group(['prefix' => 'answers'], function() {
    Route::get('{question_id}', 'AnswerController@index');
    Route::post('{question_id}', 'AnswerController@store');
    Route::put('{answer_id}', 'AnswerController@update');
    Route::delete('{answer_id}', 'AnswerController@destroy');
});

// Documentation
Route::group(['prefix' => 'documentations'], function() {
    Route::get('', 'DocumentationController@index');
    Route::post('', 'DocumentationController@store');
    Route::get('{documentation_id}', 'DocumentationController@show');
    Route::put('{documentation_id}', 'DocumentationController@update');
    Route::delete('{documentation_id}', 'DocumentationController@destroy');
    Route::get('{documentation_id}/related', 'DocumentationController@related'); 
    Route::get('{documentation_id}/related-subject', 'DocumentationController@relatedSubject'); 
});

// Comment
Route::group(['prefix' => 'comments'], function() {
    Route::post('{object_type}/{object_id}', 'CommentController@store');
    Route::put('{comment_id}', 'CommentController@update');
    Route::delete('{comment_id}', 'CommentController@destroy');
});

// Vote
Route::group(['prefix' => 'votes'], function() {
    Route::post('{object_type}/{object_id}', 'VoteController@store');
});

// Subject
Route::group(['prefix' => 'subjects'], function() {
    Route::get('', 'SubjectController@index');
});

// Tag
Route::group(['prefix' => 'tags'], function() {
    Route::get('', 'TagController@index');
    Route::post('', 'TagController@store');
});

// User
Route::group(['prefix' => 'users'], function() {
    Route::get('', 'UserController@index');
    Route::post('', 'UserController@store');
    Route::get('{user_id}', 'UserController@show');
    Route::put('{user_id}', 'UserController@update');
});

// Statistic
Route::group(['prefix' => 'statistics'], function() {
    Route::get('information-question', 'QuestionController@informationQuestion');
    Route::get('leaderboard', 'UserController@leaderboard');
    Route::get('common-tag', 'TagController@commonTag');
});

// Search
Route::group(['prefix' => 'search'], function() {
    Route::get('questions', 'QuestionController@search');
    Route::get('documentations', 'DocumentationController@search');
});
