<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_setting', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('setting_id')->unsigned();
            $table->text('value');
            $table->primary(['id', 'user_id', 'setting_id']);
        });

        Schema::table('user_setting', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('setting_id')->references('id')->on('settings')->onDelete('restrict');
        });

        // Création des clés primaires
        Schema::table('user_setting', function (Blueprint $table) {
            $table->bigInteger('id', true, true)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_setting');
    }
}
