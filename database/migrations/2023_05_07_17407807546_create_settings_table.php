<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('domain')->nullable();
            $table->string('first_logo')->nullable();
            $table->string('second_logo')->nullable();
            $table->longText('wysiwyg')->nullable()->comment('Will be put on user main dashboard');
            $table->longText('_key')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
