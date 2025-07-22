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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            // Información básica
            $table->string('name');                    // Ej: "Casa Central", "Depósito 3"
            $table->string('code')->unique();          // Código interno o legible (ej: CCEN, DEP3)
            $table->string('slug')->unique();          // Para URLs, si se expone en web

            // Ubicación
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->default('Argentina');
            $table->string('postal_code')->nullable();

            // Geolocalización (opcional, útil para mapas o logística)
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();

            // Estado
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
