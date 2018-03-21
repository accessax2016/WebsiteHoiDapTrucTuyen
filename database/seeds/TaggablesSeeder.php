<?php

use Illuminate\Database\Seeder;

class TaggablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$type = array(
    		'App\Question',
    		'App\Documentation'
    		);
        for($i = 1; $i <= 100; $i++)
        {
        	DB::table('taggables')->insert(
	        	[
	        		'tag_id' => rand(1,20),
	        		'taggable_id' => rand(1,10),
	        		'taggable_type' => $type[rand(0,1)],
	            	'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
	        	]
        	);
        }
    }
}
