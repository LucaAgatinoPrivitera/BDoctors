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

        Schema::create('doctor', function (Blueprint $table) {
            $table->id(); // Crea una colonna 'id' come chiave primaria
            $table->unsignedBigInteger('users_id'); // Crea una colonna per la chiave esterna
            $table->foreign('users_id')->references('id')->on('userss')->onDelete('cascade'); // Definisci il vincolo della chiave esterna
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
        Schema::dropIfExists('doctor');
    }
};
