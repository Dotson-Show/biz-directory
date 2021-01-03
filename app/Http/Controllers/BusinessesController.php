<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessesController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'business_name' => 'required',
            'description' => 'required',
            'website_url' => 'required',
            'contact_email' => 'required',
            'contact_phone' => 'required',
            'contact_address' => 'required',
            'image' => '',
            'is_active' => 'required',
        ]);

        Business::create($data);
    }
}
