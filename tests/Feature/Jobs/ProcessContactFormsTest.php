<?php

namespace Tests\Feature\Jobs;

use App\Enums\ContactFormSection;
use App\Jobs\ProcessContactForms;
use App\Models\ContactForm;
use App\Models\ContactFormRecipient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessContactFormsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Reactivar cuando el job vuelva a leer los emails desde contact_form_recipients
        $this->markTestSkipped('Emails de formularios desde la base: feature oculto por ahora.');
    }

    private function form(string $section): ContactForm
    {
        return ContactForm::create([
            'nombre' => 'Juan',
            'email' => 'juan@example.com',
            'mensaje' => 'Consulta',
            'section' => $section,
            'enviado' => 0,
        ]);
    }

    public function test_sends_form_to_active_recipient_of_its_section(): void
    {
        ContactFormRecipient::factory()->create(['section' => ContactFormSection::Tambo, 'is_active' => true]);
        $form = $this->form('tambo');

        (new ProcessContactForms())->handle();

        $this->assertEquals(1, $form->fresh()->enviado);
    }

    public function test_keeps_form_pending_when_section_has_no_active_recipient(): void
    {
        ContactFormRecipient::factory()->create(['section' => ContactFormSection::Tambo, 'is_active' => false]);
        $form = $this->form('tambo');

        (new ProcessContactForms())->handle();

        $this->assertEquals(0, $form->fresh()->enviado);
    }
}
