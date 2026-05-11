<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::with('institute')
            ->when($request->search, fn($q, $s) => $q->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('slug', 'like', "%{$s}%");
            }))
            ->when($request->institute_id, fn($q, $i) => $q->where('institute_id', $i))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15);

        if ($request->ajax()) {
            $items = $courses->map(fn($c) => array_merge($c->toArray(), ['institute' => $c->institute]));
            return response()->json([
                'data'       => $items,
                'pagination' => [
                    'total'        => $courses->total(),
                    'per_page'     => $courses->perPage(),
                    'current_page' => $courses->currentPage(),
                    'last_page'    => $courses->lastPage(),
                    'from'         => $courses->firstItem() ?? 0,
                    'to'           => $courses->lastItem() ?? 0,
                ],
            ]);
        }

        $institutes = Institute::where('status', 'active')->orderBy('name')->get();
        return view('admin.courses.index', compact('courses', 'institutes'));
    }

    public function create()
    {
        $institutes = Institute::where('status', 'active')->orderBy('name')->get();
        return view('admin.courses.create', compact('institutes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'institute_id'      => 'required|exists:institutes,id',
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'long_description'  => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:2048',
            'duration_weeks'    => 'nullable|integer|min:0',
            'hours_per_week'    => 'nullable|integer|min:0',
            'mode'              => 'nullable|array',
            'level'             => 'required|in:Beginner,Intermediate,Advanced,All Levels',
            'price_inr'         => 'required|integer|min:0',
            'original_price_inr'=> 'nullable|integer|min:0',
            'status'            => 'required|in:active,inactive',
        ]);

        $data = $request->only([
            'institute_id', 'title', 'short_description', 'long_description',
            'duration_weeks', 'hours_per_week', 'level', 'price_inr',
            'original_price_inr', 'status',
        ]);

        $data['slug']              = Str::slug($request->title) . '-' . Str::random(5);
        $data['mode']              = $request->input('mode', []);
        $data['emi_available']     = $request->boolean('emi_available');
        $data['certificate']       = $request->boolean('certificate', true);
        $data['placement_support'] = $request->boolean('placement_support');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = StorageHelper::upload($request->file('thumbnail'), 'courses/thumbnails');
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        $course     = Course::with('institute')->findOrFail($id);
        $institutes = Institute::where('status', 'active')->orderBy('name')->get();
        return view('admin.courses.edit', compact('course', 'institutes'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'institute_id'      => 'required|exists:institutes,id',
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'long_description'  => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:2048',
            'duration_weeks'    => 'nullable|integer|min:0',
            'hours_per_week'    => 'nullable|integer|min:0',
            'mode'              => 'nullable|array',
            'level'             => 'required|in:Beginner,Intermediate,Advanced,All Levels',
            'price_inr'         => 'required|integer|min:0',
            'original_price_inr'=> 'nullable|integer|min:0',
            'status'            => 'required|in:active,inactive',
        ]);

        $data = $request->only([
            'institute_id', 'title', 'short_description', 'long_description',
            'duration_weeks', 'hours_per_week', 'level', 'price_inr',
            'original_price_inr', 'status',
        ]);

        $data['mode']              = $request->input('mode', []);
        $data['emi_available']     = $request->boolean('emi_available');
        $data['certificate']       = $request->boolean('certificate', true);
        $data['placement_support'] = $request->boolean('placement_support');

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) StorageHelper::delete($course->thumbnail);
            $data['thumbnail'] = StorageHelper::upload($request->file('thumbnail'), 'courses/thumbnails');
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        if ($course->thumbnail) StorageHelper::delete($course->thumbnail);
        $course->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Course deleted successfully.']);
        }

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->update(['status' => $course->status === 'active' ? 'inactive' : 'active']);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status updated.', 'status' => $course->status]);
        }

        return redirect()->back()->with('success', 'Course status updated.');
    }
}
