<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Institute;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $inquiries = Inquiry::with(['institute', 'course'])
            ->when($request->search, fn($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
            }))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->when($request->institute_id, fn($q, $i) => $q->where('institute_id', $i))
            ->latest()
            ->paginate(20);

        if ($request->ajax()) {
            $items = $inquiries->map(fn($i) => array_merge($i->toArray(), [
                'institute' => $i->institute,
                'course'    => $i->course,
            ]));
            return response()->json([
                'data'       => $items,
                'pagination' => [
                    'total'        => $inquiries->total(),
                    'per_page'     => $inquiries->perPage(),
                    'current_page' => $inquiries->currentPage(),
                    'last_page'    => $inquiries->lastPage(),
                    'from'         => $inquiries->firstItem() ?? 0,
                    'to'           => $inquiries->lastItem() ?? 0,
                ],
            ]);
        }

        $institutes = Institute::orderBy('name')->get();
        return view('admin.inquiries.index', compact('inquiries', 'institutes'));
    }

    public function show($id)
    {
        $inquiry = Inquiry::with(['institute', 'course'])->findOrFail($id);
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);

        $request->validate([
            'status'      => 'required|in:new,contacted,converted,closed',
            'admin_notes' => 'nullable|string',
        ]);

        $data = [
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ];

        if ($request->status === 'contacted' && !$inquiry->contacted_at) {
            $data['contacted_at'] = now();
        }

        $inquiry->update($data);

        return redirect()->route('admin.inquiries.show', $id)
            ->with('success', 'Inquiry updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Inquiry deleted successfully.']);
        }

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }
}
