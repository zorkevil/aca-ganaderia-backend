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
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('email');
            $table->string('telefono')->nullable();

            $table->string('rol')->nullable();
            $table->string('otro_rol')->nullable();
            $table->string('localidad')->nullable();
            $table->string('area')->nullable();

            $table->text('mensaje');

            // Sección desde donde se envió el formulario
            $table->string('section')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_forms');
    }
};
