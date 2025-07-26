<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fruit;
use App\Models\Category;

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
        $featuredFruits = Fruit::where('is_featured', true)
                            ->take(4)
                            ->get();
        
        // Get active categories for the categories section
        $categories = Category::where('is_active', true)
                        ->take(6)
                        ->get();
        
        return view('home', compact('featuredFruits', 'categories'));
    }
}
