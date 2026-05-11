<x-layout.admin title="Dashboard">
    @php
        use App\Models\User;
        use App\Models\City;
        use App\Models\Admin;
        use App\Models\Institute;
        use App\Models\Course;
        use App\Models\Inquiry;
        use App\Models\ListingRequest;
        use App\Models\BlogPost;

        $totalInstitutes   = Institute::count();
        $totalCourses      = Course::count();
        $newInquiries      = Inquiry::where('status', 'new')->count();
        $pendingRequests   = ListingRequest::where('status', 'pending')->count();
        $totalUsers        = User::count();
        $totalCities       = City::count();
        $totalBlogPosts    = BlogPost::count();
        $recentInquiries   = Inquiry::with(['institute'])->latest()->take(5)->get();
        $recentRequests    = ListingRequest::latest()->take(5)->get();
    @endphp

    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Dashboard</h5>
            <p class="text-sm text-gray-400">Welcome, {{ Auth::guard('admin')->user()->name }}</p>
        </div>

        <!-- Stats Row 1 -->
        <div class="grid grid-cols-2 gap-4 mb-4 sm:grid-cols-4">
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-primary">{{ $totalInstitutes }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Institutes</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-primary-light dark:bg-primary dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="none"><path opacity="0.5" d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z" fill="currentColor"/><path d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z" fill="currentColor"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.institutes.index') }}" class="text-xs text-primary mt-2 block hover:underline">View all &rarr;</a>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-success">{{ $totalCourses }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Courses</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-success-light dark:bg-success dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-success" viewBox="0 0 24 24" fill="none"><path d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><path d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.courses.index') }}" class="text-xs text-success mt-2 block hover:underline">View all &rarr;</a>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-danger">{{ $newInquiries }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">New Inquiries</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-danger-light dark:bg-danger dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-danger" viewBox="0 0 24 24" fill="none"><path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" stroke="currentColor" stroke-width="1.5"/><path d="M12 7V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/><circle cx="12" cy="16" r="1" fill="currentColor"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.inquiries.index') }}?status=new" class="text-xs text-danger mt-2 block hover:underline">View new &rarr;</a>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-warning">{{ $pendingRequests }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Pending Listings</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-warning-light dark:bg-warning dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-warning" viewBox="0 0 24 24" fill="none"><path d="M3 12.3371C3 13.9677 3.03811 15.4836 3.10985 16.854C3.19387 18.462 3.23588 19.266 3.94272 19.9728C4.64956 20.6797 5.48222 20.7217 7.14753 20.8057C8.6414 20.8818 10.2634 20.9232 12 20.9232C13.7366 20.9232 15.3586 20.8818 16.8525 20.8057C18.5178 20.7217 19.3504 20.6797 20.0573 19.9728C20.7641 19.266 20.8061 18.462 20.8902 16.854C20.9619 15.4836 21 13.9677 21 12.3371C21 10.7065 20.9619 9.19062 20.8902 7.82024C20.8061 6.21224 20.7641 5.40824 20.0573 4.7014C19.3504 3.99456 18.5178 3.95256 16.8525 3.86853C15.3586 3.79242 13.7366 3.75101 12 3.75101C10.2634 3.75101 8.6414 3.79242 7.14753 3.86853C5.48222 3.95256 4.64956 3.99456 3.94272 4.7014C3.23588 5.40824 3.19387 6.21224 3.10985 7.82024C3.03811 9.19062 3 10.7065 3 12.3371Z" stroke="currentColor" stroke-width="1.5" opacity="0.5"/><path d="M8 12H12M12 12H16M12 12V8M12 12V16" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                </div>
                <a href="{{ route('admin.listing-requests.index') }}?status=pending" class="text-xs text-warning mt-2 block hover:underline">Review &rarr;</a>
            </div>
        </div>

        <!-- Stats Row 2 -->
        <div class="grid grid-cols-2 gap-4 mb-6 sm:grid-cols-3">
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-primary">{{ $totalUsers }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Total Users</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-primary-light dark:bg-primary dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"/><path opacity="0.5" d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z" stroke="currentColor" stroke-width="1.5"/></svg>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-info">{{ $totalCities }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cities</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-info-light dark:bg-info dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-info" viewBox="0 0 24 24" fill="none"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="currentColor" stroke-width="1.5" fill="none"/><circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.5" opacity="0.5"/></svg>
                    </div>
                </div>
            </div>

            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-2xl font-bold text-secondary">{{ $totalBlogPosts }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Blog Posts</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-secondary-light dark:bg-secondary dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-secondary" viewBox="0 0 24 24" fill="none"><path d="M4 4H20V16H4V4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.5"/><path d="M8 20H16M12 16V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Tables -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Recent Inquiries -->
            <div class="panel">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="font-semibold">Recent Inquiries</h6>
                    <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-primary hover:underline">View all</a>
                </div>
                @if($recentInquiries->isEmpty())
                    <p class="text-sm text-gray-400">No inquiries yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table-hover text-sm">
                            <thead>
                                <tr>
                                    <th class="px-3 py-2">Name</th>
                                    <th class="px-3 py-2">Phone</th>
                                    <th class="px-3 py-2">Institute</th>
                                    <th class="px-3 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentInquiries as $inq)
                                    <tr>
                                        <td class="px-3 py-2">
                                            <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="hover:text-primary">{{ $inq->name }}</a>
                                        </td>
                                        <td class="px-3 py-2">{{ $inq->phone }}</td>
                                        <td class="px-3 py-2 text-gray-500">{{ $inq->institute?->name ?? '-' }}</td>
                                        <td class="px-3 py-2">
                                            @php $c = ['new'=>'bg-danger','contacted'=>'bg-warning','converted'=>'bg-success','closed'=>'bg-gray-400']; @endphp
                                            <span class="badge text-xs {{ $c[$inq->status] ?? 'bg-gray-400' }}">{{ $inq->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Recent Listing Requests -->
            <div class="panel">
                <div class="flex items-center justify-between mb-4">
                    <h6 class="font-semibold">Recent Listing Requests</h6>
                    <a href="{{ route('admin.listing-requests.index') }}" class="text-xs text-primary hover:underline">View all</a>
                </div>
                @if($recentRequests->isEmpty())
                    <p class="text-sm text-gray-400">No listing requests yet.</p>
                @else
                    <div class="table-responsive">
                        <table class="table-hover text-sm">
                            <thead>
                                <tr>
                                    <th class="px-3 py-2">Institute</th>
                                    <th class="px-3 py-2">Owner</th>
                                    <th class="px-3 py-2">City</th>
                                    <th class="px-3 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentRequests as $req)
                                    <tr>
                                        <td class="px-3 py-2">
                                            <a href="{{ route('admin.listing-requests.show', $req->id) }}" class="hover:text-primary">{{ $req->institute_name }}</a>
                                        </td>
                                        <td class="px-3 py-2">{{ $req->owner_name }}</td>
                                        <td class="px-3 py-2 text-gray-500">{{ $req->city }}</td>
                                        <td class="px-3 py-2">
                                            @php $c = ['pending'=>'bg-warning','approved'=>'bg-success','rejected'=>'bg-danger']; @endphp
                                            <span class="badge text-xs {{ $c[$req->status] ?? 'bg-gray-400' }}">{{ $req->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout.admin>
