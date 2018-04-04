<?php

use Illuminate\Database\Seeder;

class DocumentationsSeeder extends Seeder
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
        	$documentation_id = DB::table('documentations')->insertGetId(
	        	[
	        		'user_id' => $user_id,
                    'subject_id' => rand(1,7),
	        		'title' => $title,
	        		'title_url' => changeTitle($title),
                    'summary' => $faker->sentence,
	        		'content' => $faker->text(400),
	        		'link' => $faker->url,
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
                    'activitable_id' => $documentation_id,
                    'activitable_type' => 'App\Documentation',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }
    }
}
