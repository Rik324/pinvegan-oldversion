<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fruit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class FruitController extends Controller
{
    /**
     * Display a listing of the fruits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get current locale for sorting
        $locale = App::getLocale();
        
        // Join with translations table to sort by translated name
        $fruits = Fruit::join('fruit_translations as ft', function($join) use ($locale) {
                $join->on('fruits.id', '=', 'ft.fruit_id')
                     ->where('ft.locale', '=', $locale);
            })
            ->select('fruits.*')
            ->orderBy('ft.name')
            ->paginate(10);
            
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
        // Debug: Log the request method and data
        Log::info('Store method called with method: ' . $request->method());
        Log::info('Request data: ', $request->all());
        
        // Prepare validation rules
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // max 2MB
            'price' => 'nullable|numeric|min:0'
        ];
        
        // Add translatable field rules
        $locales = ['en', 'th', 'zh']; // Supported locales
        foreach ($locales as $locale) {
            $rules["{$locale}.name"] = 'required|string|max:255';
            $rules["{$locale}.description"] = 'required|string';
            $rules["{$locale}.origin"] = 'nullable|string|max:255';
            $rules["{$locale}.seasonality"] = 'nullable|string|max:255';
        }
        
        // Validate all fields at once
        try {
            $validated = $request->validate($rules);
            Log::info('Validation passed successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed: ' . json_encode($e->errors()));
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }
        
        try {
            
            // Prepare non-translatable data
            $nonTranslatableData = [
                'category_id' => $request->category_id,
                'is_available' => $request->has('is_available'),
                'is_featured' => $request->has('is_featured'),
                'price' => $request->price
            ];
            
            Log::info('Non-translatable data:', $nonTranslatableData);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                Log::info('Processing image upload');
                $image = $request->file('image');
                
                // Log image details for debugging
                Log::info('Image details:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'extension' => $image->getClientOriginalExtension()
                ]);
                
                // Use English name for the filename or a timestamp if not available
                $nameForFile = $request->input('en.name', 'fruit_' . time());
                
                // Ensure the directory exists
                $directory = public_path('storage/fruits');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                    Log::info('Created directory: ' . $directory);
                }
                
                // Generate unique filename
                $filename = 'fruit_' . Str::slug($nameForFile) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $fullPath = $directory . '/' . $filename;
                
                // Move the uploaded file directly to the public directory
                if ($image->move($directory, $filename)) {
                    Log::info('Image successfully moved to: ' . $fullPath);
                    
                    // Set the URL for database - use relative path for consistency
                    $nonTranslatableData['image'] = '/storage/fruits/' . $filename;
                    Log::info('Image URL for database: ' . $nonTranslatableData['image']);
                } else {
                    Log::error('Failed to move uploaded file to destination');
                    throw new \Exception('Failed to move uploaded file');
                }
            }
            
            // Create the fruit with non-translatable fields
            Log::info('Creating fruit with data:', $nonTranslatableData);
            $fruit = Fruit::create($nonTranslatableData);
            Log::info('Fruit created with ID: ' . $fruit->id);
            
            // Add translations for each locale
            Log::info('Adding translations for fruit');
            foreach ($locales as $locale) {
                Log::info("Processing translations for locale: {$locale}");
                $fruit->translateOrNew($locale)->name = $request->input("{$locale}.name");
                $fruit->translateOrNew($locale)->description = $request->input("{$locale}.description");
                $fruit->translateOrNew($locale)->origin = $request->input("{$locale}.origin");
                $fruit->translateOrNew($locale)->seasonality = $request->input("{$locale}.seasonality");
                
                Log::info("Set {$locale} translation fields: ", [
                    'name' => $request->input("{$locale}.name"),
                    'description' => $request->input("{$locale}.description"),
                    'origin' => $request->input("{$locale}.origin"),
                    'seasonality' => $request->input("{$locale}.seasonality")
                ]);
            }
            
            // Save the translations
            $fruit->save();
            Log::info('Fruit translations saved successfully');
            
            return redirect()->route('admin.fruits.index')
                            ->with('success', 'Fruit created successfully.');
                            
        } catch (\Exception $e) {
            Log::error('Exception during fruit creation: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create fruit: ' . $e->getMessage());
        }
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
        // Debug: Log the request method and data
        Log::info('Update method called with method: ' . $request->method());
        Log::info('Request data: ', $request->all());
        
        // Validate non-translatable fields
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'price' => 'nullable|numeric|min:0'
        ]);

        // Validate translatable fields for each locale
        $locales = ['en', 'th', 'zh']; // Supported locales
        foreach ($locales as $locale) {
            $request->validate([
                "{$locale}.name" => 'required|string|max:255',
                "{$locale}.description" => 'required|string',
                "{$locale}.origin" => 'nullable|string|max:255',
                "{$locale}.seasonality" => 'nullable|string|max:255',
            ]);
        }

        // Prepare update data for non-translatable fields
        $updateData = [
            'category_id' => $request->category_id,
            'is_available' => $request->has('is_available'),
            'is_featured' => $request->has('is_featured'),
            'price' => $request->price
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            try {
                // Delete old image if exists and not from unsplash
                if ($fruit->image && !Str::contains($fruit->image, 'unsplash.com')) {
                    // Handle both storage and direct public paths
                    if (Str::startsWith($fruit->image, '/storage/')) {
                        $oldPath = public_path(substr($fruit->image, 1)); // Remove leading slash
                        if (file_exists($oldPath)) {
                            unlink($oldPath);
                            Log::info('Deleted old image: ' . $oldPath);
                        }
                    } else {
                        $oldPath = str_replace('/storage/', 'public/', $fruit->image);
                        Storage::delete($oldPath);
                        Log::info('Deleted old image from storage: ' . $oldPath);
                    }
                }
                
                $image = $request->file('image');
                Log::info('Image details:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'extension' => $image->getClientOriginalExtension()
                ]);
                
                // Use English name for the filename or existing name
                $nameForFile = $request->input('en.name', $fruit->translate('en')->name ?? 'fruit_' . time());
                
                // Ensure the directory exists
                $directory = public_path('storage/fruits');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                    Log::info('Created directory: ' . $directory);
                }
                
                // Generate unique filename
                $filename = 'fruit_' . Str::slug($nameForFile) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $fullPath = $directory . '/' . $filename;
                
                // Move the uploaded file directly to the public directory
                if ($image->move($directory, $filename)) {
                    Log::info('Image successfully moved to: ' . $fullPath);
                    
                    // Verify file exists after move
                    if (file_exists($fullPath)) {
                        Log::info('File exists check passed');
                        
                        // Set the URL for database - use relative path for consistency
                        $updateData['image'] = '/storage/fruits/' . $filename;
                        Log::info('Image URL for database: ' . $updateData['image']);
                    } else {
                        Log::error('File does not exist after move: ' . $fullPath);
                        throw new \Exception('Failed to save image: file not found after move');
                    }
                } else {
                    Log::error('Failed to move uploaded file to destination');
                    throw new \Exception('Failed to move uploaded file');
                }
            } catch (\Exception $e) {
                Log::error('Error processing image upload: ' . $e->getMessage());
                Log::error($e->getTraceAsString());
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to update fruit. Image upload error: ' . $e->getMessage())
                    ->with('image_error', 'Image upload failed: ' . $e->getMessage());
            }
        }

        try {
            // Log before update
            Log::info('About to update fruit with ID: ' . $fruit->id);
            Log::info('Update data: ', $updateData);
            
            // Update non-translatable fields
            $fruit->update($updateData);
            
            // Update translations for each locale
            foreach ($locales as $locale) {
                $fruit->translateOrNew($locale)->name = $request->input("{$locale}.name");
                $fruit->translateOrNew($locale)->description = $request->input("{$locale}.description");
                $fruit->translateOrNew($locale)->origin = $request->input("{$locale}.origin");
                $fruit->translateOrNew($locale)->seasonality = $request->input("{$locale}.seasonality");
            }
            $fruit->save();
            
            // Log result
            Log::info('Fruit after update: ', $fruit->toArray());
            
            return redirect()->route('admin.fruits.index')
                ->with('success', 'Fruit updated successfully.');
        } catch (\Exception $e) {
            Log::error('Exception during fruit update: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            $errorMessage = 'Failed to update fruit';
            
            return redirect()->back()
                ->withInput()
                ->with('error', $errorMessage . ': ' . $e->getMessage());
        }
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
