<?php

use Illuminate\Database\Seeder;

class Default_013_CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('categories')->delete();
        $table_name = "categories";
        $existingObjs = DB::select("SELECT id FROM " . $table_name );
        $today = date('Y-m-d H:i:s');

        $objs = array(
            ['id'=>1, 'name'=>'Category 1', 'description'=>'Category 1','image'=>'/images/category/default_image.jpg','display_order'=>1,'created_by'=>1,'created_at'=>$today],

            ['id'=>2, 'name'=>'Category 2', 'description'=>'Category 2','image'=>'/images/category/default_image.jpg','display_order'=>2,'created_by'=>1,'created_at'=>$today],

            ['id'=>3, 'name'=>'Category 3', 'description'=>'Category 3','image'=>'/images/category/default_image.jpg','display_order'=>3,'created_by'=>1,'created_at'=>$today],
            
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
                DB::table($table_name)->insert($newobjs);
            }
        } else {
            DB::table($table_name)->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default $table_name Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}
