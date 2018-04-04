<?php

use Illuminate\Database\Seeder;
use App\Question;

class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 1; $i <= 1000; $i++)
        {
            $date = $faker->dateTimeThisYear;
            $user_id = rand(1,100);
            $question_id = rand(1,500);
        	DB::table('answers')->insert(
	        	[
	        		'user_id' => $user_id,
	        		'question_id' => $question_id,
	        		'content' => $faker->text(300),
	            	'created_at' => $date,
                    'updated_at' => $date
	        	]
        	);
            $question = Question::find($question_id);
            DB::table('activities')->insert(
                [
                    'user_id' => $user_id,
                    'user_related_id' => $question->user_id,
                    'content' => 'đã trả lời',
                    'activitable_id' => $question->id,
                    'activitable_type' => 'App\Question',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }
    }
}
