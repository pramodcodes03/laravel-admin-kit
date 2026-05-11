<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InstituteCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InstituteCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = InstituteCategory::withCount('institutes')
            ->when($request->search, fn($q, $s) => $q->where('name', 'like', "%{$s}%")
                ->orWhere('slug', 'like', "%{$s}%"))
            ->orderBy('sort_order')
            ->paginate(15);

        if ($request->ajax()) {
            return response()->json([
                'data'       => $categories->items(),
                'pagination' => [
                    'total'        => $categories->total(),
                    'per_page'     => $categories->perPage(),
                    'current_page' => $categories->currentPage(),
                    'last_page'    => $categories->lastPage(),
                    'from'         => $categories->firstItem() ?? 0,
                    'to'           => $categories->lastItem() ?? 0,
                ],
            ]);
        }

        return view('admin.institute-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.institute-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'color'       => 'nullable|string|max:50',
            'text_color'  => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        InstituteCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'icon'        => $request->icon,
            'color'       => $request->color,
            'text_color'  => $request->text_color,
            'sort_order'  => $request->sort_order ?? 0,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.institute-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = InstituteCategory::findOrFail($id);
        return view('admin.institute-categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = InstituteCategory::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon'        => 'nullable|string|max:255',
            'color'       => 'nullable|string|max:50',
            'text_color'  => 'nullable|string|max:50',
            'sort_order'  => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'icon'        => $request->icon,
            'color'       => $request->color,
            'text_color'  => $request->text_color,
            'sort_order'  => $request->sort_order ?? 0,
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.institute-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $category = InstituteCategory::withCount('institutes')->findOrFail($id);

        if ($category->institutes_count > 0) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Cannot delete: category has institutes.']);
            }
            return redirect()->back()->with('error', 'Cannot delete: this category has associated institutes.');
        }

        $category->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
        }

        return redirect()->route('admin.institute-categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $category = InstituteCategory::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
        }

        return redirect()->back()->with('success', 'Category status updated.');
    }
}
