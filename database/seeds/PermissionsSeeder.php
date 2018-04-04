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
        $faker = Faker\Factory::create();
        $date = $faker->dateTimeThisYear();
        DB::table('permissions')->insert([
        	['name'=>'Member', 'name_url'=>changeTitle('Member'), 'created_at' => $date, 'updated_at' => $date],
        	['name'=>'Admin', 'name_url'=>changeTitle('Admin'), 'created_at' => $date, 'updated_at' => $date],
        ]);
    }
}
