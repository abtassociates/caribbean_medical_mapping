<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeFacilityEditPermissionsSpecific extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // create 'insert facility' permissions
        DB::table('permissions')->insert(array(
            ['id' => 5, 'name' => 'insert_facilities', 'display_name' => 'insert facilities'],
        ));

        // attach new permission to both roles
        DB::table('permission_role')->insert(array(
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 2, 'permission_id' => 5]
        ));

        // change 'insert_edit' permission to be 'edit_all'
        $old_facility_permission = Permission::find(3);
        $old_facility_permission->name = "edit_all_facilities";
        $old_facility_permission->display_name = "edit all facilities";
        $old_facility_permission->save();

        // change 'delete' permission to be 'delete_all'
        $old_facility_permission = Permission::find(4);
        $old_facility_permission->name = "delete_all_facilities";
        $old_facility_permission->display_name = "delete all facilities";
        $old_facility_permission->save();

        // remove permission 3 from role 2
        DB::table('permission_role')
        	->where('permission_id', '=', 3)
        	->where('role_id', '=', 2)
        	->delete();
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}