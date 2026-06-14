<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that all institutional pages load successfully.
     */
    public function test_institutional_pages_return_successful_response(): void
    {
        $this->get(route('services'))->assertStatus(200);
        $this->get(route('short-trips'))->assertStatus(200);
        $this->get(route('group-trips'))->assertStatus(200);
        $this->get(route('faq'))->assertStatus(200);
        $this->get(route('contact'))->assertStatus(200);
    }

    /**
     * Test that contact form validation works.
     */
    public function test_contact_form_submission_validation(): void
    {
        // Missing fields should trigger errors
        $response = $this->post(route('contact.submit'), []);
        $response->assertSessionHasErrors(['name', 'email', 'message']);

        // Invalid email and message too short should trigger errors
        $response = $this->post(route('contact.submit'), [
            'name' => 'Igor Lopes',
            'email' => 'invalid-email',
            'message' => 'Curto',
        ]);
        $response->assertSessionHasErrors(['email', 'message']);
    }

    /**
     * Test that successful contact form submission redirects back with success message.
     */
    public function test_contact_form_submission_success(): void
    {
        $response = $this->post(route('contact.submit'), [
            'name' => 'Igor Lopes',
            'email' => 'igor@example.com',
            'phone' => '(85) 99999-9999',
            'message' => 'Gostaria de solicitar um orçamento personalizado para Jericoacoara.',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }
}
