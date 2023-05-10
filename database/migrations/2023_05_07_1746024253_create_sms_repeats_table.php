<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsRepeatsTable extends Migration
{

    public function up()
    {
        Schema::create('sms_repeats', function (Blueprint $table) {
            $table->id();
            $table->string('mobile',33);
            $table->enum('type',['register','forgotPassword']);
            $table->enum('attempt',['1','2']);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sms_repeats');
    }
}
