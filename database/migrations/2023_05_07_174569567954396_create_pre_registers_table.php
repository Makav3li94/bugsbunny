<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreRegistersTable extends Migration
{

    public function up()
    {
        Schema::create('pre_registers', function (Blueprint $table) {
            $table->id();
            $table->string('mobile',11)->comment('It should be unique but must handled in validation not here in migration because of soft delete feature');
            $table->integer('code')->comment('4 characters length string sent to user mobile phone before leading to essential information page');
            $table->tinyInteger('times')->default(0)->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('pre_registers');
    }
}
