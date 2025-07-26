<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with featured fruits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get featured fruits for the homepage
        $featuredFruits = \App\Models\Fruit::where('is_featured', true)
                            ->take(4)
                            ->get();
        
        // Get all fruits for categories section
        $categories = \App\Models\Fruit::select('category')
                        ->distinct()
                        ->whereNotNull('category')
                        ->take(6)
                        ->get()
                        ->pluck('category');
        
        return view('home', compact('featuredFruits', 'categories'));
    }
}
