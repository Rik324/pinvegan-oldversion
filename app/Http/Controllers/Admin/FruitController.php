<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FruitController extends Controller
{
    /**
     * Display a listing of the fruits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $fruits = Fruit::orderBy('name')->paginate(10);
        return view('admin.fruits.index', compact('fruits'));
    }

    /**
     * Show the form for creating a new fruit.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        
        return view('admin.fruits.create', compact('categories'));
    }

    /**
     * Store a newly created fruit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'origin' => 'nullable|string|max:255',
            'taste_profile' => 'nullable|string|max:255',
            'seasonality' => 'nullable|string|max:255',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // max 2MB
            'price' => 'nullable|numeric|min:0'
        ]);

        // Handle boolean checkboxes
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'fruit_' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/fruits', $filename);
            $validated['image'] = Storage::url($path);
        }

        Fruit::create($validated);

        return redirect()->route('admin.fruits.index')
                        ->with('success', 'Fruit created successfully.');
    }

    /**
     * Show the form for editing the specified fruit.
     *
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\View\View
     */
    public function edit(Fruit $fruit)
    {
        $categories = Category::orderBy('name')->get();
        
        return view('admin.fruits.edit', compact('fruit', 'categories'));
    }

    /**
     * Update the specified fruit in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Fruit $fruit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'origin' => 'nullable|string|max:255',
            'taste_profile' => 'nullable|string|max:255',
            'seasonality' => 'nullable|string|max:255',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // max 2MB
            'price' => 'nullable|numeric|min:0'
        ]);

        // Handle boolean checkboxes
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($fruit->image && !Str::contains($fruit->image, 'unsplash.com')) {
                $oldPath = str_replace('/storage/', 'public/', $fruit->image);
                Storage::delete($oldPath);
            }
            
            $image = $request->file('image');
            $filename = 'fruit_' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/fruits', $filename);
            $validated['image'] = Storage::url($path);
        }

        $fruit->update($validated);

        return redirect()->route('admin.fruits.index')
                        ->with('success', 'Fruit updated successfully.');
    }

    /**
     * Remove the specified fruit from storage.
     *
     * @param  \App\Models\Fruit  $fruit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fruit $fruit)
    {
        // Delete image if exists and not an external URL
        if ($fruit->image && !Str::contains($fruit->image, 'unsplash.com')) {
            $path = str_replace('/storage/', 'public/', $fruit->image);
            Storage::delete($path);
        }

        $fruit->delete();

        return redirect()->route('admin.fruits.index')
                        ->with('success', 'Fruit deleted successfully.');
    }
}
