<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('doctors', function (Blueprint $table) {

            $table->id(); // Crea una colonna 'id' come chiave primaria
            $table->unsignedBigInteger('user_id'); // Crea una colonna per la chiave esterna
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Definisci il vincolo della chiave esterna
            $table->string('surname');
            $table->string('address');
            $table->string('cv');
            $table->string('pic');
            $table->string('phone');
            $table->string('bio');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
