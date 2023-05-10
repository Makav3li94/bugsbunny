<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTitlesTable extends Migration
{

    public function up()
    {
        Schema::create('file_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('file_cat')->comment('0 for hagighi,1 for hoghoghi,2 for user,3 for finance,4 for credit,5 for products,6 for others');
            $table->softDeletes();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_titles');
    }
}
