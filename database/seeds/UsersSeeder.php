<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = array(
            'Học sinh',
            'Sinh viên',
            'Lập trình viên',
            'Nhân viên văn phòng',
            'Giám đốc'
        );
        for($i = 1; $i <= 10; $i++)
        {
        	DB::table('users')->insert(
              [
                 'permission_id' => 1,
                 'name' => 'User_'.$i,
                 'name_url'=>changeTitle('User_'.$i),
                 'status' => 'Common Baby!',
                 'about' => 'Hi, I am User_'.$i,
                 'location' => 'TP.HCM',
                 'job' => $job[rand(0,4)],
                 'avatar' => 'default_avatar.png',
                 'email' => 'user_'.$i.'@gmail.com',
                 'password' => bcrypt('123456'),
                 // 'point_reputation' => rand(100,1000),
                 'last_activity_time' => new DateTime(),
                 'created_at' => new DateTime(),
                 'updated_at' => new DateTime()
             ]
         );
        }
        //Admin account
        DB::table('users')->insert(
            [
                'permission_id' => 2,
                'name' => 'Thanh Tùng',
                'name_url'=>changeTitle('Thanh Tùng'),
                'status' => 'Common Baby!',
                'about' => 'Hi, I am Admin',
                'location' => 'TP.HCM',
                'job' => $job[rand(0,4)],
                'avatar' => 'k17.jpg',
                'email' => 'nguyenhoangthanhtung1610@gmail.com',
                'password' => bcrypt('123456'),
                // 'point_reputation' => rand(100,1000),
                'last_activity_time' => new DateTime(),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        );
        DB::table('users')->insert(
            [
                'permission_id' => 2,
                'name' => 'Đinh Sa',
                'name_url'=>changeTitle('Đinh Sa'),
                'status' => 'Common Baby!',
                'about' => 'Hi, I am Admin',
                'location' => 'TP.HCM',
                'job' => $job[rand(0,4)],
                'avatar' => 'avata.png',
                'email' => 'dinhsa@gmail.com',
                'password' => bcrypt('123456'),
                // 'point_reputation' => rand(100,1000),
                'last_activity_time' => new DateTime(),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]
        );
    }
}
