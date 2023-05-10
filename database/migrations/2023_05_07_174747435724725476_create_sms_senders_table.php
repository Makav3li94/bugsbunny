<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSendersTable extends Migration
{

    public function up()
    {
        //TODO::Should Add SmsSender Table To Database
        Schema::create('sms_senders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('number');
            $table->string('type');
            $table->softDeletes();
            $table->timestamps();
            $table->engine="InnoDB";
        });
    }


    public function down()
    {
        Schema::dropIfExists('sms_senders');
    }
}
