<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('title');
            $table->string('icon_path')->nullable();
            $table->string('icon_alt')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('section');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
