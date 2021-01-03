<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Business;

class BusinessListingManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_business_can_be_added_to_the_list()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertOk();

        $this->assertCount(1, Business::all());
    }

    /** @test */
    public function a_business_name_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => '',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('business_name');

    }

    /** @test */
    public function a_description_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => '',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('description');

    }

    /** @test */
    public function a_website_url_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => '',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('website_url');

    }

    /** @test */
    public function a_contact_email_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => '',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('contact_email');

    }

    /** @test */
    public function a_contact_phone_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('contact_phone');

    }

    /** @test */
    public function a_contact_address_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '',
            'image' => '',
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors('contact_address');

    }

    /** @test */
    public function is_active_is_required()
    {
        $response = $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => '',
        ]);

        $response->assertSessionHasErrors('is_active');

    }

    /** @test */
    public function business_is_active()
    {
        $this->withoutExceptionHandling();

        $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $this->assertEquals(true, Business::first()->is_active);

    }

    /** @test */
    public function a_listed_business_can_be_modified()
    {
        $this->withoutExceptionHandling();

        $this->post('/businesses', [
            'business_name' => 'Peexoo',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.ai',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065778822',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $business = Business::first();

        $response = $this->patch('/businesses/' . $business->id, [
            'business_name' => 'Peexoo edited',
            'description' => 'A good description of what Peexoo does',
            'website_url' => 'peexoo.com',
            'contact_email' => 'contact@peexoo.ai',
            'contact_phone' => '2348065774433',
            'contact_address' => '1, Elugbade close, Ikoyi, Lagos',
            'image' => '',
            'is_active' => true,
        ]);

        $this->assertEquals('Peexoo edited', Business::first()->business_name);
        $this->assertEquals('peexoo.com', Business::first()->website_url);
        $this->assertEquals('2348065774433', Business::first()->contact_phone);
    }
}
