<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    /**
     * Display a listing of the quote requests.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $quoteRequests = QuoteRequest::latest()->paginate(10);
        
        // Debug: Log the quote requests being retrieved
        \Illuminate\Support\Facades\Log::info('Quote Requests count: ' . $quoteRequests->count());
        \Illuminate\Support\Facades\Log::info('Quote Requests total: ' . $quoteRequests->total());
        
        return view('admin.quotes.index', compact('quoteRequests'));
    }

    /**
     * Display the specified quote request.
     *
     * @param  \App\Models\QuoteRequest  $quoteRequest
     * @return \Illuminate\View\View
     */
    public function show(QuoteRequest $quoteRequest)
    {
        // Load the fruits relationship
        $quoteRequest->load('fruits');
        
        return view('admin.quotes.show', compact('quoteRequest'));
    }

    /**
     * Update the status of the specified quote request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuoteRequest  $quoteRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, QuoteRequest $quoteRequest)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:new,responded,completed',
        ]);
        
        $quoteRequest->update([
            'status' => $validated['status'],
        ]);
        
        return redirect()->route('admin.quotes.show', $quoteRequest)
            ->with('success', 'Quote request status updated successfully.');
    }

    /**
     * Remove the specified quote request from storage.
     *
     * @param  \App\Models\QuoteRequest  $quoteRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(QuoteRequest $quoteRequest)
    {
        // Delete the quote request
        $quoteRequest->delete();
        
        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote request deleted successfully.');
    }
}
