<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserIdInReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Modifica a coluna user_id para unsignedBigInteger e adiciona foreign key
            //$table->foreignId('user_id')->constrained()->onDelete('cascade')->change();
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Reverte a coluna user_id para unsignedBigInteger simples, sem foreign key
            //$table->unsignedBigInteger('user_id')->change();
            
            // Se desejar, pode dropar a foreign key aqui
        });
    }
}
