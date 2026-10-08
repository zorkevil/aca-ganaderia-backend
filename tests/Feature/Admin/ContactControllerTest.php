<?php

namespace Tests\Feature\Admin;

use App\Models\Contact;
use App\Models\GeneralCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function payload(GeneralCategory $section, bool $active): array
    {
        return [
            'name' => 'Juan Pérez',
            'phone' => '+54 9 11 1234-5678',
            'general_category_id' => $section->id,
            'is_active' => $active ? 1 : 0,
        ];
    }

    public function test_store_creates_active_contact_in_free_section(): void
    {
        $section = GeneralCategory::factory()->create();

        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contacts.store'), $this->payload($section, true))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('contacts', ['general_category_id' => $section->id, 'is_active' => true]);
    }

    public function test_store_rejects_second_active_contact_in_same_section(): void
    {
        $existing = Contact::factory()->create(['is_active' => true]);

        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contacts.store'), $this->payload($existing->generalCategory, true))
            ->assertSessionHasErrors('general_category_id');

        $this->assertDatabaseCount('contacts', 1);
    }

    public function test_store_allows_inactive_contact_in_section_with_active_one(): void
    {
        $existing = Contact::factory()->create(['is_active' => true]);

        $this->actingAs($this->admin())
            ->post(route('admin.configuration.contacts.store'), $this->payload($existing->generalCategory, false))
            ->assertSessionHasNoErrors();

        $this->assertDatabaseCount('contacts', 2);
    }

    public function test_update_keeps_active_contact_without_conflicting_with_itself(): void
    {
        $contact = Contact::factory()->create(['is_active' => true]);

        $this->actingAs($this->admin())
            ->put(route('admin.configuration.contacts.update', $contact), $this->payload($contact->generalCategory, true))
            ->assertSessionHasNoErrors();
    }

    public function test_update_rejects_activating_contact_in_section_with_active_one(): void
    {
        $active = Contact::factory()->create(['is_active' => true]);
        $inactive = Contact::factory()->create([
            'general_category_id' => $active->general_category_id,
            'is_active' => false,
        ]);

        $this->actingAs($this->admin())
            ->put(route('admin.configuration.contacts.update', $inactive), $this->payload($active->generalCategory, true))
            ->assertSessionHasErrors('general_category_id');

        $this->assertFalse($inactive->fresh()->is_active);
    }

    public function test_non_admin_cannot_store_contact(): void
    {
        $section = GeneralCategory::factory()->create();

        $this->actingAs(User::factory()->create(['is_admin' => false]))
            ->post(route('admin.configuration.contacts.store'), $this->payload($section, true))
            ->assertForbidden();
    }
}
