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
        DB::table('core_settings')->delete();
        $today = date('Y-m-d H:i:s');
        
        $roles = array(
            // ['code'=>'CANCEL REASON 1', 'type'=>'REASON', 'value'=>'1','description'=>'I found a better place to stay'],
           

        );

        DB::table('core_settings')->insert($roles);
    }
}
