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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->default(0);
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('section_id')->index();
            $table->text('body');
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('section_id')->references ('id')->on('sections')->onDelete ('cascade');
            $table->foreign('user_id')->references ('id')->on('users')->onDelete ('cascade');
//            $table->foreign('user_id')->references ('id')->on('users')->onDelete ('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
