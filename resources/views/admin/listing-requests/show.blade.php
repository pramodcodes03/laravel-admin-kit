<x-layout.admin title="Listing Request Details">
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Listing Request #{{ $listingRequest->id }}</h5>
            <a href="{{ route('admin.listing-requests.index') }}" class="btn btn-outline-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                Back to Requests
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success flex items-center p-3.5 rounded-lg mb-4">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Request Details -->
            <div class="lg:col-span-2">
                <div class="panel">
                    <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Institute Information</h6>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Institute Name</p>
                            <p class="font-semibold text-lg mt-1">{{ $listingRequest->institute_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Owner Name</p>
                            <p class="font-medium mt-1">{{ $listingRequest->owner_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Mobile</p>
                            <p class="font-medium mt-1">
                                <a href="tel:{{ $listingRequest->mobile }}" class="text-primary hover:underline">{{ $listingRequest->mobile }}</a>
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Email</p>
                            <p class="font-medium mt-1">{{ $listingRequest->email ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">City</p>
                            <p class="font-medium mt-1">{{ $listingRequest->city }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Pincode</p>
                            <p class="font-medium mt-1">{{ $listingRequest->pincode ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Category</p>
                            <p class="font-medium mt-1">{{ $listingRequest->category ?: '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider">Submitted</p>
                            <p class="font-medium mt-1">{{ $listingRequest->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                    </div>

                    @if($listingRequest->message)
                        <div class="mt-4 pt-4 border-t dark:border-gray-700">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Message</p>
                            <p class="text-sm bg-gray-50 dark:bg-gray-800 rounded p-3">{{ $listingRequest->message }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status Update -->
            <div>
                <div class="panel">
                    <h6 class="text-base font-semibold mb-4 pb-2 border-b dark:border-gray-700">Review Request</h6>

                    <div class="mb-4">
                        <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Current Status</p>
                        @php
                            $statusColors = ['pending' => 'bg-warning', 'approved' => 'bg-success', 'rejected' => 'bg-danger'];
                        @endphp
                        <span class="badge {{ $statusColors[$listingRequest->status] ?? 'bg-gray-400' }}">{{ ucfirst($listingRequest->status) }}</span>
                    </div>

                    @if($listingRequest->admin_notes)
                        <div class="mb-4 p-3 bg-gray-50 dark:bg-gray-800 rounded">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Previous Notes</p>
                            <p class="text-sm">{{ $listingRequest->admin_notes }}</p>
                        </div>
                    @endif

                    <form action="{{ route('admin.listing-requests.update', $listingRequest->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status">Decision</label>
                            <select id="status" name="status" class="form-select">
                                <option value="pending" {{ $listingRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $listingRequest->status === 'approved' ? 'selected' : '' }}>Approve</option>
                                <option value="rejected" {{ $listingRequest->status === 'rejected' ? 'selected' : '' }}>Reject</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="admin_notes">Admin Notes</label>
                            <textarea id="admin_notes" name="admin_notes" class="form-textarea" rows="5" placeholder="Reason for approval/rejection, follow-up notes...">{{ $listingRequest->admin_notes }}</textarea>
                        </div>
                        <div class="flex flex-col gap-2">
                            <button type="submit" name="status" value="approved" class="btn btn-success w-full">
                                Approve Request
                            </button>
                            <button type="submit" name="status" value="rejected" class="btn btn-danger w-full">
                                Reject Request
                            </button>
                            <button type="submit" class="btn btn-outline-secondary w-full">
                                Save Notes Only
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
