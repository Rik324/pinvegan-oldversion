<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve a paginated list of quote requests from the database,
        // ordered by the most recent. The paginate() method returns a
        // paginator instance, which allows the view to render pagination links.
        $quoteRequests = QuoteRequest::latest()->paginate(10); // You can adjust the number of items per page.

        // Pass the retrieved quote requests to the view.
        // The compact() function creates an array containing variables and their values.
        return view('admin.quotes.index', compact('quoteRequests'));
    }

    /**
     * Display the specified resource.
     */
    public function show(QuoteRequest $quote)
    {
        // The 'with' method eagerly loads the 'fruits' relationship along with each fruit's category
        // to prevent the N+1 query problem, making the application more efficient.
        $quote->load('fruits.category');

        // Rename to quoteRequest for backward compatibility with the view
        $quoteRequest = $quote;
        
        return view('admin.quotes.show', compact('quoteRequest'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuoteRequest $quote)
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')->with('success', 'Quote request deleted successfully.');
    }
    
    /**
     * Update the status of the specified quote request.
     */
    public function updateStatus(Request $request, QuoteRequest $quote)
    {
        $request->validate([
            'status' => 'required|in:new,responded,completed',
        ]);
        
        $quote->update([
            'status' => $request->status,
        ]);
        
        return redirect()
            ->route('admin.quotes.show', ['quote' => $quote->id])
            ->with('success', 'Quote request status updated successfully.');
    }
}