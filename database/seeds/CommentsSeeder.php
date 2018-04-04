<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Documentation;
use App\Answer;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    	$type = array(
    		'App\Question',
    		'App\Documentation',
            // 'App\Answer',
    	);

    	for($i=1;$i<=1000;$i++)
    	{
            $date = $faker->dateTimeThisYear;
            $user_id = rand(1,100);
            $question_id = rand(1,500);
	        DB::table('comments')->insert(
	        	[
	        		'user_id' => $user_id,
	        		'commentable_id' => $question_id,
	        		'commentable_type' => 'App\Question',
	            	'content' => $faker->sentence,
	            	'created_at' => $date,
                    'updated_at' => $date
	        	]
	    	);
            $question = Question::find($question_id);
            DB::table('activities')->insert(
                [
                    'user_id' => $user_id,
                    'user_related_id' => $question->user_id,
                    'content' => 'đã bình luận',
                    'activitable_id' => $question->id,
                    'activitable_type' => 'App\Question',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
    	}

        for($i=1;$i<=1000;$i++)
        {
            $date = $faker->dateTimeThisYear;
            $user_id = rand(1,100);
            $documentation_id = rand(1,500);
            DB::table('comments')->insert(
                [
                    'user_id' => $user_id,
                    'commentable_id' => $documentation_id,
                    'commentable_type' => 'App\Documentation',
                    'content' => $faker->sentence,
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
            $documentation = Documentation::find($documentation_id);
            DB::table('activities')->insert(
                [
                    'user_id' => $user_id,
                    'user_related_id' => $documentation->user_id,
                    'content' => 'đã bình luận',
                    'activitable_id' => $documentation->id,
                    'activitable_type' => 'App\Documentation',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }

        for($i=1;$i<=3000;$i++)
        {
            $date = $faker->dateTimeThisYear;
            $user_id = rand(1,100);
            $answer_id = rand(1,1000);
            DB::table('comments')->insert(
                [
                    'user_id' => $user_id,
                    'commentable_id' => $answer_id,
                    'commentable_type' => 'App\Answer',
                    'content' => $faker->sentence,
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
            $answer = Answer::find($answer_id);
            DB::table('activities')->insert(
                [
                    'user_id' => $user_id,
                    'user_related_id' => $answer->user_id,
                    'content' => 'đã bình luận',
                    'activitable_id' => $answer->id,
                    'activitable_type' => 'App\Answer',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }
    }
}
