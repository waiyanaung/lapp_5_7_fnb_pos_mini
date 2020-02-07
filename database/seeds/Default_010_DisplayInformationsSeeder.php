<?php
use Illuminate\Database\Seeder;
class Default_010_DisplayInformationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('display_information')->delete();
        $today = date('Y-m-d H:i:s');

        $roles = array(
            // ['type'=>'TERMS_AND_CONDITION', 'text_en'=>'<p><b>Terms and conditions</b><br/><br>','text_jp'=>'','text_mm' => '', 'text_zh' => '','created_by'=>1,'created_at'=>$today],
            ['type'=>'FAQ', 'text_en'=>'<p><b>FAQ</b><br/><br>','text_jp'=>'','text_mm' => '', 'text_zh' =>'','created_by'=>1,'created_at'=>$today],
            ['type'=>'ABOUTUS', 'text_en'=>'<p><b>About Us</b><br/><br>','text_jp'=>'','text_mm' => '', 'text_zh' =>'','created_by'=>1,'created_at'=>$today],
            ['type'=>'CoNTACTUS', 'text_en'=>'<p><b>Contact Us</b><br/><br>','text_jp'=>'','text_mm' => '', 'text_zh' =>'','created_by'=>1,'created_at'=>$today],

        );

        DB::table('display_information')->insert($roles);
    }
}