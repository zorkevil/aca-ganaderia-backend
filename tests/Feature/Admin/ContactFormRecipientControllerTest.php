<?php

namespace Tests\Feature\Admin;

use App\Enums\ContactFormSection;
use App\Models\ContactFormRecipient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormRecipientControllerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function payload(ContactFormSection $section, bool $active): array
    {
        return [
            'email' => 'leads@acacoop.com.ar',
            'section' => $section->value,
            'is_active' => $active ? 1 : 0,
        ];
    }

    public function test_store_creates_active_recipient_in_free_section(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contact-form-recipients.store'), $this->payload(ContactFormSection::Tambo, true))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('contact_form_recipients', ['section' => 'tambo', 'is_active' => true]);
    }

    public function test_store_rejects_unknown_section(): void
    {
        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contact-form-recipients.store'), [
                'email' => 'leads@acacoop.com.ar',
                'section' => 'inexistente',
                'is_active' => 1,
            ])
            ->assertSessionHasErrors('section');
    }

    public function test_store_rejects_second_active_recipient_in_same_section(): void
    {
        ContactFormRecipient::factory()->create(['section' => ContactFormSection::Carne, 'is_active' => true]);

        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contact-form-recipients.store'), $this->payload(ContactFormSection::Carne, true))
            ->assertSessionHasErrors('section');

        $this->assertDatabaseCount('contact_form_recipients', 1);
    }

    public function test_store_allows_inactive_recipient_in_section_with_active_one(): void
    {
        ContactFormRecipient::factory()->create(['section' => ContactFormSection::Carne, 'is_active' => true]);

        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contact-form-recipients.store'), $this->payload(ContactFormSection::Carne, false))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('contact_form_recipients', 2);
    }

    public function test_update_keeps_active_recipient_without_conflicting_with_itself(): void
    {
        $recipient = ContactFormRecipient::factory()->create(['section' => ContactFormSection::Sanidad, 'is_active' => true]);

        $this->actingAs($this->admin())
            ->put(route('admin.configuration.contact-form-recipients.update', $recipient), $this->payload(ContactFormSection::Sanidad, true))
            ->assertSessionHasNoErrors();
    }

    public function test_update_rejects_activating_recipient_in_section_with_active_one(): void
    {
        ContactFormRecipient::factory()->create(['section' => ContactFormSection::Sanidad, 'is_active' => true]);
        $inactive = ContactFormRecipient::factory()->create(['section' => ContactFormSection::Sanidad, 'is_active' => false]);

        $this->actingAs($this->admin())
            ->put(route('admin.configuration.contact-form-recipients.update', $inactive), $this->payload(ContactFormSection::Sanidad, true))
            ->assertSessionHasErrors('section');

        $this->assertFalse($inactive->fresh()->is_active);
    }

    public function test_non_admin_cannot_store_recipient(): void
    {
        $this->actingAs(User::factory()->create(['is_admin' => false]))
            ->post(route('admin.configuration.contact-form-recipients.store'), $this->payload(ContactFormSection::Tambo, true))
            ->assertForbidden();
    }
}
