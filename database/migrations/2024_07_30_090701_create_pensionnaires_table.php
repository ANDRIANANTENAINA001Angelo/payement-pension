<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pensionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('numCnaps')->unique();
            $table->string('numMatricule');
            $table->string('cin')->unique();
            $table->integer('solde');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pensionnaires');
    }
};
