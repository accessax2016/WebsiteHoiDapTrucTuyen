<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
        	['user_id'=>rand(1,10), 'name'=>'PHP', 'name_url'=>changeTitle('PHP'), 'description'=>'PHP iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'C#', 'name_url'=>changeTitle('C#'), 'description'=>'C# iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'AngularJS', 'name_url'=>changeTitle('AngularJS'), 'description'=>'AngularJS iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'Android', 'name_url'=>changeTitle('Android'), 'description'=>'Android iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'Java', 'name_url'=>changeTitle('Java'), 'description'=>'Java iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'C++', 'name_url'=>changeTitle('C++'), 'description'=>'C++ iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'Python', 'name_url'=>changeTitle('Python'), 'description'=>'Python iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'MongoDB', 'name_url'=>changeTitle('MongoDB'), 'description'=>'MongoDB iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'SQL', 'name_url'=>changeTitle('SQL'), 'description'=>'SQL iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'MySQL', 'name_url'=>changeTitle('MySQL'), 'description'=>'MySQL iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'Laravel', 'name_url'=>changeTitle('Laravel'), 'description'=>'Laravel iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'NodeJS', 'name_url'=>changeTitle('NodeJS'), 'description'=>'NodeJS iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'Reactive', 'name_url'=>changeTitle('Reactive'), 'description'=>'Reactive iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'ExpressJS', 'name_url'=>changeTitle('ExpressJS'), 'description'=>'ExpressJS iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'iOS', 'name_url'=>changeTitle('iOS'), 'description'=>'iOS iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'CSS', 'name_url'=>changeTitle('CSS'), 'description'=>'CSS iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'JavaScript', 'name_url'=>changeTitle('JavaScript'), 'description'=>'JavaScript iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'ASP.NET', 'name_url'=>changeTitle('ASP.NET'), 'description'=>'ASP.NET iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'R', 'name_url'=>changeTitle('R'), 'description'=>'R iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'HTML', 'name_url'=>changeTitle('HTML'), 'description'=>'HTML iz da bezt', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	]);
    }
}
