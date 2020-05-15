<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 11/2/2016
 * Time: 2:18 PM
 */
use Illuminate\Database\Seeder;

class Default_001_ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('core_configs')->delete();
        $today = date('Y-m-d H:i:s');

        $existingObjs = DB::select('SELECT code FROM core_configs');
        $today = date('Y-m-d H:i:s');
        
        $objs = array(
            ['code'=>'SETTING_BACKEND_URL', 'type'=>'SETTING', 'value'=>'backend_app','description'=>'Web Backend URL','created_by'=>1,'created_at'=>$today],
            ['code'=>'SETTING_COMPANY_NAME', 'type'=>'SETTING', 'value'=>'Laravel Backend','description'=>'Company Name','created_by'=>1,'created_at'=>$today],
            ['code'=>'SETTING_LOGO', 'type'=>'SETTING', 'value'=>'/images/logo.jpg','description'=>'Company Logo','created_by'=>1,'created_at'=>$today],
            ['code'=>'SETTING_ADMIN_EMAILS', 'type'=>'SETTING', 'value'=>'','description'=>'Company Admin Emails','created_by'=>1,'created_at'=>$today],
        );

        

        if (isset($existingObjs) && count($existingObjs) > 0) {

            $newobjs = array();

            foreach ($objs as $obj) {

                $existFlag = 0;
                foreach ($existingObjs as $existObj) {

                    if ($obj['code'] == $existObj->code) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newobjs, $obj);
                }

            }

            if (count($newobjs) > 0) {
                DB::table('core_configs')->insert($newobjs);
            }
        } else {
            DB::table('core_objs')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Core Configs Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}