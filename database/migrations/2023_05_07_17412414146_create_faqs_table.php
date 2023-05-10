<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Hekmatinasser\Verta\Verta;

class CreateFaqsTable extends Migration
{

    public function up()
    {
        //TODO::Should Add Faq Table To Database
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->nullable()->unsigned();
            $table->unsignedBigInteger('ticket_id')->unsigned();
            $table->string('user_file')->nullable();
            $table->string('admin_file')->nullable();
            $table->longText('question')->nullable();
            $table->longText('reply')->nullable();
            $table->integer('rate')->nullable();
            $table->enum('seen', [
                '0',
                '1',
                '2',
                '3'
            ])
                ->default('0')
                ->comment('User Sent Question Admin has not seen : 0 , Admin has seen but has not replied yet : 1 , Admin replied user has not seen yet : 2, User has seen reply ; 3');
            $table->timestamp('reply_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
    }
}
