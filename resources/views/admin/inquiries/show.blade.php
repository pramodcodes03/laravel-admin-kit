<x-layout.admin title="Inquiry Details">
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Inquiry #{{ $inquiry->id }}</h5>
            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Inquiries
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success flex items-center p-3.5 rounded-lg mb-4">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Inquiry Details -->
            <div class="lg:col-span-2">
                <div class="panel">
                    <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Contact Information</h6>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Name</p>
                            <p class="font-medium mt-1">{{ $inquiry->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Phone</p>
                            <p class="font-medium mt-1">
                                <a href="tel:{{ $inquiry->phone }}" class="text-primary hover:underline">{{ $inquiry->phone }}</a>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Email</p>
                            <p class="font-medium mt-1">{{ $inquiry->email ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">City</p>
                            <p class="font-medium mt-1">{{ $inquiry->city ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Source</p>
                            <p class="mt-1"><span class="badge bg-info-light text-info">{{ $inquiry->source }}</span></p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Received</p>
                            <p class="font-medium mt-1">{{ $inquiry->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>

                    @if($inquiry->message)
                        <div class="mt-4 pt-4 border-t dark:border-gray-700">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Message</p>
                            <p class="text-sm bg-gray-50 dark:bg-gray-800 rounded p-3">{{ $inquiry->message }}</p>
                        </div>
                    @endif

                    @if($inquiry->institute || $inquiry->course)
                        <div class="mt-4 pt-4 border-t dark:border-gray-700">
                            <h6 class="text-base font-semibold mb-3">Inquiry About</h6>
                            <div class="grid grid-cols-2 gap-4">
                                @if($inquiry->institute)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Institute</p>
                                        <p class="font-medium mt-1">{{ $inquiry->institute->name }}</p>
                                    </div>
                                @endif
                                @if($inquiry->course)
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Course</p>
                                        <p class="font-medium mt-1">{{ $inquiry->course->title }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status Update -->
            <div>
                <div class="panel">
                    <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Update Status</h6>

                    <div class="mb-4">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Current Status</p>
                        @php
                            $statusColors = ['new' => 'bg-danger', 'contacted' => 'bg-warning', 'converted' => 'bg-success', 'closed' => 'bg-gray-400'];
                        @endphp
                        <span class="badge {{ $statusColors[$inquiry->status] ?? 'bg-gray-400' }}">{{ ucfirst($inquiry->status) }}</span>
                    </div>

                    @if($inquiry->contacted_at)
                        <div class="mb-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Contacted At</p>
                            <p class="text-sm">{{ $inquiry->contacted_at->format('d M Y, h:i A') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.inquiries.update', $inquiry->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-select">
                                @foreach(['new','contacted','converted','closed'] as $s)
                                    <option value="{{ $s }}" {{ $inquiry->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="admin_notes">Admin Notes</label>
                            <textarea id="admin_notes" name="admin_notes" class="form-textarea" rows="4" placeholder="Add notes about this inquiry...">{{ $inquiry->admin_notes }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-full">Update Inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
