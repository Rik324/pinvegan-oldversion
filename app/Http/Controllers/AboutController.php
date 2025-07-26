<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // In a real application, this data might come from a database
        $aboutData = [
            'title' => 'About Fahad Mart',
            'description' => 'We are a premier supplier of high-quality, fresh fruits sourced from local and international farms. Our mission is to provide the freshest and most delicious fruits to our customers.',
            'history' => 'Founded in 2010, Fahad Mart has grown from a small local fruit stand to a trusted supplier for events, restaurants, and health-conscious individuals across the region.',
            'mission' => 'To provide the freshest, highest quality fruits while supporting sustainable farming practices and building lasting relationships with our customers and suppliers.',
            'team' => [
                [
                    'name' => 'David Johnson',
                    'position' => 'Founder & CEO',
                    'bio' => 'With over 20 years of experience in the fruit industry, David founded Fahad Mart with a vision to bring the freshest fruits to customers.',
                ],
                [
                    'name' => 'Sarah Williams',
                    'position' => 'Procurement Manager',
                    'bio' => 'Sarah ensures we source only the best quality fruits from sustainable farms around the world.',
                ],
                [
                    'name' => 'Michael Chen',
                    'position' => 'Customer Relations',
                    'bio' => 'Michael is dedicated to ensuring our customers receive exceptional service and the highest quality products.',
                ],
            ],
        ];
        
        return view('about', compact('aboutData'));
    }
}
