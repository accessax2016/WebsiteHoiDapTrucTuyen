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
        $faker = Faker\Factory::create();
        for ($i=1; $i<=100 ; $i++) {
            $name = $faker->name;
            $date = $faker->dateTimeThisYear;
            DB::table('users')->insert([
               'name' => $name,
               'name_url'=>changeTitle($name),
               'status' => $faker->sentence,
               'about' => $faker->sentence,
               'location' => $faker->city,
               'job' => $faker->jobTitle,
               'email' => $faker->unique()->safeEmail,
               'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
               'point_reputation' => $faker->numberBetween(100, 1000),
               'remember_token' => str_random(10),
               'last_online_at' => $date,
               'created_at' => $date,
               'updated_at' => $date
            ]);
        }
        // $job = array(
        //     'Học sinh',
        //     'Sinh viên',
        //     'Lập trình viên',
        //     'Nhân viên văn phòng',
        //     'Giám đốc'
        // );
        // for($i = 1; $i <= 100; $i++)
        // {
        	// DB::table('users')->insert(
         //      [
         //         'permission_id' => 1,
         //         'name' => 'User_'.$i,
         //         'name_url'=>changeTitle('User_'.$i),
         //         'status' => 'Common Baby!',
         //         'about' => 'Hi, I am User_'.$i,
         //         'location' => 'TP.HCM',
         //         'job' => $job[rand(0,4)],
         //         'avatar' => 'default_avatar.png',
         //         'email' => 'user_'.$i.'@gmail.com',
         //         'password' => bcrypt('123456'),
         //         'point_reputation' => rand(100,1000),
         //         'last_activity_time' => new DateTime(),
         //         'created_at' => new DateTime(),
         //         'updated_at' => new DateTime()
         //     ]
         // );
        // }
        // //Admin account
        // DB::table('users')->insert(
        //     [
        //         'permission_id' => 2,
        //         'name' => 'Thanh Tùng',
        //         'name_url'=>changeTitle('Thanh Tùng'),
        //         'status' => 'Common Baby!',
        //         'about' => 'Hi, I am Admin',
        //         'location' => 'TP.HCM',
        //         'job' => $job[rand(0,4)],
        //         'avatar' => 'k17.jpg',
        //         'email' => 'thanhtung@gmail.com',
        //         'password' => bcrypt('123456'),
        //         'point_reputation' => rand(100,1000),
        //         'last_activity_time' => new DateTime(),
        //         'created_at' => new DateTime(),
        //         'updated_at' => new DateTime()
        //     ]
        // );
        // DB::table('users')->insert(
        //     [
        //         'permission_id' => 2,
        //         'name' => 'Đinh Sa',
        //         'name_url'=>changeTitle('Đinh Sa'),
        //         'status' => 'Common Baby!',
        //         'about' => 'Hi, I am Admin',
        //         'location' => 'TP.HCM',
        //         'job' => $job[rand(0,4)],
        //         'avatar' => 'avata.png',
        //         'email' => 'dinhsa@gmail.com',
        //         'password' => bcrypt('123456'),
        //         'point_reputation' => rand(100,1000),
        //         'last_activity_time' => new DateTime(),
        //         'created_at' => new DateTime(),
        //         'updated_at' => new DateTime()
        //     ]
        // );
    }
}
