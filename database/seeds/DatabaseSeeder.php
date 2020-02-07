<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default Seeders
        $this->call(Default_001_ConfigSeeder::class);
        $this->call(Default_002_RoleSeeder::class);
        $this->call(Default_003_UserSeeder::class);
        $this->call(Default_004_PermissionSeeder::class);
        $this->call(Default_005_RolePermissionSeeder::class);
        $this->call(Default_006_Syncs_TablesSeeder::class);
        $this->call(Default_007_CountriesSeeder::class);
        $this->call(Default_008_CitySeeder::class);
        $this->call(Default_009_TownshipSeeder::class);
        $this->call(Default_010_DisplayInformationsSeeder::class);
        $this->call(Default_011_SettingSeeder::class);
        $this->call(Default_012_PermissionGroupSeeder::class);

        $this->call(Default_013_CategorySeeder::class);
        $this->call(Default_014_ItemSeeder::class);        
        $this->call(Default_016_ItemAdvertisementsSeeder::class);
        $this->call(Default_017_ItemImagesSeeder::class);

        $this->call(Default_018_BrandsSeeder::class);        
    }
}
