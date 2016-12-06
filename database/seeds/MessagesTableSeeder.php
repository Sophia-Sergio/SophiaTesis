<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i<=50; $i++) {
            DB::table('messages')->insert([
                'uuid' => substr(md5(microtime()),rand(0,26),10),
                'sender' => rand(1, 50),
                'receiver' => rand(1, 50),
                'message' => $faker->text,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
