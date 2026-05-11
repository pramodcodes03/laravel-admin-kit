<x-layout.admin title="Edit Institute Category">
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Edit Category: {{ $category->name }}</h5>
            <a href="{{ route('admin.institute-categories.index') }}" class="btn btn-outline-primary">
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

            <form action="{{ route('admin.institute-categories.update', $category->id) }}" method="POST"
                x-data="{ slug: '{{ old('name', $category->slug) }}' }">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input id="name" name="name" type="text" class="form-input"
                            value="{{ old('name', $category->name) }}"
                            @input="slug = $event.target.value.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-+|-+$/g,'')"
                            required />
                    </div>
                    <div>
                        <label for="slug">Slug</label>
                        <input id="slug" type="text" class="form-input bg-gray-100 dark:bg-gray-800"
                            :value="slug" readonly />
                        <p class="text-xs text-gray-400 mt-1">Auto-generated from name</p>
                    </div>
                    <div class="md:col-span-2">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-textarea" rows="3">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div>
                        <label for="icon">Icon Class / Name</label>
                        <input id="icon" name="icon" type="text" class="form-input"
                            value="{{ old('icon', $category->icon) }}" placeholder="e.g. computer, school, fitness" />
                    </div>
                    <div>
                        <label for="sort_order">Sort Order</label>
                        <input id="sort_order" name="sort_order" type="number" class="form-input"
                            value="{{ old('sort_order', $category->sort_order) }}" min="0" />
                    </div>
                    <div>
                        <label for="color">Background Color</label>
                        <div class="flex gap-2">
                            <input id="color" name="color" type="color" class="form-input w-12 h-10 p-1 cursor-pointer"
                                value="{{ old('color', $category->color ?? '#3B82F6') }}" />
                            <input type="text" class="form-input flex-1"
                                value="{{ old('color', $category->color ?? '#3B82F6') }}"
                                @input="document.getElementById('color').value = $event.target.value" />
                        </div>
                    </div>
                    <div>
                        <label for="text_color">Text Color</label>
                        <div class="flex gap-2">
                            <input id="text_color" name="text_color" type="color" class="form-input w-12 h-10 p-1 cursor-pointer"
                                value="{{ old('text_color', $category->text_color ?? '#ffffff') }}" />
                            <input type="text" class="form-input flex-1"
                                value="{{ old('text_color', $category->text_color ?? '#ffffff') }}"
                                @input="document.getElementById('text_color').value = $event.target.value" />
                        </div>
                    </div>
                    <div class="flex items-center gap-3 pt-6">
                        <label class="relative inline-flex cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $category->is_active) ? 'checked' : '' }} />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                        <span class="font-medium">Active</span>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('admin.institute-categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
