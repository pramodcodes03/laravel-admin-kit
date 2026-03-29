<x-layout.admin>
    <div>
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">Dashboard</h5>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Users -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-bold text-primary">{{ \App\Models\User::count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Users</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-primary-light dark:bg-primary dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"/>
                            <path opacity="0.5" d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z" stroke="currentColor" stroke-width="1.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Cities -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-bold text-success">{{ \App\Models\City::count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total Cities</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-success-light dark:bg-success dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-success" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                            <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.5" opacity="0.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-bold text-info">{{ \App\Models\User::where('status', 'active')->count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Active Users</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-info-light dark:bg-info dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-info" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12l2 2 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" opacity="0.5"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Admins -->
            <div class="panel">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-lg font-bold text-danger">{{ \App\Models\Admin::count() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Admins</div>
                    </div>
                    <div class="flex items-center justify-center w-11 h-11 rounded-lg bg-danger-light dark:bg-danger dark:bg-opacity-20">
                        <svg class="w-5 h-5 text-danger" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Welcome Card -->
        <div class="panel">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white">
                        Welcome, {{ Auth::guard('admin')->user()->name }}!
                    </h3>
                    <p class="mt-1 text-gray-500 dark:text-gray-400">
                        This is your admin dashboard. Use the sidebar to navigate.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout.admin>
