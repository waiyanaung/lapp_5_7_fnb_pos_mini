<?php

use Illuminate\Database\Seeder;

class Default_012_PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_groups')->delete();
        $today = date('Y-m-d H:i:s');

        $objs = array(
            ['id' => '1', 'name' => 'Reports', 'group_code' => '001', 'level' => '1', 'parent_id' => '0', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '2', 'name' => 'Sale Summary Report', 'group_code' => '001', 'level' => '2', 'parent_id' => '1', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '3', 'name' => 'Site Setup', 'group_code' => '002', 'level' => '1', 'parent_id' => '0', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '4', 'name' => 'Role', 'group_code' => '002', 'level' => '2', 'parent_id' => '3', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '5', 'name' => 'Permission', 'group_code' => '002', 'level' => '2', 'parent_id' => '3', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '6', 'name' => 'Staff', 'group_code' => '002', 'level' => '2', 'parent_id' => '3', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '7', 'name' => 'Site Config', 'group_code' => '002', 'level' => '2', 'parent_id' => '3', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '8', 'name' => 'Area', 'group_code' => '003', 'level' => '1', 'parent_id' => '0', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '9', 'name' => 'Country', 'group_code' => '003', 'level' => '2', 'parent_id' => '8', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '10', 'name' => 'City', 'group_code' => '003', 'level' => '2', 'parent_id' => '8', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
            ['id' => '11', 'name' => 'Township', 'group_code' => '003', 'level' => '2', 'parent_id' => '8', 'status' => '1', 'created_by' => '1', 'updated_by' => '1', 'created_by' => 1, 'created_at' => $today],
        );
        DB::table('permission_groups')->insert($objs);

    }
}
