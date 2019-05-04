<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
       public function up()
    {
        Schema::create('config_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->unsigned();
            $table->string('name', 50)->unique();
            $table->string('label', 100);
            $table->timestamps();
            $table->foreign('module_id')
                ->references('id')
                ->on('config_modules')
                ->onDelete('cascade');
        });
                
        Schema::create('config_permission_config_profile', function(Blueprint $table){
            $table->increments('id');
            $table->integer('config_permission_id')->unsigned();
            $table->integer('config_profile_id')->unsigned();
            
            $table->foreign('config_permission_id')
                    ->references('id')
                    ->on('config_permissions')
                    ->onDelete('cascade');
            $table->foreign('config_profile_id')
                    ->references('id')
                    ->on('config_profiles')
                    ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_permission_config_profile');
        Schema::dropIfExists('config_permissions');
    }
}
