<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Institute;
use App\Models\InstituteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstituteController extends Controller
{
    public function index(Request $request)
    {
        $institutes = Institute::with(['city', 'category'])
            ->when($request->search, fn($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            }))
            ->when($request->city_id, fn($q, $c) => $q->where('city_id', $c))
            ->when($request->category_id, fn($q, $c) => $q->where('category_id', $c))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15);

        if ($request->ajax()) {
            $items = $institutes->map(function ($i) {
                return array_merge($i->toArray(), [
                    'city'     => $i->city,
                    'category' => $i->category,
                ]);
            });
            return response()->json([
                'data'       => $items,
                'pagination' => [
                    'total'        => $institutes->total(),
                    'per_page'     => $institutes->perPage(),
                    'current_page' => $institutes->currentPage(),
                    'last_page'    => $institutes->lastPage(),
                    'from'         => $institutes->firstItem() ?? 0,
                    'to'           => $institutes->lastItem() ?? 0,
                ],
            ]);
        }

        $cities     = City::where('is_active', true)->orderBy('name')->get();
        $categories = InstituteCategory::where('is_active', true)->orderBy('name')->get();

        return view('admin.institutes.index', compact('institutes', 'cities', 'categories'));
    }

    public function create()
    {
        $cities     = City::where('is_active', true)->orderBy('name')->get();
        $categories = InstituteCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.institutes.create', compact('cities', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'city_id'     => 'required|exists:cities,id',
            'category_id' => 'required|exists:institute_categories,id',
            'tagline'     => 'nullable|string|max:255',
            'about'       => 'nullable|string',
            'area'        => 'nullable|string|max:255',
            'pincode'     => 'nullable|string|max:10',
            'full_address'=> 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'whatsapp'    => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'website'     => 'nullable|url|max:255',
            'status'      => 'required|in:active,inactive,pending',
            'logo'        => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        $data = $request->only([
            'name', 'city_id', 'category_id', 'tagline', 'about',
            'area', 'pincode', 'full_address', 'phone', 'whatsapp',
            'email', 'website', 'status',
        ]);

        $data['slug']       = Str::slug($request->name) . '-' . Str::random(5);
        $data['is_verified'] = $request->boolean('is_verified');
        $data['is_featured'] = $request->boolean('is_featured');

        // Process certifications (one per line textarea)
        if ($request->filled('certifications')) {
            $data['certifications'] = array_filter(array_map('trim', explode("\n", $request->certifications)));
        }
        if ($request->filled('facilities')) {
            $data['facilities'] = array_filter(array_map('trim', explode("\n", $request->facilities)));
        }

        if ($request->hasFile('logo')) {
            $data['logo'] = StorageHelper::upload($request->file('logo'), 'institutes/logos');
        }
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = StorageHelper::upload($request->file('cover_image'), 'institutes/covers');
        }

        Institute::create($data);

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute created successfully.');
    }

    public function edit($id)
    {
        $institute  = Institute::with(['city', 'category'])->findOrFail($id);
        $cities     = City::where('is_active', true)->orderBy('name')->get();
        $categories = InstituteCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.institutes.edit', compact('institute', 'cities', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'city_id'     => 'required|exists:cities,id',
            'category_id' => 'required|exists:institute_categories,id',
            'tagline'     => 'nullable|string|max:255',
            'about'       => 'nullable|string',
            'area'        => 'nullable|string|max:255',
            'pincode'     => 'nullable|string|max:10',
            'full_address'=> 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'whatsapp'    => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'website'     => 'nullable|url|max:255',
            'status'      => 'required|in:active,inactive,pending',
            'logo'        => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        $data = $request->only([
            'name', 'city_id', 'category_id', 'tagline', 'about',
            'area', 'pincode', 'full_address', 'phone', 'whatsapp',
            'email', 'website', 'status',
        ]);

        $data['is_verified'] = $request->boolean('is_verified');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->filled('certifications')) {
            $data['certifications'] = array_values(array_filter(array_map('trim', explode("\n", $request->certifications))));
        } else {
            $data['certifications'] = [];
        }
        if ($request->filled('facilities')) {
            $data['facilities'] = array_values(array_filter(array_map('trim', explode("\n", $request->facilities))));
        } else {
            $data['facilities'] = [];
        }

        if ($request->hasFile('logo')) {
            if ($institute->logo) StorageHelper::delete($institute->logo);
            $data['logo'] = StorageHelper::upload($request->file('logo'), 'institutes/logos');
        }
        if ($request->hasFile('cover_image')) {
            if ($institute->cover_image) StorageHelper::delete($institute->cover_image);
            $data['cover_image'] = StorageHelper::upload($request->file('cover_image'), 'institutes/covers');
        }

        $institute->update($data);

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);
        $institute->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Institute deleted successfully.']);
        }

        return redirect()->route('admin.institutes.index')
            ->with('success', 'Institute deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);
        $next = ['active' => 'inactive', 'inactive' => 'pending', 'pending' => 'active'];
        $institute->update(['status' => $next[$institute->status] ?? 'active']);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status updated.', 'status' => $institute->status]);
        }

        return redirect()->back()->with('success', 'Institute status updated.');
    }

    public function toggleFeatured(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);
        $institute->update(['is_featured' => !$institute->is_featured]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Featured status updated.', 'is_featured' => $institute->is_featured]);
        }

        return redirect()->back()->with('success', 'Institute featured status updated.');
    }

    public function toggleVerified(Request $request, $id)
    {
        $institute = Institute::findOrFail($id);
        $institute->update(['is_verified' => !$institute->is_verified]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Verified status updated.', 'is_verified' => $institute->is_verified]);
        }

        return redirect()->back()->with('success', 'Institute verified status updated.');
    }
}
