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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('category_id')->index();
            $table->tinyInteger('type')->comment('1 admin or  0 user');
            $table->tinyInteger('kind')->nullable()->default(0)->comment('0 is challenge and 1 is thread');
            $table->string('img_cover', 200)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->longText('description');
            $table->string('excerpt');
            $table->text('prize_text')->nullable();
            $table->date('expire_date');
            $table->integer('total_views')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->comment(' 0 for not show and 1 for show');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
