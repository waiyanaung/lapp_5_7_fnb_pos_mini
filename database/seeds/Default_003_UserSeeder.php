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
    $existingObjs = DB::select('SELECT id FROM core_users');
    $today = date('Y-m-d H:i:s');

    $objs = array(
        ['id'=>1,'phone'=>'09420088636', 'user_name'=>'superadmin','display_name'=>'Administrator','first_name'=>'System','last_name'=>'Administrator', 'password' =>'$2y$10$uskq1AnI6LsmKpLzc/4/vOh3AmDVYMyonSAqA2VfcW3EDS4w1wjne', 'email' =>'waiyanaung@codetodream.com','role_id' =>'1','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],

        //Posmini@321
        // $2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW

        ['id'=>2,'phone'=>'09123123121', 'user_name'=>'administrator','display_name'=>'Super Administrator','first_name'=>'Super','last_name'=>'Administrator', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'administrator@gmail.com','role_id' =>'1','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is super admin role','created_by'=>1,'created_at'=>$today],

        ['id'=>3,'phone'=>'09123123123', 'user_name'=>'admin','display_name'=>'Administrator','first_name'=>'System','last_name'=>'Admin', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'admin@gmail.com','role_id' =>'2','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is system admin user','created_by'=>1,'created_at'=>$today],

        ['id'=>4,'phone'=>'09123123122', 'user_name'=>'supervisor','display_name'=>'Supervisor','first_name'=>'System','last_name'=>'Supervisor', 'password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'supervisor@gmail.com','role_id' =>'3','address'=>'Building 99, Room 9, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is supervisor user','created_by'=>1,'created_at'=>$today],
        
        ['id'=>5,'phone'=>'09123123124', 'user_name'=>'account','display_name'=>'Account', 'first_name'=>'System','last_name'=>'Accountant','password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'account@gmail.com','role_id' =>'4','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is system accountant user.','created_by'=>1,'created_at'=>$today],

        ['id'=>6,'phone'=>'09123123125', 'user_name'=>'basicuser','display_name'=>'Basic User', 'first_name'=>'Basic','last_name'=>'User','password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'basicuser@gmail.com','role_id' =>'5','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is Basic User','created_by'=>1,'created_at'=>$today],

        ['id'=>7,'phone'=>'09123123126', 'user_name'=>'supplier','display_name'=>'Supplier', 'first_name'=>'system','last_name'=>'supplier','password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'supplier@gmail.com','role_id' =>'6','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is supplier user','created_by'=>1,'created_at'=>$today],

        ['id'=>8,'phone'=>'-', 'user_name'=>'walk-in-customer','display_name'=>'walk-in-customer', 'first_name'=>'walk-in','last_name'=>'customer','password' =>'$2y$10$gIzaXMve/PT9yXtGGgceHe.MqwIsr5SE/GxtwXHOJeZYdqIsdfNoW', 'email' =>'walkincustomer@gmail.com','role_id' =>'7','address'=>'Building A, Room 1, MICT Park, Hlaing Township, Yangon, Myanmar','description'=>'This is walk in customer','created_by'=>1,'created_at'=>$today],

        );
    
        if (isset($existingObjs) && count($existingObjs) > 0) {

            $newObjs = array();

            foreach ($objs as $defaultObj) {

                $existFlag = 0;
                foreach ($existingObjs as $existPermission) {

                    if ($defaultObj['id'] == $existPermission->id) {
                        $existFlag++;
                        break;
                    }
                }
                if ($existFlag == 0) {
                    array_push($newObjs, $defaultObj);
                }

            }

            if (count($newObjs) > 0) {
                DB::table('core_users')->insert($newObjs);
            }
        } else {
            DB::table('core_users')->insert($objs);
        }

        echo "\n";
        echo "*****************************************************";
        echo "\n";
        echo "** Finished Running Default Core User Seeder **";
        echo "\n";
        echo "*****************************************************";
        echo "\n";
    }
}