<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('namespace');
            $table->string('scope');
            $table->string('code')->unique();
            $table->text('description');
            $table->string('type');
            $table->text('json_options')->nullable();
            $table->boolean('nullable');
            $table->text('default_value')->nullable();
            $table->boolean('favorite');
            $table->string('width');
            $table->timestamps();

            $table->index('group');
            $table->index('scope');
            $table->index('favorite');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
