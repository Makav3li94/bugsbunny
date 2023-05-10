<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration
{
//Foreign keys should be run after all tables are created
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('familiarity_id')->references('id')->on('familiarities')->onDelete('cascade');
        });

        Schema::table('files', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('file_title_id')->references('id')->on('file_titles')->onDelete('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('sms', function (Blueprint $table) {
            $table->foreign('sms_sender_id')->references('id')->on('sms_senders')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('faqs', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('foreign_keys');
    }
}
