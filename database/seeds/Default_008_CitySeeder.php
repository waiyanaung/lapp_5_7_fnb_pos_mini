<?php
use Illuminate\Database\Seeder;

class Default_008_CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // DB::table('cities')->delete();
        DB::table('cities')->truncate();
        $today = date('Y-m-d H:i:s');
        
        $objs = array(
            ['country_id'=>'117', 'name'=>'Ayeyarwady', 'name_jp'=>'エヤワディ', 'id' =>'1', 'image_url' =>'ayeyarwaddy.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Bago', 'name_jp'=>'バゴー', 'id' =>'2', 'image_url' =>'bago.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Chin', 'name_jp'=>'チン', 'id' =>'3', 'image_url' =>'chin.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Kachin', 'name_jp'=>'カチン', 'id' =>'4', 'image_url' =>'kachin.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Kayah', 'name_jp'=>'カヤー', 'id' =>'5', 'image_url' =>'kayah.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Kayin', 'name_jp'=>'カイン', 'id' =>'6', 'image_url' =>'kayin.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Magway', 'name_jp'=>'マグエー', 'id' =>'7', 'image_url' =>'magway.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Mandalay', 'name_jp'=>'マンダレー', 'id' =>'8', 'image_url' =>'mandalay.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Mon', 'name_jp'=>'モン', 'id' =>'9', 'image_url' =>'mon.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Rakhine', 'name_jp'=>'ラカイン', 'id' =>'10', 'image_url' =>'rakhine.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Sagaing', 'name_jp'=>'サガイン', 'id' =>'11', 'image_url' =>'sagaing.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Shan', 'name_jp'=>'シャン', 'id' =>'12', 'image_url' =>'shan.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Tanintharyi', 'name_jp'=>'タニンターリ', 'id' =>'13', 'image_url' =>'tanintharyi.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Yangon', 'name_jp'=>'ヤンゴン', 'id' =>'14', 'image_url' =>'yangon.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
            ['country_id'=>'117', 'name'=>'Naypyidaw', 'name_jp'=>'ネピドー', 'id' =>'15', 'image_url' =>'naypyitaw.jpg', 'created_by' =>'1', 'updated_by' =>'1','created_by'=>1,'created_at'=>$today],
        );
        DB::table('cities')->insert($objs);
    }
}
