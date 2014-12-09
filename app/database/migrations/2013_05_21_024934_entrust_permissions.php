<?php
use Illuminate\Database\Migrations\Migration;

class EntrustPermissions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Creates the permissions table
        Schema::create('permissions', function($table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->unique();
        });

        // add in some permissions
        DB::table('permissions')->insert(array(
            ['id' => 1, 'name' => 'alter_users', 'display_name' => 'view/insert/edit/delete users'],
            ['id' => 2, 'name' => 'alter_settings', 'display_name' => 'view/insert/edit/delete settings'],
            ['id' => 3, 'name' => 'alter_facilities', 'display_name' => 'insert/edit/delete facilities']
        ));

        // Creates the permission_role (Many-to-Many relation) table
        Schema::create('permission_role', function($table)
        {
            $table->increments('id');
            $table->integer('permission_id')->unsigned()->index();
            $table->integer('role_id')->unsigned()->index();
            $table->unique(array('permission_id','role_id'));
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('role_id')->references('id')->on('roles');
        });

        // attach permissions to roles
        DB::table('permission_role')->insert(array(
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 2, 'permission_id' => 3],
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
    }

}
