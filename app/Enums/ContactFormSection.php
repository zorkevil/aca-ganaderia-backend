<?php

namespace App\Enums;

// Secciones que envía el formulario de contacto de Next (campo `section`)
enum ContactFormSection: string
{
    case Nutricion = 'nutricion';
    case Sanidad = 'sanidad';
    case Hacienda = 'hacienda';
    case Produccion = 'produccion';
    case Tambo = 'tambo';
    case Carne = 'carne';
    case ProyectoCampoGanadero = 'proyecto_campo_ganadero';

    public function label(): string
    {
        return match ($this) {
            self::Nutricion => 'Nutrición',
            self::Sanidad => 'Sanidad',
            self::Hacienda => 'Hacienda',
            self::Produccion => 'Producción',
            self::Tambo => 'Tambo',
            self::Carne => 'Carne',
            self::ProyectoCampoGanadero => 'Proyecto Campo Ganadero',
        };
    }
}
