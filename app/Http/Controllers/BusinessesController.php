<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessesController extends Controller
{
    public function store()
    {
        Business::create($this->validateRequest());
    }

    public function update(Business $business)
    {
        $business->update($this->validateRequest());
    }

    /**
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'business_name' => 'required',
            'description' => 'required',
            'website_url' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'contact_address' => 'required',
            'image' => '',
            'is_active' => 'required',
        ]);
    }
}
