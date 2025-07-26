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
        // Debug: Log the request method and data
        Log::info('Update method called with method: ' . $request->method());
        Log::info('Request data: ', $request->all());
        
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'origin' => 'nullable|string|max:255',
            'taste_profile' => 'nullable|string|max:255',
            'seasonality' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // max 2MB
            'price' => 'nullable|numeric|min:0'
        ]);
        
        // Prepare data for update
        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'origin' => $request->origin,
            'taste_profile' => $request->taste_profile,
            'seasonality' => $request->seasonality,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'is_available' => $request->has('is_available'),
            'is_featured' => $request->has('is_featured')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            Log::info('Image file detected in request');
            
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
                
                // Create fruits directory in public/storage if it doesn't exist
                $directory = public_path('storage/fruits');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                    Log::info('Created directory: ' . $directory);
                }
                
                // Generate unique filename
                $filename = 'fruit_' . Str::slug($request->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
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
            }
        } else {
            Log::info('No image file in request');
        }

        try {
            // Log before update
            Log::info('About to update fruit with ID: ' . $fruit->id);
            Log::info('Update data: ', $updateData);
            
            // Perform the update using DB query builder to bypass any model issues
            $result = DB::table('fruits')
                ->where('id', $fruit->id)
                ->update($updateData);
            
            // Log result
            Log::info('Update result: ' . ($result ? 'success' : 'failure'));
            
            // Refresh the model to get updated data
            $fruit->refresh();
            Log::info('Fruit after update: ', $fruit->toArray());
            
            return redirect()->route('admin.fruits.index')
                ->with('success', 'Fruit updated successfully.');
        } catch (\Exception $e) {
            Log::error('Exception during fruit update: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            $errorMessage = 'Failed to update fruit';
            if (strpos($e->getMessage(), 'image') !== false) {
                $errorMessage .= '. There was a problem with the image upload';
                return redirect()->back()
                    ->withInput()
                    ->with('error', $errorMessage)
                    ->with('image_error', 'Image upload failed: ' . $e->getMessage());
            }
            
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
