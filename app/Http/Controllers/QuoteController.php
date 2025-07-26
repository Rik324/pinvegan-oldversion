<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QuoteController extends Controller
{
    /**
     * Display the quote request form with selected fruits.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
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
        
        return view('quote.index', compact('quoteItems'));
    }
    
    /**
     * Add a fruit to the quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToQuote(Request $request)
    {
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
        
        return redirect()->back()->with('success', 'Fruit added to your quote request.');
    }
    
    /**
     * Remove a fruit from the quote request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromQuote($id)
    {
        // Get existing quote items from session
        $sessionItems = Session::get('quote_items', []);
        
        // Remove the fruit from the quote items
        if (isset($sessionItems[$id])) {
            unset($sessionItems[$id]);
        }
        
        // Store updated quote items in session
        Session::put('quote_items', $sessionItems);
        
        return redirect()->route('quote.index')->with('success', 'Fruit removed from your quote request.');
    }
    
    /**
     * Store a new quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
        ]);
        
        // Get quote items from session
        $sessionItems = Session::get('quote_items', []);
        
        // Check if there are any items in the quote
        if (empty($sessionItems)) {
            return redirect()->route('quote.index')
                ->with('error', 'Your quote request is empty. Please add some fruits first.');
        }
        
        // Create the quote request
        $quoteRequest = QuoteRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
            'status' => 'new',
        ]);
        
        // Add the fruits to the quote request
        foreach ($sessionItems as $fruitId => $quantity) {
            $quoteRequest->fruits()->attach($fruitId, ['quantity' => $quantity]);
        }
        
        // Clear the quote items from the session
        Session::forget('quote_items');
        
        // In a real application, you would send an email notification here
        
        return redirect()->route('home')
            ->with('success', 'Your quote request has been submitted successfully. We will contact you soon!');
    }
    
    /**
     * Clear all items from the quote request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearQuote()
    {
        // Clear all quote items from the session
        Session::forget('quote_items');
        
        return redirect()->route('quote.index')
            ->with('success', 'All items have been removed from your quote request.');
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
                ->with('success', 'Item quantity updated successfully.');
        }
        
        return redirect()->route('quote.index')
            ->with('error', 'Item not found in your quote request.');
    }
}
