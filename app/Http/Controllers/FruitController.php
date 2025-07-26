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
        $query = Fruit::query();
        
        // Apply category filter if provided
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }
        
        // Apply sorting if provided
        if ($request->has('sort')) {
            $sortField = $request->sort;
            $sortDirection = $request->has('direction') ? $request->direction : 'asc';
            $query->orderBy($sortField, $sortDirection);
        } else {
            // Default sorting by name
            $query->orderBy('name', 'asc');
        }
        
        $fruits = $query->paginate(12);
        // Fetch all active categories
        $categories = \App\Models\Category::where('is_active', true)->get();
        
        return view('fruits.index', compact('fruits', 'categories'));
    }
    
    /**
     * Display the specified fruit.
     *
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\View\View
     */
    public function show(Fruit $fruit)
    {
        return view('fruits.show', compact('fruit'));
    }
}
