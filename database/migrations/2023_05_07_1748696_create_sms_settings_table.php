<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('sms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('p_confirm_code');
            $table->string('p_ticket');
            $table->string('p_password');
            $table->string('p_notif');
            $table->unsignedBigInteger('sms_sender');
            $table->timestamps();
            $table->engine="InnoDB";
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_settings');
    }
}
