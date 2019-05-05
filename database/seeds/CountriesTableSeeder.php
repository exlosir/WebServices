<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
            'name'=>'Россия'
        ]);
        DB::table('countries')->insert([
            'name'=>'Украина'
        ]);
        DB::table('countries')->insert([
            'name'=>'Казахстан'
        ]);
    }
}
