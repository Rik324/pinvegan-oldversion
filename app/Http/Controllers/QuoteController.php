<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\QuoteRequest;
use App\Models\User;
use App\Notifications\QuoteRequestConfirmation;
use App\Notifications\QuoteRequestSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    /**
     * Display the quote request form with selected fruits.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request, $locale = null)
    {
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        // Get the quote items from the session
        $sessionItems = Session::get('quote_items', []);
        
        // Get the fruits for the items in the quote
        $fruitIds = array_keys($sessionItems);
        $quoteItems = [];
        
        if (!empty($fruitIds)) {
            $fruits = Fruit::whereIn('id', $fruitIds)->get();
            
            // Format quote items as objects with fruit and quantity properties
            foreach ($fruits as $fruit) {
                $quoteItems[] = (object) [
                    'id' => $fruit->id,
                    'fruit' => $fruit,
                    'quantity' => $sessionItems[$fruit->id]
                ];
            }
        }
        
        // Get the authenticated user's submitted quotes
        $userQuotes = null;
        if (Auth::check()) {
            $userQuotes = QuoteRequest::where('user_id', Auth::id())
                ->with('fruits')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('quote.index', compact('quoteItems', 'userQuotes'));
    }
    
    /**
     * Add a fruit to the quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToQuote(Request $request, $locale = null)
    {
        // Get locale from route parameter, form input, query parameter, or session
        $locale = $locale ?: $request->input('locale', $request->query('locale', session('locale', app()->getLocale())));
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        $validated = $request->validate([
            'fruit_id' => 'required|exists:fruits,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $fruitId = $validated['fruit_id'];
        $quantity = $validated['quantity'];
        
        // Get existing quote items from session
        $quoteItems = Session::get('quote_items', []);
        
        // Add or update the quantity for this fruit
        if (isset($quoteItems[$fruitId])) {
            $quoteItems[$fruitId] += $quantity;
        } else {
            $quoteItems[$fruitId] = $quantity;
        }
        
        // Store updated quote items in session
        Session::put('quote_items', $quoteItems);
        
        // Redirect directly to the quote request page with locale
        $successMessage = __('frontend.quote_item_added', ['default' => 'Fruit added to your quote request.']);
        return redirect()->route('quote.index')
                ->with('success', $successMessage)
                ->with('locale', app()->getLocale());
    }
    
    /**
     * Remove a fruit from the quote request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromQuote($id, $locale = null)
    {
        // Get request object
        $request = request();
        
        // Get locale from route parameter, form input, query parameter, or session
        $locale = $locale ?: $request->input('locale', $request->query('locale', session('locale', app()->getLocale())));
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        // Get existing quote items from session
        $sessionItems = Session::get('quote_items', []);
        
        // Remove the fruit from the quote items
        if (isset($sessionItems[$id])) {
            unset($sessionItems[$id]);
        }
        
        // Store updated quote items in session
        Session::put('quote_items', $sessionItems);
        
        return redirect()->route('quote.index')
            ->with('success', 'Fruit removed from your quote request.')
            ->with('locale', app()->getLocale());
    }
    
    /**
     * Store a new quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Get the locale from the query parameter, form input, or use the default
        $locale = $request->input('locale', $request->query('locale', session('locale', app()->getLocale())));
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        // Validate the form data - user is authenticated so we only need additional fields
        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
        ]);
        
        // Get authenticated user data
        $user = $request->user();
        
        // Get quote items from session
        $sessionItems = Session::get('quote_items', []);
        
        // Check if there are any items in the quote
        if (empty($sessionItems)) {
            return redirect()->route('quote.index')
                ->with('error', 'Your quote request is empty. Please add some fruits first.')
                ->with('locale', app()->getLocale());
        }
        
        // Create the quote request using authenticated user data
        $quoteRequest = new QuoteRequest([
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'new',
            'user_id' => $user->id, // Associate with the authenticated user
        ]);
        
        // Save the quote request to get an ID
        $quoteRequest->save();
        
        // Debug: Log the quote request ID and session items
        Log::info('Quote Request created with ID: ' . $quoteRequest->id);
        Log::info('Session items: ', $sessionItems);
        
        // Verify fruits exist before attaching
        $existingFruitIds = Fruit::whereIn('id', array_keys($sessionItems))->pluck('id')->toArray();
        Log::info('Existing fruit IDs: ', $existingFruitIds);
        
        // Add the fruits to the quote request
        foreach ($sessionItems as $fruitId => $quantity) {
            // Convert to integer to ensure proper type comparison
            $fruitId = (int)$fruitId;
            
            // Check if the fruit exists
            if (in_array($fruitId, $existingFruitIds)) {
                try {
                    $quoteRequest->fruits()->attach($fruitId, ['quantity' => $quantity]);
                    Log::info('Attached fruit ID ' . $fruitId . ' with quantity ' . $quantity);
                } catch (\Exception $e) {
                    Log::error('Error attaching fruit: ' . $e->getMessage());
                }
            } else {
                Log::warning('Fruit ID ' . $fruitId . ' does not exist, skipping');
            }
        }
        
        // Clear the quote items from the session
        Session::forget('quote_items');
        
        // Send notification to admin users
        try {
            $admin = User::where('email', config('app.admin_email', 'admin@example.com'))->first();
            if ($admin) {
                $admin->notify(new QuoteRequestSubmitted($quoteRequest));
                Log::info('Quote request notification sent to admin');
            } else {
                Log::warning('Admin user not found for notification');
            }
            
            // Send confirmation notification to the customer
            // Since the user is authenticated, we can notify them directly
            $user->notify(new QuoteRequestConfirmation($quoteRequest));
            
            Log::info('Quote request confirmation sent to customer: ' . $validated['email']);
        } catch (\Exception $e) {
            Log::error('Failed to send quote request notification: ' . $e->getMessage());
        }
        
        return redirect()->route('quote.index')
            ->with('success', __('frontend.quote_request_success'))
            ->with('locale', app()->getLocale());
    }
    
    /**
     * Clear all items from the quote request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearQuote(Request $request)
    {
        // Get locale from form input, query parameter, or session
        $locale = $request->input('locale', $request->query('locale', session('locale', app()->getLocale())));
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        
        // Clear all quote items from the session
        Session::forget('quote_items');
        
        return redirect()->route('quote.index')
            ->with('success', 'All items have been removed from your quote request.')
            ->with('locale', app()->getLocale());
    }
    
    /**
     * Update the quantity of a fruit in the quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateQuoteItem(Request $request, $id)
    {
        // Get locale from form input, query parameter, or session
        $locale = $request->input('locale', $request->query('locale', session('locale', app()->getLocale())));
        
        if ($locale && in_array($locale, ['en', 'th', 'zh'], true)) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
        }
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        
        // Get existing quote items from session
        $sessionItems = Session::get('quote_items', []);
        
        // Update the quantity for this fruit
        if (isset($sessionItems[$id])) {
            $sessionItems[$id] = $validated['quantity'];
            
            // Store updated quote items in session
            Session::put('quote_items', $sessionItems);
            
            return redirect()->route('quote.index')
                ->with('success', 'Item quantity updated successfully.')
                ->with('locale', app()->getLocale());
        }
        
        return redirect()->route('quote.index')
            ->with('error', 'Item not found in your quote request.')
            ->with('locale', app()->getLocale());
    }
}
