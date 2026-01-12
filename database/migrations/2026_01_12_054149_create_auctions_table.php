<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            // Relaciones
            $table->foreignId('auction_modality_id')
                ->constrained('auction_modalities')
                ->cascadeOnUpdate();

            $table->foreignId('auction_type_id')
                ->constrained('auction_types')
                ->cascadeOnUpdate();

            // Datos del remate
            $table->date('date');
            $table->string('time');

            $table->text('description')->nullable();

            // Imagen
            $table->string('image_path')->nullable();
            $table->string('image_alt')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};

