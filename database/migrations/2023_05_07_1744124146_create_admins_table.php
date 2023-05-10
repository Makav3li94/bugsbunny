<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->comment('It should be unique but must handled in validation not here in migration because of soft delete feature');;
            $table->string('mobile')->nullable()->comment('It should be unique but must handled in validation not here in migration because of soft delete feature');;
            $table->string('password')->comment('At least 6 characters-Default hash driver : bcrypt');
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
