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
        $faker = Faker\Factory::create();
        $date = $faker->dateTimeThisYear();
        DB::table('tags')->insert([
        	['user_id'=>rand(1,100), 'name'=>'PHP', 'name_url'=>changeTitle('PHP'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'C#', 'name_url'=>changeTitle('C#'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'AngularJS', 'name_url'=>changeTitle('AngularJS'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'Android', 'name_url'=>changeTitle('Android'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'Java', 'name_url'=>changeTitle('Java'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'C++', 'name_url'=>changeTitle('C++'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'Python', 'name_url'=>changeTitle('Python'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'MongoDB', 'name_url'=>changeTitle('MongoDB'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'SQL', 'name_url'=>changeTitle('SQL'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'MySQL', 'name_url'=>changeTitle('MySQL'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'Laravel', 'name_url'=>changeTitle('Laravel'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'NodeJS', 'name_url'=>changeTitle('NodeJS'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'Reactive', 'name_url'=>changeTitle('Reactive'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'ExpressJS', 'name_url'=>changeTitle('ExpressJS'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'iOS', 'name_url'=>changeTitle('iOS'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'CSS', 'name_url'=>changeTitle('CSS'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'JavaScript', 'name_url'=>changeTitle('JavaScript'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'ASP.NET', 'name_url'=>changeTitle('ASP.NET'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'R', 'name_url'=>changeTitle('R'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	['user_id'=>rand(1,100), 'name'=>'HTML', 'name_url'=>changeTitle('HTML'), 'description'=>$faker->paragraph, 'created_at' => $date, 'updated_at' => $date],
        	]);
    }
}
