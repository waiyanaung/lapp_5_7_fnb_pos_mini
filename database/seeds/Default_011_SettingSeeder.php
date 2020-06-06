<?php

use Illuminate\Database\Seeder;

class Default_011_SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $existing_objs = DB::select('SELECT code,value FROM core_settings');
        $today = date('Y-m-d H:i:s');

        $objs = array(
            ['code'=>'MMK', 'type'=>'CURRENCY', 'value'=>'1','description'=>'Myanmar Kyat'],
            ['code'=>'USD', 'type'=>'CURRENCY', 'value'=>'2','description'=>'United States Dollar'],
            ['code'=>'SGD', 'type'=>'CURRENCY', 'value'=>'3','description'=>'Singapore dollar'],
            ['code'=>'EUR', 'type'=>'CURRENCY', 'value'=>'4','description'=>'European Pound'],
            ['code'=>'THB', 'type'=>'CURRENCY', 'value'=>'5','description'=>'Thai Baht'],
            ['code'=>'CNY', 'type'=>'CURRENCY', 'value'=>'6','description'=>'Chinese Yuan Renminbi'],
            ['code'=>'JPY', 'type'=>'CURRENCY', 'value'=>'7','description'=>'Japanese yen'],
            ['code'=>'MYR', 'type'=>'CURRENCY', 'value'=>'8','description'=>'Malaysian ringgit'],            
            ['code'=>'VND', 'type'=>'CURRENCY', 'value'=>'9','description'=>'Vietnamese dong'],
        );

        if (isset($existing_objs) && count($existing_objs) > 0) {

            $new_objs = array();

            foreach ($objs as $obj) {

                $existFlag = 0;
                foreach ($existing_objs as $existPermission) {

                    if ($obj['code'] == $existPermission->code && $obj['value'] == $existPermission->value) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($new_objs, $obj);
                }

            }

            if (count($new_objs) > 0) {
                DB::table('core_settings')->insert($new_objs);
            }
        } else {
            DB::table('core_settings')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Core Setting Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";

    }
}
