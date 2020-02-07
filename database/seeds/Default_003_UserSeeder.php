<?php
/**
 * Created by Visual Studio Code.
 * User: Dell
 * Date: 7/4/2016
 * Time: 3:03 PM
 */

use Illuminate\Database\Seeder;
class Default_003_UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::table('core_users')->delete();
    $today = date('Y-m-d H:i:s');

    $roles = array(
        ['id'=>1,'phone'=>'09420088636', 'user_name'=>'superadmin','display_name'=>'Administrator', 'password' =>'$2y$10$uskq1AnI6LsmKpLzc/4/vOh3AmDVYMyonSAqA2VfcW3EDS4w1wjne', 'email' =>'waiyanaung@codetodream.com','role_id' =>'1','address'=>'Building 99, Room 99, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],

        //Posmini@321
        // $2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW

        ['id'=>2,'phone'=>'09123123123', 'user_name'=>'admin','display_name'=>'Administrator', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'admin@gmail.com','role_id' =>'2','address'=>'Building 99, Room 99, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],

        ['id'=>3,'phone'=>'09123123122', 'user_name'=>'supervisor','display_name'=>'Supervisor', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'verifier@gmail.com','role_id' =>'3','address'=>'Building 99, Room 9, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],
        
        ['id'=>4,'phone'=>'09123123124', 'user_name'=>'account','display_name'=>'Account', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'account@gmail.com','role_id' =>'4','address'=>'Building 99, Room 99, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],

        ['id'=>5,'phone'=>'09123123125', 'user_name'=>'basicuser','display_name'=>'Basic User', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'basicuser@gmail.com','role_id' =>'5','address'=>'Building 99, Room 99, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],

    );

    DB::table('core_users')->insert($roles);
}
}