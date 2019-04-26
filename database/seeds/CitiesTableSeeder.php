<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            'name'=>'Уфа'
        ]);
        DB::table('cities')->insert([
            'name'=>'Москва'
        ]);
        DB::table('cities')->insert([
            'name'=>'Санкт-Петербург'
        ]);
        DB::table('cities')->insert([
            'name'=>'Октябрьский'
        ]);
        DB::table('cities')->insert([
            'name'=>'Туймазы'
        ]);
        DB::table('cities')->insert([
            'name'=>'Сочи'
        ]);
        DB::table('cities')->insert([
            'name'=>'Кисловодск'
        ]);
    }
}
