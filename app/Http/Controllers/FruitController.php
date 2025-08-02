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
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $locale = app()->getLocale();
            
            // Search in translated name field
            $query->whereHas('translations', function($query) use ($searchTerm, $locale) {
                $query->where('locale', $locale)
                      ->where('name', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Apply category filter if provided
        if ($request->has('category_id') && !empty($request->category_id)) {
            // Get the category and its children
            $categoryId = $request->category_id;
            $category = \App\Models\Category::find($categoryId);
            
            if ($category) {
                // Get all child category IDs
                $childCategoryIds = $category->children()->where('is_active', true)->pluck('id')->toArray();
                
                // Include the parent category ID and all child category IDs in the filter
                $categoryIds = array_merge([$categoryId], $childCategoryIds);
                $query->whereIn('category_id', $categoryIds);
            } else {
                // If category not found, just use the requested ID
                $query->where('category_id', $categoryId);
            }
        } elseif ($request->has('category') && !empty($request->category)) {
            // For backward compatibility
            $query->where('category', $request->category);
        }
        
        // Apply sorting if provided
        if ($request->has('sort')) {
            $sortField = $request->sort;
            $sortDirection = $request->has('direction') ? $request->direction : 'asc';
            
            // Check if the sort field is a translatable attribute
            $translatableAttributes = ['name', 'description', 'origin', 'seasonality'];
            
            if (in_array($sortField, $translatableAttributes)) {
                // For translatable fields, we need to join with the translations table
                $locale = app()->getLocale();
                
                $query->join('fruit_translations', function($join) use ($locale) {
                    $join->on('fruits.id', '=', 'fruit_translations.fruit_id')
                         ->where('fruit_translations.locale', '=', $locale);
                })
                ->orderBy('fruit_translations.' . $sortField, $sortDirection)
                ->select('fruits.*'); // Make sure we only select from the fruits table to avoid duplicates
            } else {
                // For non-translatable fields, we can sort directly
                $query->orderBy($sortField, $sortDirection);
            }
        }
        
        $fruits = $query->paginate(12);
        
        // Fetch hierarchical categories structure
        $categories = [];
        $topLevelCategories = [];
        if (class_exists('\App\Models\Category')) {
            // Keep $categories for backward compatibility
            $categories = \App\Models\Category::where('is_active', true)->get();
            
            // Get top-level categories with their children for hierarchical display
            $topLevelCategories = \App\Models\Category::where('is_active', true)
                ->whereNull('parent_id')
                ->with(['children' => function($query) {
                    $query->where('is_active', true);
                }])
                ->get();
        }
        
        return view('fruits.index', compact('fruits', 'categories', 'topLevelCategories', 'locale'));
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
