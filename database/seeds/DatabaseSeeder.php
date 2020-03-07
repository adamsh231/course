<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i <= 20; $i++) {
            DB::table('siswa')->insert([
                'id' => $i,
                'name' => $faker->name,
                'username' => $faker->userName,
                'password' => bcrypt('dayung231'),
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'pretest'=> $faker->numberBetween(0,100),
                'posttest'=> $faker->numberBetween(0,100),
                'team'=> $faker->numberBetween(1,8),
            ]);
        }
    }
}
