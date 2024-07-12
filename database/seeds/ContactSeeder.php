<?php

use App\Models\Contacts;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($index=0;$index<1000;$index++){
        Contacts::create([
            'name'              => $faker->name,
            'mobile'            => rand(111111111,999999999),
            'group_id'          => 2,
            'country_code_id'   => 1
        ]);
    }
    }
}
