<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustPivotAdminUserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for associating roles to users (Many-to-Many)
        Schema::create('admin_user_role', function (Blueprint $table) {
            $table->integer('admin_user_id')->unsigned();
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['admin_user_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user_role');
    }
}