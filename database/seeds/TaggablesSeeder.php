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
        $faker = Faker\Factory::create();
    	$type = array(
    		'App\Question',
    		'App\Documentation'
    		);
        for($i = 1; $i <= 3000; $i++)
        {
            $date = $faker->dateTimeThisYear;
        	DB::table('taggables')->insert(
	        	[
	        		'tag_id' => rand(1,20),
	        		'taggable_id' => rand(1,500),
	        		'taggable_type' => $type[rand(0,1)],
	            	'created_at' => $date,
                    'updated_at' => $date
	        	]
        	);
        }
    }
}
