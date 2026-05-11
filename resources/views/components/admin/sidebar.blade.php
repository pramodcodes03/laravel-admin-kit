<div :class="{ 'dark text-white-dark': $store.app.semidark }">
    <nav x-data="sidebar"
        class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
        <div class="bg-white dark:bg-[#0e1726] h-full">
            <div class="flex items-center justify-between px-4 py-3">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center main-logo shrink-0">
                    <img x-show="$store.app.theme !== 'dark'" x-transition.opacity
                        class="flex-none object-contain w-auto h-16" src="/assets/images/logo.png" alt="Logo" />
                    <img x-show="$store.app.theme === 'dark'" x-transition.opacity
                        class="flex-none object-contain w-auto h-16" src="/assets/images/logo-dark.png" alt="Logo" />
                </a>
                <a href="javascript:;"
                    class="flex items-center w-8 h-8 transition duration-300 rounded-full collapse-icon hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light rtl:rotate-180"
                    @click="$store.app.toggleSidebar()">
                    <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
            <ul class="perfect-scrollbar relative font-semibold space-y-0.5 h-[calc(100vh-80px)] overflow-y-auto overflow-x-hidden p-4 py-0">

                <!-- Dashboard -->
                <li class="menu nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z" fill="currentColor" />
                                <path d="M9 17.25C8.58579 17.25 8.25 17.5858 8.25 18C8.25 18.4142 8.58579 18.75 9 18.75H15C15.4142 18.75 15.75 18.4142 15.75 18C15.75 17.5858 15.4142 17.25 15 17.25H9Z" fill="currentColor" />
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Dashboard</span>
                        </div>
                    </a>
                </li>

                <!-- Management -->
                <h2 class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                    <span>Management</span>
                </h2>

                <!-- Users -->
                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full"
                        :class="{ 'active': activeDropdown === 'users' }"
                        @click="activeDropdown = activeDropdown === 'users' ? null : 'users'">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <circle cx="12" cy="6" r="4" stroke="currentColor" stroke-width="1.5"/>
                                <path opacity="0.5" d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Users</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'users' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <ul x-collapse x-show="activeDropdown === 'users'" class="sub-menu text-gray-500">
                        <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
                        <li><a href="{{ route('admin.users.create') }}">Add User</a></li>
                    </ul>
                </li>

                <!-- Cities -->
                <li class="menu nav-item">
                    <a href="{{ route('admin.cities.index') }}" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="currentColor" stroke-width="1.5" fill="none"/>
                                <circle cx="12" cy="9" r="2.5" stroke="currentColor" stroke-width="1.5" opacity="0.5"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Cities</span>
                        </div>
                    </a>
                </li>

                <!-- Institutes -->
                <h2 class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                    <span>Institutes</span>
                </h2>

                <!-- Institute Categories -->
                <li class="menu nav-item">
                    <a href="{{ route('admin.institute-categories.index') }}" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M3 7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V7C21 8.10457 20.1046 9 19 9H5C3.89543 9 3 8.10457 3 7V7Z" fill="currentColor"/>
                                <path d="M3 13C3 11.8954 3.89543 11 5 11H19C20.1046 11 21 11.8954 21 13V13C21 14.1046 20.1046 15 19 15H5C3.89543 15 3 14.1046 3 13V13Z" fill="currentColor" opacity="0.3"/>
                                <path d="M3 19C3 17.8954 3.89543 17 5 17H13C14.1046 17 15 17.8954 15 19V19C15 20.1046 14.1046 21 13 21H5C3.89543 21 3 20.1046 3 19V19Z" fill="currentColor" opacity="0.1"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Categories</span>
                        </div>
                    </a>
                </li>

                <!-- Institutes -->
                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full"
                        :class="{ 'active': activeDropdown === 'institutes' }"
                        @click="activeDropdown = activeDropdown === 'institutes' ? null : 'institutes'">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z" fill="currentColor"/>
                                <path d="M9 17.25H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Institutes</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'institutes' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <ul x-collapse x-show="activeDropdown === 'institutes'" class="sub-menu text-gray-500">
                        <li><a href="{{ route('admin.institutes.index') }}">All Institutes</a></li>
                        <li><a href="{{ route('admin.institutes.create') }}">Add Institute</a></li>
                    </ul>
                </li>

                <!-- Courses -->
                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full"
                        :class="{ 'active': activeDropdown === 'courses' }"
                        @click="activeDropdown = activeDropdown === 'courses' ? null : 'courses'">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M17 7.82959L18.6965 9.35641C20.239 10.7447 21.0103 11.4389 21.0103 12.3296C21.0103 13.2203 20.239 13.9145 18.6965 15.3028L17 16.8296" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path opacity="0.5" d="M13.9868 5L10.0132 19.8297" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M7.00005 7.82959L5.30358 9.35641C3.76102 10.7447 2.98975 11.4389 2.98975 12.3296C2.98975 13.2203 3.76102 13.9145 5.30358 15.3028L7.00005 16.8296" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Courses</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'courses' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <ul x-collapse x-show="activeDropdown === 'courses'" class="sub-menu text-gray-500">
                        <li><a href="{{ route('admin.courses.index') }}">All Courses</a></li>
                        <li><a href="{{ route('admin.courses.create') }}">Add Course</a></li>
                    </ul>
                </li>

                <!-- Content -->
                <h2 class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                    <span>Content</span>
                </h2>

                <!-- Blog -->
                <li class="menu nav-item">
                    <button type="button" class="nav-link group w-full"
                        :class="{ 'active': activeDropdown === 'blog' }"
                        @click="activeDropdown = activeDropdown === 'blog' ? null : 'blog'">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4H20V16H4V4Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" opacity="0.5"/>
                                <path d="M8 20H16M12 16V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Blog</span>
                        </div>
                        <div class="rtl:rotate-180" :class="{ '!rotate-90': activeDropdown === 'blog' }">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </button>
                    <ul x-collapse x-show="activeDropdown === 'blog'" class="sub-menu text-gray-500">
                        <li><a href="{{ route('admin.blog.index') }}">All Posts</a></li>
                        <li><a href="{{ route('admin.blog.create') }}">New Post</a></li>
                    </ul>
                </li>

                <!-- Inquiries & Requests -->
                <h2 class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                    <span>Leads</span>
                </h2>

                <!-- Inquiries -->
                <li class="menu nav-item">
                    <a href="{{ route('admin.inquiries.index') }}" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M12 2C6.47715 2 2 6.47715 2 12C2 13.8214 2.48697 15.5291 3.33782 17L2.5 21.5L7 20.6622C8.47087 21.513 10.1786 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" stroke="currentColor" stroke-width="1.5" opacity="0.5"/>
                                <path d="M8 12H8.01M12 12H12.01M16 12H16.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Inquiries</span>
                        </div>
                        @php $newCount = \App\Models\Inquiry::where('status','new')->count(); @endphp
                        @if($newCount > 0)
                            <span class="badge bg-danger text-xs ml-auto">{{ $newCount }}</span>
                        @endif
                    </a>
                </li>

                <!-- Listing Requests -->
                <li class="menu nav-item">
                    <a href="{{ route('admin.listing-requests.index') }}" class="nav-link group">
                        <div class="flex items-center">
                            <svg class="group-hover:!text-primary shrink-0" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M3 7C3 5.89543 3.89543 5 5 5H19C20.1046 5 21 5.89543 21 7V7C21 8.10457 20.1046 9 19 9H5C3.89543 9 3 8.10457 3 7V7Z" fill="currentColor"/>
                                <path d="M21 12H14M21 17H14M3 12H6M3 17H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M10 12C10 11.4477 9.55228 11 9 11C8.44772 11 8 11.4477 8 12C8 12.5523 8.44772 13 9 13C9.55228 13 10 12.5523 10 12Z" fill="currentColor"/>
                                <path d="M10 17C10 16.4477 9.55228 16 9 16C8.44772 16 8 16.4477 8 17C8 17.5523 8.44772 18 9 18C9.55228 18 10 17.5523 10 17Z" fill="currentColor"/>
                            </svg>
                            <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">Listing Requests</span>
                        </div>
                        @php $pendingCount = \App\Models\ListingRequest::where('status','pending')->count(); @endphp
                        @if($pendingCount > 0)
                            <span class="badge bg-warning text-xs ml-auto">{{ $pendingCount }}</span>
                        @endif
                    </a>
                </li>

            </ul>
        </div>
    </nav>
</div>

<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("sidebar", () => ({
            activeDropdown: null
        }));
    });

    document.addEventListener("DOMContentLoaded", function() {
        const currentPath = window.location.pathname.replace(/\/$/, '');
        const links = document.querySelectorAll('.sidebar a[href]');
        links.forEach(function(link) {
            let linkPath = link.getAttribute('href').replace(/\/$/, '');
            if (linkPath.startsWith('http')) {
                linkPath = new URL(linkPath).pathname.replace(/\/$/, '');
            }
            if (linkPath === currentPath) {
                link.classList.add('active');
                const parentLi = link.closest('ul.sub-menu')?.previousElementSibling;
                if (parentLi) {
                    parentLi.click();
                }
            }
        });
    });
</script>
