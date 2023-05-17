<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('front_ways', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyText('sub');
            $table->string('icon')->nullable();
            $table->tinyInteger('type')->comment('0 overal,1 other');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('front_ways');
    }
};
