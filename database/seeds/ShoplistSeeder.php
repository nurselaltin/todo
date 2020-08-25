<?php

use Illuminate\Database\Seeder;

class ShoplistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = ['Pazar Alışveriş Listesi','Kişisel Alışveriş Listesi'];
        foreach ($lists as $list){
            DB::table('shopLists')->insert([
                'title'   => $list,
            ]);
        }

    }
}
