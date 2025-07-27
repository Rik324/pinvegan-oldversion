<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    /**
     * Display a listing of all fruits.
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
        
        $query = Fruit::query();
        
        // Apply category filter if provided
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->where('category_id', $request->category_id);
        } elseif ($request->has('category') && !empty($request->category)) {
            // For backward compatibility
            $query->where('category', $request->category);
        }
        
        // Apply sorting if provided
        if ($request->has('sort')) {
            $sortField = $request->sort;
            $sortDirection = $request->has('direction') ? $request->direction : 'asc';
            $query->orderBy($sortField, $sortDirection);
        }
        
        $fruits = $query->paginate(12);
        
        // Fetch all active categories if the Category model exists
        $categories = [];
        if (class_exists('\App\Models\Category')) {
            $categories = \App\Models\Category::where('is_active', true)->get();
        }
        
        return view('fruits.index', compact('fruits', 'categories', 'locale'));
    }
    
    /**
     * Display the specified fruit.
     *
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\View\View
     */
    public function show(Fruit $fruit, Request $request)
    {
        // Get the locale from the query parameter or use the default
        $locale = $request->query('locale', app()->getLocale());
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        
        return view('fruits.show', compact('fruit', 'locale'));
    }
}
