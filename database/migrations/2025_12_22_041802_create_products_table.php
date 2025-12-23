<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {




  public function up(): void
  {

    Schema::create('products', function (Blueprint $table) {
        $table->id();

        $table->string('sku')->unique();
        $table->string('slug')->unique();
        $table->string('name');
        $table->text('description')->nullable();
        
        $table->foreignId('general_category_id')->constrained();
        $table->foreignId('category_id')->constrained();
        $table->foreignId('subcategory_id')->nullable()->constrained();
        $table->string('second_category')->nullable();

        $table->string('presentation')->nullable();
        $table->text('formula')->nullable();
        $table->text('administration')->nullable();
        $table->text('dosage')->nullable();

        $table->string('senasa')->nullable();
        $table->string('especie_animal')->nullable();

        $table->string('image_path')->nullable();
        $table->string('image_alt')->nullable();

        $table->unsignedInteger('sales')->default(0);

        $table->date('date');
        $table->boolean('is_active')->default(true);

        $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};