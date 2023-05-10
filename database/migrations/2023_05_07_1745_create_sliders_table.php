<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{

    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('image_link');
            $table->string('href')->nullable();
            $table->timestamps();
            $table->engine="InnoDb";
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
}
