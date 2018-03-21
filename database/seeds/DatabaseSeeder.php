<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(PermissionsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(AnswersSeeder::class);
        $this->call(TaggablesSeeder::class);
        $this->call(DocumentationsSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(SubjectsSeeder::class);
        $this->call(VotesSeeder::class);
    }
}
