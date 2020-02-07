<?php
/**
 * Created by Visual Studio Code.
 * Author: william
 * Date: 11/2/2016
 * Time: 2:17 PM
 */
use Illuminate\Database\Seeder;
class Default_002_RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('core_roles')->delete();
        $today = date('Y-m-d H:i:s');
        $objs = array(
            ['id'=>1, 'name'=>'SUPER_ADMIN', 'description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],
            ['id'=>2, 'name'=>'ADMIN', 'description'=>'This is admin role','created_by'=>1,'created_at'=>$today],
            ['id'=>3, 'name'=>'SUPERVISOR', 'description'=>'This is supervisor role','created_by'=>1,'created_at'=>$today],
            ['id'=>4, 'name'=>'ACCOUNT', 'description'=>'This is account role','created_by'=>1,'created_at'=>$today],
            ['id'=>5, 'name'=>'SALE PERSON', 'description'=>'This is basic user role','created_by'=>1,'created_at'=>$today],
            ['id'=>6, 'name'=>'SUPPLIER', 'description'=>'This is supplier user role','created_by'=>1,'created_at'=>$today],
            ['id'=>7, 'name'=>'CUSTOMER', 'description'=>'This is customer user role','created_by'=>1,'created_at'=>$today],
        );

        DB::table('core_roles')->insert($objs);
    }
}