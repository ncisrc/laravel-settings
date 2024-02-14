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
            $table->string('code')->unique();
            $table->text('description');
            $table->string('type');
            $table->string('options_class')->nullable();
            $table->text('options_data')->nullable();
            $table->boolean('nullable');
            $table->text('default_value')->nullable();
            $table->boolean('overridable')->default(true);
            $table->boolean('favorite')->default(false);
            $table->string('width')->default('1/4');
            $table->timestamps();

            $table->index('code');
            $table->index('overridable');
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
