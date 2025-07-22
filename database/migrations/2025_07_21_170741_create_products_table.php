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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Identificadores
            $table->string('code')->unique();        // Código interno (ej: 01-5678)
            $table->string('sku')->nullable();       // Código SKU del proveedor

            // Información básica
            $table->string('name');
            $table->text('description')->nullable();

            // Precios
            $table->decimal('cost_price', 12, 2)->nullable();          // Precio de costo
            $table->decimal('resale_price', 12, 2)->nullable();        // Precio para revendedores
            $table->decimal('final_price', 12, 2)->nullable();         // Precio para consumidor final

            // Stock y ubicación
            $table->integer('stock')->default(0);
            $table->string('warehouse_location')->nullable(); // Ej: "Pasillo A, Estante 3"
            $table->foreignId('branch_id')->constrained();    // Sucursal (relación a tabla `branches`)

            // Clasificación
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->enum('type', ['gas', 'eléctrico', 'diesel', 'manual', 'otro'])->nullable();

            // Publicación
            $table->boolean('is_public')->default(false); // Si se muestra en el catálogo público
            $table->timestamp('published_at')->nullable();

            // Extras para búsquedas y performance
            $table->json('tags')->nullable();        // Palabras clave
            $table->string('barcode')->nullable();   // Código de barras

            // Metadatos
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
