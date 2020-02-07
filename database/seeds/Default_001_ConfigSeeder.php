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
        DB::table('core_configs')->delete();
        $today = date('Y-m-d H:i:s');
        
        $roles = array(
            ['code'=>'SETTING_COMPANY_NAME', 'type'=>'SETTING', 'value'=>'Laravel Backend','description'=>'Company Name','created_by'=>1,'created_at'=>$today],
            ['code'=>'SETTING_LOGO', 'type'=>'SETTING', 'value'=>'/images/logo.jpg','description'=>'Company Logo','created_by'=>1,'created_at'=>$today],
            ['code'=>'SETTING_ADMIN_EMAILS', 'type'=>'SETTING', 'value'=>'','description'=>'Company Admin Emails','created_by'=>1,'created_at'=>$today],
        );

        DB::table('core_configs')->insert($roles);
    }
}