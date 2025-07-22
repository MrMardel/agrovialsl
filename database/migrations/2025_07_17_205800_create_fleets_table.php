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
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();

            // Datos del vehículo
            $table->string('name'); // o alias interno, ej: "Camión 5"
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('license_plate')->unique(); // Patente
            $table->string('vin')->nullable(); // Número de chasis
            $table->year('year')->nullable();

            // Tipo de unidad de medición para mantenimiento
            $table->string('measurement_type')->default('km');

            // Último valor registrado de uso
            $table->unsignedInteger('last_recorded')->default(0); // último km u horas

            // Próximo servicio
            $table->unsignedInteger('next_service_at')->nullable(); // km u horas

            // Info de servicio anterior
            $table->timestamp('last_service_at')->nullable();
            $table->unsignedInteger('last_service_record')->nullable(); // km u horas

            // Estado
            $table->boolean('active')->default(true);

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleets');
    }
};
