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
     * Custom method to handle file uploads for Hostinger environment
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $filename
     * @return string The relative path to the file
     */
    private function uploadFileToHostinger($file, $filename)
    {
        // For production environment on Hostinger
        if (app()->environment('production')) {
            // Debug the environment
            Log::info('Current environment: ' . app()->environment());
            
            // The correct path for Hostinger - DIRECT PATH
            $targetPath = '/files/public_html/storage/fruits';
            
            // Log all attempts for debugging
            Log::info('Attempting to upload to path: ' . $targetPath);
            
            try {
                // Ensure directory exists
                if (!file_exists($targetPath)) {
                    Log::info('Directory does not exist, creating: ' . $targetPath);
                    mkdir($targetPath, 0755, true);
                }
                
                // Move file directly to the correct location
                $file->move($targetPath, $filename);
                
                // Log the file path for debugging
                Log::info('SUCCESS: File uploaded directly to: ' . $targetPath . '/' . $filename);
                
                // Return the relative path for URL generation
                return $filename;
            } catch (\Exception $e) {
                // If the direct path fails, try an alternative path
                Log::error('Failed to upload to ' . $targetPath . ': ' . $e->getMessage());
                
                // Try alternative path
                $altPath = '/home/u795170655/domains/wheat-goshawk-159141.hostingersite.com/public_html/storage/fruits';
                Log::info('Trying alternative path: ' . $altPath);
                
                try {
                    // Ensure directory exists
                    if (!file_exists($altPath)) {
                        Log::info('Alt directory does not exist, creating: ' . $altPath);
                        mkdir($altPath, 0755, true);
                    }
                    
                    // Move file to alternative location
                    $file->move($altPath, $filename);
                    Log::info('SUCCESS: File uploaded to alternative path: ' . $altPath . '/' . $filename);
                    return $filename;
                } catch (\Exception $e2) {
                    Log::error('Failed to upload to alternative path: ' . $e2->getMessage());
                    throw $e2;
                }
            }
        } else {
            // For local development, use Laravel's Storage facade
            $path = Storage::disk('public')->putFileAs('fruits', $file, $filename);
            return $filename;
        }
    }
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
            ->with(['category' => function($query) {
                // Load the category with its parent relationship
                $query->with('parent');
            }])
            ->orderBy('fruits.created_at', 'desc')
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
        // Get parent categories and their children
        $parentCategories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => function($query) {
                $query->where('is_active', true);
            }])
            ->get();
            
        // Also get categories without parent-child relationship for backwards compatibility
        $categories = Category::where('is_active', true)->get();
        
        return view('admin.fruits.create', compact('parentCategories', 'categories'));
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
            'category_id' => 'required|exists:categories,id,is_active,1', // Ensure category is active
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
                
                // Generate unique filename
                $filename = 'fruit_' . Str::slug($nameForFile) . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                try {
                    // Use our custom upload method
                    $uploadedFilename = $this->uploadFileToHostinger($image, $filename);
                    Log::info('Image uploaded with filename: ' . $uploadedFilename);
                    
                    if ($uploadedFilename) {
                        // Store just the filename in the database for simplicity
                        $nonTranslatableData['image'] = $uploadedFilename;
                        Log::info('Image filename for database: ' . $nonTranslatableData['image']);
                    } else {
                        throw new \Exception('Failed to store uploaded file');
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to store uploaded file: ' . $e->getMessage());
                    Log::error($e->getTraceAsString());
                    throw new \Exception('Failed to store uploaded file: ' . $e->getMessage());
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
        // Get parent categories and their children
        $parentCategories = Category::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children' => function($query) {
                $query->where('is_active', true);
            }])
            ->get();
            
        // Also get categories without parent-child relationship for backwards compatibility
        $categories = Category::where('is_active', true)->get();
        
        return view('admin.fruits.edit', compact('fruit', 'parentCategories', 'categories'));
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
            'category_id' => 'required|exists:categories,id,is_active,1', // Ensure category is active
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
                    if (Str::startsWith($fruit->image, 'storage/')) {
                        // Convert to storage path format
                        $oldPath = 'public/' . substr($fruit->image, 8); // Remove 'storage/' prefix
                        Storage::delete($oldPath);
                        Log::info('Deleted old image from storage: ' . $oldPath);
                    } else if (Str::startsWith($fruit->image, '/storage/')) {
                        // Handle legacy format with leading slash
                        $oldPath = 'public/' . substr($fruit->image, 9); // Remove '/storage/' prefix
                        Storage::delete($oldPath);
                        Log::info('Deleted old image from storage: ' . $oldPath);
                    } else {
                        // For any other format, try direct deletion
                        Storage::delete('public/fruits/' . basename($fruit->image));
                        Log::info('Attempted to delete old image: ' . $fruit->image);
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
                
                // Generate unique filename
                $filename = 'fruit_' . Str::slug($nameForFile) . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                try {
                    // Use our custom upload method
                    $uploadedFilename = $this->uploadFileToHostinger($image, $filename);
                    Log::info('Image uploaded with filename: ' . $uploadedFilename);
                    
                    if ($uploadedFilename) {
                        // Store just the filename in the database for simplicity
                        $updateData['image'] = $uploadedFilename;
                        Log::info('Image filename for database: ' . $updateData['image']);
                    } else {
                        throw new \Exception('Failed to store uploaded file');
                    }
                } catch (\Exception $e) {
                    Log::error('Failed to store uploaded file: ' . $e->getMessage());
                    Log::error($e->getTraceAsString());
                    
                    return redirect()->back()
                        ->withInput()
                        ->with('error', 'Failed to update fruit. Image upload error: ' . $e->getMessage())
                        ->with('image_error', 'Image upload failed: ' . $e->getMessage());
                }
            } catch (\Exception $e) {
                Log::error('Failed to store uploaded file: ' . $e->getMessage());
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
            // Get the filename - might be just the filename or a full path
            $filename = basename($fruit->image);
            
            // Try all possible paths where the file might be stored
            $possiblePaths = [
                storage_path('app/public/fruits/' . $filename),
                public_path('storage/fruits/' . $filename),
                '/files/public_html/storage/fruits/' . $filename,
                '/files/public_html/storage/public/fruits/' . $filename,
                '/home/u795170655/domains/wheat-goshawk-159141.hostingersite.com/public_html/storage/fruits/' . $filename
            ];
            
            $deleted = false;
            
            // Try to delete from each possible location
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    unlink($path);
                    Log::info('Deleted image file from path: ' . $path);
                    $deleted = true;
                    break;
                }
            }
            
            if (!$deleted) {
                Log::warning('Could not find image file to delete: ' . $fruit->image . ' in any of the expected locations');
            }
        }

        $fruit->delete();

        return redirect()->route('admin.fruits.index')
                        ->with('success', 'Fruit deleted successfully.');
    }
}
