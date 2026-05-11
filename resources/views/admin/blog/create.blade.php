<x-layout.admin title="New Blog Post">
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">New Blog Post</h5>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back
            </a>
        </div>

        <div class="panel">
            @if ($errors->any())
                <div class="p-4 mb-5 border-l-4 border-danger rounded bg-danger-light dark:bg-danger dark:bg-opacity-20">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm text-danger">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                    <div class="md:col-span-2 space-y-5">
                        <div>
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input id="title" name="title" type="text" class="form-input" value="{{ old('title') }}" required />
                        </div>
                        <div>
                            <label for="excerpt">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" class="form-textarea" rows="3" placeholder="Short summary shown in listings...">{{ old('excerpt') }}</textarea>
                        </div>
                        <div>
                            <label for="content">Content <span class="text-danger">*</span></label>
                            <textarea id="content" name="content" class="form-textarea" rows="16" required>{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="draft" {{ old('status','draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        <div>
                            <label for="cover_image">Cover Image</label>
                            <input id="cover_image" name="cover_image" type="file" class="form-input" accept="image/*" />
                            <p class="text-xs text-gray-400 mt-1">Max 3MB. Recommended 1200x630px</p>
                        </div>
                        <div>
                            <label for="read_time">Read Time (minutes)</label>
                            <input id="read_time" name="read_time" type="number" class="form-input" value="{{ old('read_time', 3) }}" min="1" />
                        </div>
                        <div>
                            <label for="tags">Tags</label>
                            <input id="tags" name="tags" type="text" class="form-input" value="{{ old('tags') }}" placeholder="career, tips, courses" />
                            <p class="text-xs text-gray-400 mt-1">Comma-separated</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <label class="relative inline-flex cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }} />
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-warning"></div>
                            </label>
                            <span class="font-medium">Featured Post</span>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary w-full">Publish Post</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
