<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListingRequest;
use Illuminate\Http\Request;

class ListingRequestController extends Controller
{
    public function index(Request $request)
    {
        $requests = ListingRequest::when($request->search, fn($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('institute_name', 'like', "%{$s}%")
                  ->orWhere('owner_name', 'like', "%{$s}%")
                  ->orWhere('mobile', 'like', "%{$s}%")
                  ->orWhere('city', 'like', "%{$s}%");
            }))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(20);

        if ($request->ajax()) {
            return response()->json([
                'data'       => $requests->items(),
                'pagination' => [
                    'total'        => $requests->total(),
                    'per_page'     => $requests->perPage(),
                    'current_page' => $requests->currentPage(),
                    'last_page'    => $requests->lastPage(),
                    'from'         => $requests->firstItem() ?? 0,
                    'to'           => $requests->lastItem() ?? 0,
                ],
            ]);
        }

        return view('admin.listing-requests.index', compact('requests'));
    }

    public function show($id)
    {
        $listingRequest = ListingRequest::findOrFail($id);
        return view('admin.listing-requests.show', compact('listingRequest'));
    }

    public function update(Request $request, $id)
    {
        $listingRequest = ListingRequest::findOrFail($id);

        $request->validate([
            'status'      => 'required|in:pending,approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $listingRequest->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.listing-requests.show', $id)
            ->with('success', 'Listing request updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $listingRequest = ListingRequest::findOrFail($id);
        $listingRequest->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Request deleted successfully.']);
        }

        return redirect()->route('admin.listing-requests.index')
            ->with('success', 'Listing request deleted successfully.');
    }
}
