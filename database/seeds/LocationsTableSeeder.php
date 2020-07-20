<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('locations')->insert([
            'location_name'     => 'location',
            'email'             => 'location@test.co.jp',
            'phone'             => '0311112222',
            'address'           => '上石原1-30-9',
            'description'       => 'test',
            'prefecture_id'     => '1',
            'city_id'           => '1',
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ]);
 
    }
}
