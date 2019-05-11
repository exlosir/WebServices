<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name'=>'Открыт'
        ]);
        DB::table('statuses')->insert([
            'name'=>'Закрыт'
        ]);
        DB::table('statuses')->insert([
            'name'=>'В исполнении'
        ]);
        DB::table('statuses')->insert([
            'name'=>'Принят'
        ]);
        DB::table('statuses')->insert([
            'name'=>'Отклонен'
        ]);
        DB::table('statuses')->insert([
            'name'=>'В ожидании'
        ]);
    }
}
