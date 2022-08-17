<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('slug', 128);
            $table->string('name');
            $table->boolean('sms')->default(false);
            $table->string('subject')->nullable();
            $table->text('text');

            $table->index('slug', 'messages_slug_index');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
