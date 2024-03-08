<?php

namespace Database\Seeders;

use App\Models\Actuator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ActuatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 20; $i++){
            Actuator::create([
                'name' => $faker->unique()->name(),
                'type' => $faker->randomElement(['Led','Motor','Rele']),
                'value' =>rand(0,100),
                'date' => $faker->dateTimeThisYear(),
                'user_id' => rand(1, 11)

            ]);
        }
    }
}
