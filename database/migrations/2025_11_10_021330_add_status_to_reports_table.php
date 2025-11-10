<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // Adiciona a coluna 'status' no final da tabela
            $table->string('status')->default('pending');
            $table->timestamp('validated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['status', 'validated_at']);
        });
    }
}
