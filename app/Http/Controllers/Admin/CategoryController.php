<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Prepare validation rules
        $rules = [
            'is_active' => 'boolean',
        ];

        // Add translatable field rules
        $locales = ['en', 'th', 'zh']; // Supported locales
        foreach ($locales as $locale) {
            $rules["{$locale}.name"] = 'required|string|max:255';
            $rules["{$locale}.description"] = 'nullable|string';
        }
        
        // Validate all fields at once
        try {
            $validated = $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        // Create category with non-translatable fields
        $category = new Category();
        $category->is_active = $request->has('is_active') ? true : false;
        
        // Generate slug from English name
        $category->slug = Str::slug($request->input('en.name'));
        $category->save();

        // Save translations for each locale
        foreach ($locales as $locale) {
            $category->translateOrNew($locale)->name = $request->input("{$locale}.name");
            $category->translateOrNew($locale)->description = $request->input("{$locale}.description");
        }
        $category->save();

        return redirect()->route('admin.categories.index')
                        ->with('success', __('admin.category_created_successfully'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {
        // Prepare validation rules
        $rules = [
            'is_active' => 'boolean',
        ];

        // Add translatable field rules
        $locales = ['en', 'th', 'zh']; // Supported locales
        foreach ($locales as $locale) {
            $rules["{$locale}.name"] = 'required|string|max:255';
            $rules["{$locale}.description"] = 'nullable|string';
        }
        
        // Validate all fields at once
        try {
            $validated = $request->validate($rules);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        // Update non-translatable fields
        $category->is_active = $request->has('is_active') ? true : false;
        
        // Generate slug from English name
        $category->slug = Str::slug($request->input('en.name'));
        $category->save();

        // Update translations for each locale
        foreach ($locales as $locale) {
            $category->translateOrNew($locale)->name = $request->input("{$locale}.name");
            $category->translateOrNew($locale)->description = $request->input("{$locale}.description");
        }
        $category->save();

        return redirect()->route('admin.categories.index')
                        ->with('success', __('admin.category_updated_successfully'));
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        // Check if category has fruits
        if ($category->fruits()->count() > 0) {
            return redirect()->route('admin.categories.index')
                            ->with('error', 'Cannot delete category with associated fruits. Remove the fruits first or reassign them to another category.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', 'Category deleted successfully.');
    }
}
