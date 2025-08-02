<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Get the locale from the query parameter or use the default
        $locale = $request->query('locale', app()->getLocale());
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        // Contact information for the business
        $contactInfo = [
            'address' => '123 Fruit Street, Orchard District, City, Country',
            'phone' => '+1 (555) 123-4567',
            'email' => 'info@pinevegan.com',
            'hours' => 'Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 5:00 PM<br>Sunday: Closed',
            'map_location' => [13.7563, 100.5018], // Bangkok, Thailand coordinates
            'map_zoom' => 11, // Zoom level (1-20, where 1 is world view and 20 is max zoom)
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
        // Get the locale from the query parameter or use the default
        $locale = $request->query('locale', app()->getLocale());
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Send email
        $adminEmail = env('ADMIN_EMAIL', 'info@pinevegan.com'); // Get admin email from .env or use default
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'messageContent' => $validated['message'], // Changed from 'message' to 'messageContent' to avoid conflict
        ];
        
        try {
            // Send email to admin only
            Mail::send('emails.contact', $data, function($message) use ($adminEmail, $validated) {
                $message->to($adminEmail)
                        ->subject('New Contact Form Submission: ' . $validated['subject'])
                        ->replyTo($validated['email'], $validated['name']);
            });
            
            // Log successful submission
            Log::info('Contact form submitted successfully from: ' . $validated['email']);
            
            // Set success flash message
            $successMessage = __('frontend.contact_success_message', ['default' => 'Thank you for your message! We will get back to you soon.']);
            
            // Return redirect with success message (same pattern as QuoteController)
            return redirect()->route('contact')
                ->with('success', $successMessage)
                ->with('locale', app()->getLocale());
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to send contact email: ' . $e->getMessage());
            
            // Set error flash message
            $errorMessage = __('frontend.contact_error_message', ['default' => 'Sorry, there was a problem sending your message. Please try again later.']);
            
            // Return redirect with error message (same pattern as QuoteController)
            return redirect()->route('contact')
                ->with('error', $errorMessage)
                ->with('locale', app()->getLocale())
                ->withInput();
        }
    }
}
