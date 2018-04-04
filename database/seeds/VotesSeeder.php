<?php

use Illuminate\Database\Seeder;

class VotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
    	$action = array(
    		'up',
    		'down'
    	);
    	$type = array(
    		'App\Question',
    		'App\Documentation',
            // 'App\Answer',
    	);

    	for($i=1;$i<=5000;$i++)
    	{
            $date = $faker->dateTimeThisYear;
    		DB::table('votes')->insert(
    			[
    				'user_id' => rand(1,100),
    				'vote_action' => $action[rand(0,1)],
    				'votable_id' => rand(1,500),
    				'votable_type' => $type[rand(0,1)],
    				'created_at' => $date,
    				'updated_at' => $date
    			]
    		);
    	}

        for($i=1;$i<=5000;$i++)
        {
            $date = $faker->dateTimeThisYear;
            DB::table('votes')->insert(
                [
                    'user_id' => rand(1,100),
                    'vote_action' => $action[rand(0,1)],
                    'votable_id' => rand(1,1000),
                    'votable_type' => 'App\Answer',
                    'created_at' => $date,
                    'updated_at' => $date
                ]
            );
        }
    }
}
