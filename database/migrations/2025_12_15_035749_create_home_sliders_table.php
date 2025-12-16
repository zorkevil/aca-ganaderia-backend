<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('home_sliders', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('sort_order')->default(1);
      $table->string('text', 255);
      $table->string('alt', 125);
      $table->string('link', 2048)->nullable();
      $table->string('image_path', 1024)->nullable();
      $table->boolean('is_active')->default(true);
      $table->timestamps();

      $table->index(['is_active', 'sort_order']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('home_sliders');
  }
};
