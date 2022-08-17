<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAreasTableAddSoftDeletes extends Migration
{
    public function up()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('areas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
