<?php

use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('subjects')->insert([
        	['user_id'=>rand(1,10), 'name' => 'Lập Trình', 'name_url'=>changeTitle('Lập Trình'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name' => 'Microsoft Office', 'name_url'=>changeTitle('Microsoft Office'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name' => 'IT và Phần Mềm', 'name_url'=>changeTitle('IT và Phần mềm'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name' => 'Đồ Họa Hình Ảnh', 'name_url'=>changeTitle('Đồ Họa Hình Ảnh'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name' => 'Kinh Tế', 'name_url'=>changeTitle('Kinh Tế'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name' => 'Ngoại Ngữ', 'name_url'=>changeTitle('Ngoại Ngữ'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        	['user_id'=>rand(1,10), 'name' => 'Kỹ Năng Mềm', 'name_url'=>changeTitle('Kỹ Năng Mềm'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['user_id'=>rand(1,10), 'name' => 'Khác', 'name_url'=>changeTitle('Khác'), 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        ]);
    }
}
