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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')
                  ->references('id')
                  ->on('doctors')
                  ->onDelete('cascade'); // Opzionale, elimina le recensioni se il dottore viene eliminato
            $table->smallInteger('stars');
            $table->string('review_text')->nullable();
            $table->string('name_reviewer')->nullable();
            $table->string('email_reviewer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
