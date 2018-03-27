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
    	$action = array(
    		'up',
    		'down'
    	);
    	$type = array(
    		'App\Question',
    		'App\Answer',
    		'App\Documentation'
    	);

    	for($i=1;$i<=100;$i++)
    	{
    		DB::table('votes')->insert(
    			[
    				'user_id' => rand(1,10),
    				'vote_action' => $action[rand(0,1)],
    				'votable_id' => rand(1,10),
    				'votable_type' => $type[rand(0,2)],
    				'created_at' => new DateTime(),
    				'updated_at' => new DateTime()
    			]
    		);
    	}
    }
}
