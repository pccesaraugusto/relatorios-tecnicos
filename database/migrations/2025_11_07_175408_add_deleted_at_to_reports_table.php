<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->softDeletes(); // cria a coluna deleted_at nullable timestamp
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
