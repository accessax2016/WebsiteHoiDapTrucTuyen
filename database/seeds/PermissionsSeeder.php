<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
        	['user_id'=>rand(1,10), 'name'=>'Thành Viên', 'name_url'=>changeTitle('Thành Viên'), 'key'=>'1', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name'=>'Quản Trị Viên', 'name_url'=>changeTitle('Quản Trị Viên'), 'key'=>'2', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	]);
    }
}
