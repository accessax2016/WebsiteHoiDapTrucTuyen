<?php

use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
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
    		'App\Answer',
    		'App\Documentation'
    		);
        $content = array(
    		'Bài viết rất hay',
    		'Tôi rất thích bài viết này',
    		'Bài viết này tạm ổn',
    		'Hay quá trời',
    		'Tôi sẽ học thèo bài viết này',
    		'Bài viết này chưa được hay lắm',
    		'Ý kiến của tôi khác so với bài này',
    		'Bài viết này được',
    		'Không thích bài viết này',
    		'Tôi chưa có ý kiến gì'
    	);

    	for($i=1;$i<=100;$i++)
    	{
	        DB::table('comments')->insert(
	        	[
	        		'user_id' => rand(1,10),
	        		'commentable_id' => rand(1,10),
	        		'commentable_type' => $type[rand(0,2)],
	            	'content' => $content[rand(0,9)],
	            	'created_at' => new DateTime(),
                    'updated_at' => new DateTime()
	        	]
	    	);
    	}
    }
}
