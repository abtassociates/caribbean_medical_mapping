<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteFacilityPermission extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        // add in some permissions
        DB::table('permissions')->insert(array(
            ['id' => 4, 'name' => 'delete_facilities', 'display_name' => 'delete facilities'],
        ));

        // attach permissions to roles
        DB::table('permission_role')->insert(array(
            ['role_id' => 1, 'permission_id' => 4]
        ));

        $old_facility_permission = Permission::find(3);
        $old_facility_permission->name = "insert_edit_facilities";
        $old_facility_permission->display_name = "insert/edit facilities";
        $old_facility_permission->save();
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