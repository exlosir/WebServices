<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'Заказчик'
        ]);
        DB::table('roles')->insert([
            'name'=>'Исполнитель'
        ]);
        DB::table('roles')->insert([
            'name'=>'Администратор'
        ]);
    }
}
