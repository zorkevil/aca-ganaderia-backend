<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('mag_prices', function (Blueprint $table) {
      $table->id();
      $table->date('fecha');
      $table->string('categoria');
      $table->decimal('maximo', 12, 3)->nullable();
      $table->decimal('minimo', 12, 3)->nullable();
      $table->decimal('promedio', 12, 3)->nullable();
      $table->decimal('promedio_kgs', 12, 3)->nullable();
      $table->timestamps();

      $table->unique(['fecha', 'categoria']); // idempotente (no duplica)
    });
  }

  public function down(): void {
    Schema::dropIfExists('mag_prices');
  }
};

