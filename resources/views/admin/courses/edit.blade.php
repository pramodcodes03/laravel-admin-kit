<x-layout.admin title="Edit Course">
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Edit Course: {{ $course->title }}</h5>
            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-primary">
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

            <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Course Info</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="institute_id">Institute <span class="text-danger">*</span></label>
                        <select id="institute_id" name="institute_id" class="form-select" required>
                            <option value="">-- Select Institute --</option>
                            @foreach($institutes as $inst)
                                <option value="{{ $inst->id }}" {{ old('institute_id', $course->institute_id) == $inst->id ? 'selected' : '' }}>{{ $inst->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="title">Course Title <span class="text-danger">*</span></label>
                        <input id="title" name="title" type="text" class="form-input" value="{{ old('title', $course->title) }}" required />
                    </div>
                    <div class="md:col-span-2">
                        <label for="short_description">Short Description</label>
                        <textarea id="short_description" name="short_description" class="form-textarea" rows="2">{{ old('short_description', $course->short_description) }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label for="long_description">Full Description</label>
                        <textarea id="long_description" name="long_description" class="form-textarea" rows="6">{{ old('long_description', $course->long_description) }}</textarea>
                    </div>
                    <div>
                        <label for="thumbnail">Thumbnail</label>
                        @if($course->thumbnail)
                            <div class="mb-2">
                                <img src="{{ \App\Helpers\StorageHelper::url($course->thumbnail) }}" alt="Thumbnail" class="h-16 w-auto object-cover rounded border border-gray-200" />
                                <p class="text-xs text-gray-400 mt-1">Current thumbnail</p>
                            </div>
                        @endif
                        <input id="thumbnail" name="thumbnail" type="file" class="form-input" accept="image/*" />
                        <p class="text-xs text-gray-400 mt-1">Upload new to replace. Max 2MB.</p>
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Schedule & Format</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 mb-6">
                    <div>
                        <label for="duration_weeks">Duration (weeks)</label>
                        <input id="duration_weeks" name="duration_weeks" type="number" class="form-input" value="{{ old('duration_weeks', $course->duration_weeks) }}" min="0" />
                    </div>
                    <div>
                        <label for="hours_per_week">Hours per Week</label>
                        <input id="hours_per_week" name="hours_per_week" type="number" class="form-input" value="{{ old('hours_per_week', $course->hours_per_week) }}" min="0" />
                    </div>
                    <div>
                        <label for="level">Level <span class="text-danger">*</span></label>
                        <select id="level" name="level" class="form-select" required>
                            @foreach(['Beginner','Intermediate','Advanced','All Levels'] as $lvl)
                                <option value="{{ $lvl }}" {{ old('level', $course->level) === $lvl ? 'selected' : '' }}>{{ $lvl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2">Delivery Mode</label>
                        <div class="flex flex-wrap gap-4">
                            @foreach(['Offline','Online','Hybrid'] as $mode)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="mode[]" value="{{ $mode }}" class="form-checkbox"
                                        {{ in_array($mode, old('mode', $course->mode ?? [])) ? 'checked' : '' }} />
                                    <span>{{ $mode }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Pricing</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 mb-6">
                    <div>
                        <label for="price_inr">Price (INR) <span class="text-danger">*</span></label>
                        <input id="price_inr" name="price_inr" type="number" class="form-input" value="{{ old('price_inr', $course->price_inr) }}" min="0" required />
                    </div>
                    <div>
                        <label for="original_price_inr">Original Price (INR)</label>
                        <input id="original_price_inr" name="original_price_inr" type="number" class="form-input" value="{{ old('original_price_inr', $course->original_price_inr) }}" min="0" />
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Features</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 mb-6">
                    <div class="flex items-center gap-3">
                        <label class="relative inline-flex cursor-pointer">
                            <input type="checkbox" name="emi_available" value="1" class="sr-only peer"
                                {{ old('emi_available', $course->emi_available) ? 'checked' : '' }} />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                        <span class="font-medium">EMI Available</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="relative inline-flex cursor-pointer">
                            <input type="checkbox" name="certificate" value="1" class="sr-only peer"
                                {{ old('certificate', $course->certificate) ? 'checked' : '' }} />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                        <span class="font-medium">Certificate Provided</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="relative inline-flex cursor-pointer">
                            <input type="checkbox" name="placement_support" value="1" class="sr-only peer"
                                {{ old('placement_support', $course->placement_support) ? 'checked' : '' }} />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                        </label>
                        <span class="font-medium">Placement Support</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-select">
                            <option value="active" {{ old('status', $course->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $course->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Course</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
