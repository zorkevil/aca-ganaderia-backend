<?php

namespace App\Jobs;

use App\Models\ContactForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ProcessContactForms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        // Obtener todos los formularios no enviados
        $contactForms = ContactForm::where('enviado', 0)->get();

        // Si no hay formularios pendientes, salir
        if ($contactForms->isEmpty()) {
            Log::info('No hay formularios de contacto pendientes de envío');
            return;
        }

        Log::info("Procesando {$contactForms->count()} formularios de contacto");

        // Mapeo de secciones a emails
        $sectionEmails = [
            'nutricion' => 'cjalil@acacoop.com.ar',
            'sanidad' => 'jghirardi@gmail.com',
            'hacienda' => 'rmiguez@acacoop.com.ar',
            'produccion' => 'aaghemo@acacoop.com.ar',
            'tambo' => 'gpujol@acacoop.com.ar',
            'carne' => 'aaghemo@acacoop.com.ar',
            'proyecto_campo_ganadero' => 'alejandrolisyc@gmail.com'
        ];

        // Procesar cada formulario individualmente
        foreach ($contactForms as $form) {
            try {

                // Determinar el email destino según la sección
                $destinatario = $sectionEmails[$form->section] ?? null;

                if (!$destinatario) {
                    Log::warning("Sección desconocida: {$form->section} para el formulario ID {$form->id}");
                    continue;
                }

                // Enviar el email
                Mail::send('emails.contact-form', ['form' => $form], function ($message) use ($form, $destinatario) {
                    $message->to($destinatario)
                            ->subject("Nueva consulta de contacto - Sitio Web ACA Ganaderia")
                            ->replyTo($form->email, "{$form->nombre} {$form->apellido}");
                });

                // Marcar como enviado
                $form->enviado = 1;
                $form->save();

                Log::info("Formulario ID {$form->id} enviado exitosamente a {$destinatario}");

            } catch (\Exception $e) {
                Log::error("Error al procesar formulario ID {$form->id}: " . $e->getMessage());
                // Continuar con el siguiente formulario aunque este falle
            }
        }

        Log::info('Proceso de envío de formularios completado');
    }
}