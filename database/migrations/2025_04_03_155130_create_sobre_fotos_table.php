<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sobre_fotos', function (Blueprint $table) {
            $table->id();
			$table->foreignId('id_sobre')->constrained('sobre')->cascadeOnDelete();
            $table->string('foto');
            $table->string('foto_thumb');
            $table->integer('ordem')->default(0);
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
        Schema::dropIfExists('sobre_fotos');
    }
};
