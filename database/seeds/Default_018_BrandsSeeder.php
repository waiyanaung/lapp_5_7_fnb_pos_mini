<?php

use Illuminate\Database\Seeder;

class Default_018_BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('brands')->delete();
        $existingObjs = DB::select('SELECT id FROM brands');
        $today = date('Y-m-d H:i:s');

        $objs = array(
            
            ['id'=>1, 'name'=>'Brand 1', 'detail_info'=>'Brand 1','image_url'=> '/images/brand/default_image.jpg','display_order'=>1,'created_by'=>1,'created_at'=>$today],
            ['id'=>2, 'name'=>'Brand 2', 'detail_info'=>'Brand 2','image_url'=> '/images/brand/default_image.jpg','display_order'=>1,'created_by'=>1,'created_at'=>$today],
            ['id'=>3, 'name'=>'Brand 3', 'detail_info'=>'Brand 3','image_url'=> '/images/brand/default_image.jpg','display_order'=>1,'created_by'=>1,'created_at'=>$today],

          
        );

        if (isset($existingObjs) && count($existingObjs) > 0) {

            $newobjs = array();

            foreach ($objs as $defaultobj) {

                $existFlag = 0;
                foreach ($existingObjs as $existobj) {

                    if ($defaultobj['id'] == $existobj->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newobjs, $defaultobj);
                }

            }

            if (count($newobjs) > 0) {
                DB::table('brands')->insert($newobjs);
            }
        } else {
            DB::table('brands')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Brand Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}
