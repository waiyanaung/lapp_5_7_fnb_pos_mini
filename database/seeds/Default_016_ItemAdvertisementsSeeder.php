<?php

use Illuminate\Database\Seeder;

class Default_016_ItemAdvertisementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_advertisements')->delete();
        $today = date('Y-m-d H:i:s');

        $objs = array(
            ['id'=>1, 'item_id'=>1, 'image_url'=>'/images/item_advertisment/default_image.jpg','created_by'=>1,'created_at'=>$today],

            ['id'=>2, 'item_id'=>2,  'image_url'=>'/images/item_advertisment/default_image.jpg','created_by'=>1,'created_at'=>$today],
            
        );

        DB::table('item_advertisements')->insert($objs);
    }
}
