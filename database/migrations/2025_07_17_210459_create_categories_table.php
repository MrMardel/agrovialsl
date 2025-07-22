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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // Se crea la columna 'id' y es PRIMARY KEY

            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Primero la columna
            $table->foreignId('parent_id')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Después definimos la FK
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
