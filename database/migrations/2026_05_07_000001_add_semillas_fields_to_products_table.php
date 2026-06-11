<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Compartido entre grupos
            $table->string('ciclo')->nullable()->after('especie_animal');
            $table->string('aptitud_de_uso')->nullable()->after('ciclo');
            $table->string('contenido_de_tanino')->nullable()->after('aptitud_de_uso');
            $table->string('calidad_de_ms')->nullable()->after('contenido_de_tanino');
            $table->text('perfil_sanitario')->nullable()->after('calidad_de_ms');

            // Solo Sorgo Granífero
            $table->string('altura_cm')->nullable()->after('perfil_sanitario');
            $table->string('despeje_de_panoja')->nullable()->after('altura_cm');

            // Solo Sorgo Forrajero
            $table->string('bmr')->nullable()->after('despeje_de_panoja');
            $table->string('porcentaje_de_panoja')->nullable()->after('bmr');
            $table->string('zona_de_adaptacion')->nullable()->after('porcentaje_de_panoja');
            $table->string('densidad_de_siembra')->nullable()->after('zona_de_adaptacion');

            // Solo Maíz doble propósito
            $table->string('tecnologia')->nullable()->after('densidad_de_siembra');
            $table->string('madurez_relativa')->nullable()->after('tecnologia');
            $table->string('comportamiento_a_vuelco_y_quebrado')->nullable()->after('madurez_relativa');
            $table->string('velocidad_de_secado')->nullable()->after('comportamiento_a_vuelco_y_quebrado');
            $table->string('textura_de_grano')->nullable()->after('velocidad_de_secado');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'ciclo',
                'aptitud_de_uso',
                'contenido_de_tanino',
                'calidad_de_ms',
                'perfil_sanitario',
                'altura_cm',
                'despeje_de_panoja',
                'bmr',
                'porcentaje_de_panoja',
                'zona_de_adaptacion',
                'densidad_de_siembra',
                'tecnologia',
                'madurez_relativa',
                'comportamiento_a_vuelco_y_quebrado',
                'velocidad_de_secado',
                'textura_de_grano',
            ]);
        });
    }
};
