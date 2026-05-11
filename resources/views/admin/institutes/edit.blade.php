<x-layout.admin title="Edit Institute">
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Edit Institute: {{ $institute->name }}</h5>
            <a href="{{ route('admin.institutes.index') }}" class="btn btn-outline-primary">
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

            <form action="{{ route('admin.institutes.update', $institute->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Basic Information</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="name">Institute Name <span class="text-danger">*</span></label>
                        <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $institute->name) }}" required />
                    </div>
                    <div>
                        <label for="tagline">Tagline</label>
                        <input id="tagline" name="tagline" type="text" class="form-input" value="{{ old('tagline', $institute->tagline) }}" />
                    </div>
                    <div>
                        <label for="city_id">City <span class="text-danger">*</span></label>
                        <select id="city_id" name="city_id" class="form-select" required>
                            <option value="">-- Select City --</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $institute->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $institute->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="about">About</label>
                        <textarea id="about" name="about" class="form-textarea" rows="4">{{ old('about', $institute->about) }}</textarea>
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Location</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="area">Area / Locality</label>
                        <input id="area" name="area" type="text" class="form-input" value="{{ old('area', $institute->area) }}" />
                    </div>
                    <div>
                        <label for="pincode">Pincode</label>
                        <input id="pincode" name="pincode" type="text" class="form-input" value="{{ old('pincode', $institute->pincode) }}" maxlength="10" />
                    </div>
                    <div class="md:col-span-2">
                        <label for="full_address">Full Address</label>
                        <textarea id="full_address" name="full_address" class="form-textarea" rows="2">{{ old('full_address', $institute->full_address) }}</textarea>
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Contact</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="phone">Phone</label>
                        <input id="phone" name="phone" type="text" class="form-input" value="{{ old('phone', $institute->phone) }}" />
                    </div>
                    <div>
                        <label for="whatsapp">WhatsApp</label>
                        <input id="whatsapp" name="whatsapp" type="text" class="form-input" value="{{ old('whatsapp', $institute->whatsapp) }}" />
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $institute->email) }}" />
                    </div>
                    <div>
                        <label for="website">Website</label>
                        <input id="website" name="website" type="url" class="form-input" value="{{ old('website', $institute->website) }}" placeholder="https://" />
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Media</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="logo">Logo</label>
                        @if($institute->logo)
                            <div class="mb-2">
                                <img src="{{ \App\Helpers\StorageHelper::url($institute->logo) }}" alt="Logo" class="h-16 w-auto object-contain rounded border border-gray-200" />
                                <p class="text-xs text-gray-400 mt-1">Current logo</p>
                            </div>
                        @endif
                        <input id="logo" name="logo" type="file" class="form-input" accept="image/*" />
                        <p class="text-xs text-gray-400 mt-1">Upload new to replace. Max 2MB.</p>
                    </div>
                    <div>
                        <label for="cover_image">Cover Image</label>
                        @if($institute->cover_image)
                            <div class="mb-2">
                                <img src="{{ \App\Helpers\StorageHelper::url($institute->cover_image) }}" alt="Cover" class="h-16 w-auto object-cover rounded border border-gray-200" />
                                <p class="text-xs text-gray-400 mt-1">Current cover</p>
                            </div>
                        @endif
                        <input id="cover_image" name="cover_image" type="file" class="form-input" accept="image/*" />
                        <p class="text-xs text-gray-400 mt-1">Upload new to replace. Max 4MB.</p>
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Details</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mb-6">
                    <div>
                        <label for="certifications">Certifications</label>
                        <textarea id="certifications" name="certifications" class="form-textarea" rows="4">{{ old('certifications', $institute->certifications ? implode("\n", $institute->certifications) : '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Enter one per line</p>
                    </div>
                    <div>
                        <label for="facilities">Facilities</label>
                        <textarea id="facilities" name="facilities" class="form-textarea" rows="4">{{ old('facilities', $institute->facilities ? implode("\n", $institute->facilities) : '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Enter one per line</p>
                    </div>
                </div>

                <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Settings</h6>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 mb-6">
                    <div>
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-select">
                            <option value="pending" {{ old('status', $institute->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status', $institute->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $institute->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-3 pt-6">
                        <label class="relative inline-flex cursor-pointer">
                            <input type="checkbox" name="is_verified" value="1" class="sr-only peer"
                                {{ old('is_verified', $institute->is_verified) ? 'checked' : '' }} />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-info"></div>
                        </label>
                        <span class="font-medium">Verified</span>
                    </div>
                    <div class="flex items-center gap-3 pt-6">
                        <label class="relative inline-flex cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" class="sr-only peer"
                                {{ old('is_featured', $institute->is_featured) ? 'checked' : '' }} />
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-warning"></div>
                        </label>
                        <span class="font-medium">Featured</span>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6">
                    <a href="{{ route('admin.institutes.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Institute</button>
                </div>
            </form>
        </div>
    </div>
</x-layout.admin>
