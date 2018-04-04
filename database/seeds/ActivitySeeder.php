<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
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
    		'App\Documentation',
            // 'App\Answer',
    		);

    	$content = array(
    		'đã đăng',
    		'đã bình luận',
    		'đã trả lời',
    	);

        // Documentation
        for($i = 1; $i <= 500; $i++)
        {
            DB::table('activities')->insert(
                [
                    'user_id' => rand(1,100),
                    'user_related_id' => rand(1,100),
                    'content' => 'đã đăng',
                    'activitable_id' => rand(1,500),
                    'activitable_type' => 'App\Documentation',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
                ]
            );
        }

        for($i = 1; $i <= 500; $i++)
        {
        	DB::table('activities')->insert(
	        	[
	        		'user_id' => rand(1,100),
	        		'user_related_id' => rand(1,100),
	        		'content' => 'đã bình luận',
	        		'activitable_id' => rand(1,500),
	        		'activitable_type' => 'App\Documentation',
	            	'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
	        	]
        	);
        }

        // Question
        for($i = 1; $i <= 500; $i++)
        {
            DB::table('activities')->insert(
                [
                    'user_id' => rand(1,100),
                    'user_related_id' => rand(1,100),
                    'content' => 'đã đăng',
                    'activitable_id' => rand(1,500),
                    'activitable_type' => 'App\Question',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
                ]
            );
        }

        for($i = 1; $i <= 500; $i++)
        {
            DB::table('activities')->insert(
                [
                    'user_id' => rand(1,100),
                    'user_related_id' => rand(1,100),
                    'content' => $content[rand(1,2)],
                    'activitable_id' => rand(1,500),
                    'activitable_type' => 'App\Question',
                    'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
                ]
            );
        }

        for($i = 1; $i <= 1000; $i++)
        {
        	DB::table('activities')->insert(
	        	[
	        		'user_id' => rand(1,100),
	        		'user_related_id' => rand(1,100),
	        		'content' => 'đã bình luận',
	        		'activitable_id' => rand(1,1000),
	        		'activitable_type' => 'App\Answer',
	            	'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
	        	]
        	);
        }
    }
}
