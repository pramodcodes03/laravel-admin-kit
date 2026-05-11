<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::with('admin')
            ->when($request->search, fn($q, $s) => $q->where('title', 'like', "%{$s}%")
                ->orWhere('excerpt', 'like', "%{$s}%"))
            ->when($request->status, fn($q, $s) => $q->where('status', $s))
            ->latest()
            ->paginate(15);

        if ($request->ajax()) {
            $items = $posts->map(fn($p) => array_merge($p->toArray(), ['admin' => $p->admin]));
            return response()->json([
                'data'       => $items,
                'pagination' => [
                    'total'        => $posts->total(),
                    'per_page'     => $posts->perPage(),
                    'current_page' => $posts->currentPage(),
                    'last_page'    => $posts->lastPage(),
                    'from'         => $posts->firstItem() ?? 0,
                    'to'           => $posts->lastItem() ?? 0,
                ],
            ]);
        }

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'excerpt'     => 'nullable|string',
            'content'     => 'required|string',
            'cover_image' => 'nullable|image|max:3072',
            'read_time'   => 'nullable|integer|min:1',
            'tags'        => 'nullable|string',
            'status'      => 'required|in:draft,published',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'read_time', 'status']);
        $data['admin_id']    = Auth::guard('admin')->id();
        $data['slug']        = Str::slug($request->title) . '-' . Str::random(5);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['tags']        = $request->filled('tags')
            ? array_values(array_filter(array_map('trim', explode(',', $request->tags))))
            : [];

        if ($request->status === 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = StorageHelper::upload($request->file('cover_image'), 'blog/covers');
        }

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'excerpt'     => 'nullable|string',
            'content'     => 'required|string',
            'cover_image' => 'nullable|image|max:3072',
            'read_time'   => 'nullable|integer|min:1',
            'tags'        => 'nullable|string',
            'status'      => 'required|in:draft,published',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'read_time', 'status']);
        $data['slug']        = Str::slug($request->title) . '-' . Str::random(5);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['tags']        = $request->filled('tags')
            ? array_values(array_filter(array_map('trim', explode(',', $request->tags))))
            : [];

        if ($request->status === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) StorageHelper::delete($post->cover_image);
            $data['cover_image'] = StorageHelper::upload($request->file('cover_image'), 'blog/covers');
        }

        $post->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        if ($post->cover_image) StorageHelper::delete($post->cover_image);
        $post->delete();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Blog post deleted successfully.']);
        }

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    public function toggleStatus(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $newStatus = $post->status === 'published' ? 'draft' : 'published';
        $data = ['status' => $newStatus];
        if ($newStatus === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }
        $post->update($data);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status updated.', 'status' => $post->status]);
        }

        return redirect()->back()->with('success', 'Blog post status updated.');
    }
}
