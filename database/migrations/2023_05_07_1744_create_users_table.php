<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->enum('is_primary', ['0', '1'])->default('1')->comment('Primary users : 1 & future users : 0');
            $table->unsignedBigInteger('primary_id')->unsigned()->default(0)->comment('Primary users : 0 & future users : other integers but 0');
            $table->string('name')->nullable();
            $table->string('mobile')->nullable()->comment('It should be unique but must handled in validation not here in migration because of soft delete feature');
            $table->string('email')->nullable()->comment('It should be unique but must handled in validation not here in migration because of soft delete feature');
            $table->string('password')->nullable()->comment('At least 6 characters-Default hash driver : bcrypt');
            $table->unsignedBigInteger('familiarity_id')->unsigned()->nullable();
            $table->date('birthDate')->nullable();
            $table->tinyInteger('authStatus')
                ->default('0')->comment('0 simple,1 verified');
            $table->longText('cats')->nullable();
            $table->string('avatar', 200)->nullable();
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
