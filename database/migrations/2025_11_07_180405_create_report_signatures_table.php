<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportSignaturesTable extends Migration
{
    public function up()
    {
        Schema::create('report_signatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            //$table->unsignedBigInteger('user_id');
            //$table->foreignId('user_id')->constrained()->onDelete('cascade')->change();
            $table->text('signature');  // campo para a assinatura
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_signatures');
    }
}
