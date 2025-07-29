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
        // Get all categories with their relationships loaded
        // First get parent categories (those without parent_id)
        $parentCategories = Category::with(['translations', 'children.translations'])
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Then get child categories that have a parent
        $childCategories = Category::with(['translations', 'parent.translations'])
            ->whereNotNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Combine both collections and paginate manually
        $allCategories = $parentCategories->merge($childCategories);
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $pagedData = $allCategories->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
        $categories = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $allCategories->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
            
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Get active parent categories (those with no parent) for the dropdown
        $parentCategories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with('translations')
            ->get();
            
        return view('admin.categories.create', compact('parentCategories'));
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
            'parent_id' => 'nullable|exists:categories,id',
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
        
        // Set parent_id if provided
        if ($request->filled('parent_id')) {
            $category->parent_id = $request->parent_id;
        }
        
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
        // Get active parent categories (those with no parent) for the dropdown
        // Exclude the current category and its children to prevent circular references
        $parentCategories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->with('translations')
            ->get();
        
        // Get child IDs to exclude them from potential parents
        $childIds = $category->children()->pluck('id')->toArray();
        
        // Filter out any children of the current category from parent options
        $parentCategories = $parentCategories->filter(function($parentCategory) use ($childIds) {
            return !in_array($parentCategory->id, $childIds);
        });
            
        return view('admin.categories.edit', compact('category', 'parentCategories'));
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
            'parent_id' => 'nullable|exists:categories,id',
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
        
        // Prevent circular references - a category can't be its own parent or descendant
        if ($request->filled('parent_id')) {
            $parentId = $request->parent_id;
            $currentId = $category->id;
            
            // Check if the selected parent is not the current category or its child
            if ($parentId == $currentId) {
                return redirect()->back()
                    ->withErrors(['parent_id' => __('admin.category_cannot_be_own_parent')])
                    ->withInput();
            }
            
            // Check if the selected parent is not a child of the current category
            $childCategories = Category::where('parent_id', $currentId)->pluck('id')->toArray();
            if (in_array($parentId, $childCategories)) {
                return redirect()->back()
                    ->withErrors(['parent_id' => __('admin.category_cannot_select_child_as_parent')])
                    ->withInput();
            }
        }

        // Update non-translatable fields
        $category->is_active = $request->has('is_active') ? true : false;
        
        // Update parent_id
        $category->parent_id = $request->filled('parent_id') ? $request->parent_id : null;
        
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
                            ->with('error', __('admin.cannot_delete_category_with_fruits'));
        }
        
        // Check if category has child categories
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.categories.index')
                            ->with('error', __('admin.cannot_delete_category_with_children'));
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
                        ->with('success', __('admin.category_deleted_successfully'));
    }
}
