<?php

use Illuminate\Database\Seeder;

class Default_014_ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();
        $today = date('Y-m-d H:i:s');

        $objs = array(
            ['id'=>1, 'name'=>'test 1', 'price'=>'10', 'model'=>'test 1','category_id'=>1,'brand_id'=>1,'country_id'=>117,'description'=>'test 1','image_url'=>'/images/item/default_image.jpg','image_url1'=>'/images/item/default_image.jpg','created_by'=>1,'created_at'=>$today],

            
        );

        DB::table('items')->insert($objs);
    }
}
