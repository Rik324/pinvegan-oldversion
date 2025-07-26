<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Contact information for the business
        $contactInfo = [
            'address' => '123 Fruit Street, Orchard District, City, Country',
            'phone' => '+1 (555) 123-4567',
            'email' => 'info@fahadmart.com',
            'hours' => 'Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: Closed',
            'map_location' => [40.7128, -74.0060], // Example coordinates (New York City)
        ];
        
        return view('contact', compact('contactInfo'));
    }
    
    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // In a real application, you would send an email here
        // For now, we'll just redirect with a success message
        
        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
