<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i = 1; $i <= 500; $i++)
        {
            $title = $faker->sentence;
            $date = $faker->dateTimeThisYear;
            $user_id = rand(1,100);
        	$question_id = DB::table('questions')->insertGetId(
	        	[
	        		'user_id' => $user_id,
	        		'title' => $title,
	        		'title_url' => changeTitle($title),
	        		'content' => $faker->text(400),
                    'view' => rand(100,2000),
	            	'created_at' => $date,
                    'updated_at' => $date
	        	]
        	);

            DB::table('activities')->insert(
                [
                    'user_id' => $user_id,
                    'user_related_id' => $user_id,
                    'content' => 'đã đăng',
                    'activitable_id' => $question_id,
                    'activitable_type' => 'App\Question',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }
    }
}
