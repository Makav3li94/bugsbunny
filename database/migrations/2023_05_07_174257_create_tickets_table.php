<?php

use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{

    public function up()
    {
        //TODO::Should Add Ticket Table To Database
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('title');
            $table->enum('section', ['پشتیبانی', 'مدیریت', 'مالی'])->default('پشتیبانی');
            $table->enum('priority', ['عادی', 'مهم', 'خیلی مهم'])->default('عادی');
            $table->enum('status', ['0', '1'])->default('1')->comment('Closed ticket : 0 , Opened Ticket : 1');
            $table->enum('answer', ['0', '1', '2'])->default('0')->comment('User message : 0 , User message is being considered : 1 , Admin message : 2');
            $table->softDeletes();
            $table->timestamps();
            $table->engine = "InnoDB";
        });

    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
