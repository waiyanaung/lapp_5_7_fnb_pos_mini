<?php
/**
 * Created by Visual Studio Code.
 * User: Dell
 * Date: 7/4/2016
 * Time: 3:03 PM
 */

use Illuminate\Database\Seeder;
class Default_006_Syncs_TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_syncs_tables')->delete();
        $today = date('Y-m-d H:i:s');
        $syncs_tables = array(
            ['table_name'=>'core_configs', 'version' =>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'core_permissions', 'version' =>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'core_permission_role', 'version' =>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'core_roles', 'version' =>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'core_users', 'version' =>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'core_settings', 'version' =>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'tablet_activation','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'items','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'item_advertisements','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'item_images','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'brands','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'categories','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'cities','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'townships','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'countries','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'transactions','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'transaction_ite','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'transaction_item_temp','version'=>'1','created_by'=>1,'created_at'=>$today],
            ['table_name'=>'transaction_order','version'=>'1','created_by'=>1,'created_at'=>$today],
        );

        DB::table('core_syncs_tables')->insert($syncs_tables);
    }
}