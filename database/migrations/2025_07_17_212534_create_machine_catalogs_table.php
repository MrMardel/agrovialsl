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
        Schema::create('machine_catalogs', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // Ej: "Autoelevador Eléctrico Toyota 8FBE15"
            $table->string('images');
            $table->string('brand'); // Toyota
            $table->string('model')->nullable(); // 8FBE15
            $table->string('power_type'); // Eléctrico, Diésel, etc.
            $table->string('condition'); // Nuevo, Seminuevo, Usado
            $table->year('year')->nullable(); // 2022
            $table->unsignedInteger('hours')->nullable(); // 1250
            $table->decimal('price', 12, 2)->nullable(); // 25000.00
            $table->string('location')->nullable(); // Pergamino, Buenos Aires

            // Descripción libre
            $table->longText('description')->nullable();

            // Especificaciones técnicas (pueden moverse a tabla relacionada si querés filtrar)
            $table->json('technical_specs')->nullable();

            // Características (checkboxes o texto)
            $table->json('features')->nullable();

            // Mantenimiento reciente
            $table->json('maintenance')->nullable();

            // Multimedia
            $table->json('attachments')->nullable(); // imágenes, ficha técnica PDF

            // Publicación
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            // Slug para URL amigable
            $table->string('slug')->unique();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_catalogs');
    }
};
