<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <title>@yield('title', 'Doctor Dashboard') - Vezeeta</title>

    <!-- Tailwind CSS with custom config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-in': 'slideIn 0.3s ease-out',
                        'pulse-slow': 'pulse 3s infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js for dashboard charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 bg-white shadow-2xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 -translate-x-full" id="sidebar">
            <!-- Logo & Doctor Info -->
            <div class="relative bg-gradient-to-br from-emerald-600 via-emerald-700 to-emerald-800 px-6 py-8">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                <div class="absolute inset-0 bg-gradient-to-br from-transparent via-white to-transparent opacity-5"></div>
                
                <!-- Content -->
                <div class="relative flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-white bg-opacity-20 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white border-opacity-20 shadow-lg">
                            <i class="fas fa-user-md text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-white text-lg tracking-wide">
                            Dr. {{ auth('doctor')->user()->name ?? 'Doctor' }}
                        </h3>
                        <p class="text-emerald-100 text-sm truncate font-medium" title="{{ auth('doctor')->user()->email ?? 'doctor@vezeeta.com' }}">
                            {{ auth('doctor')->user()->email ?? 'doctor@vezeeta.com' }}
                        </p>
                        <!-- Status Badge -->
                        <div class="flex items-center mt-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="ml-2 text-emerald-100 text-xs font-medium">Online</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <!-- Dashboard -->
                <a href="{{ route('doctor.profile') }}" 
                   class="group flex items-center px-4 py-3.5 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out {{ request()->routeIs('doctor.profile') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/25 border-l-4 border-emerald-300' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 hover:translate-x-1' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('doctor.profile') ? 'bg-white bg-opacity-20 text-white' : 'bg-gray-100 text-gray-600 group-hover:bg-emerald-100 group-hover:text-emerald-600' }} rounded-lg transition-all duration-200">
                        <i class="fas fa-tachometer-alt text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold">Dashboard</span>
                    @if(request()->routeIs('doctor.profile'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full opacity-75"></div>
                    @endif
                </a>

                <!-- Appointments -->
                <a href="{{ route('doctor.appointments') }}" 
                   class="group flex items-center px-4 py-3.5 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out {{ request()->routeIs('doctor.appointments*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/25 border-l-4 border-emerald-300' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 hover:translate-x-1' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('doctor.appointments*') ? 'bg-white bg-opacity-20 text-white' : 'bg-gray-100 text-gray-600 group-hover:bg-emerald-100 group-hover:text-emerald-600' }} rounded-lg transition-all duration-200">
                        <i class="fas fa-calendar-alt text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold">Appointments</span>
                    @if(request()->routeIs('doctor.appointments*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full opacity-75"></div>
                    @endif
                </a>

                <!-- Specialities -->
                <a href="{{ route('doctor.selectSpecialities') }}" 
                   class="group flex items-center px-4 py-3.5 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out {{ request()->routeIs('doctor.selectSpecialities*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/25 border-l-4 border-emerald-300' : 'text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 hover:translate-x-1' }}">
                    <div class="flex items-center justify-center w-8 h-8 {{ request()->routeIs('doctor.selectSpecialities*') ? 'bg-white bg-opacity-20 text-white' : 'bg-gray-100 text-gray-600 group-hover:bg-emerald-100 group-hover:text-emerald-600' }} rounded-lg transition-all duration-200">
                        <i class="fas fa-stethoscope text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold">Specialities</span>
                    @if(request()->routeIs('doctor.selectSpecialities*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full opacity-75"></div>
                    @endif
                </a>

                <!-- Patients -->
                <a href="#" class="group flex items-center px-4 py-3.5 text-sm font-medium text-gray-700 rounded-xl transition-all duration-200 ease-in-out hover:bg-emerald-50 hover:text-emerald-700 hover:translate-x-1">
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-lg transition-all duration-200 group-hover:bg-emerald-100 group-hover:text-emerald-600">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold">Patients</span>
                    <div class="ml-auto px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded-full">12</div>
                </a>

                <!-- Reports -->
                <a href="#" class="group flex items-center px-4 py-3.5 text-sm font-medium text-gray-700 rounded-xl transition-all duration-200 ease-in-out hover:bg-emerald-50 hover:text-emerald-700 hover:translate-x-1">
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-lg transition-all duration-200 group-hover:bg-emerald-100 group-hover:text-emerald-600">
                        <i class="fas fa-chart-bar text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold">Reports</span>
                </a>

                <!-- Profile Settings -->
                <a href="#" class="group flex items-center px-4 py-3.5 text-sm font-medium text-gray-700 rounded-xl transition-all duration-200 ease-in-out hover:bg-emerald-50 hover:text-emerald-700 hover:translate-x-1">
                    <div class="flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-lg transition-all duration-200 group-hover:bg-emerald-100 group-hover:text-emerald-600">
                        <i class="fas fa-user-circle text-sm"></i>
                    </div>
                    <span class="ml-3 font-semibold">Profile Settings</span>
                </a>

                <!-- Divider -->
                <div class="pt-6 mt-6 border-t border-gray-200">
                    <!-- Help & Support -->
                    <a href="#" class="group flex items-center px-4 py-3.5 text-sm font-medium text-gray-700 rounded-xl transition-all duration-200 ease-in-out hover:bg-blue-50 hover:text-blue-700 hover:translate-x-1">
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-100 text-gray-600 rounded-lg transition-all duration-200 group-hover:bg-blue-100 group-hover:text-blue-600">
                            <i class="fas fa-question-circle text-sm"></i>
                        </div>
                        <span class="ml-3 font-semibold">Help & Support</span>
                    </a>

                    <!-- Logout -->
                    <a href="{{ route('doctor.logout') }}" class="group flex items-center px-4 py-3.5 text-sm font-medium text-red-600 rounded-xl transition-all duration-200 ease-in-out hover:bg-red-50 hover:translate-x-1">
                        <div class="flex items-center justify-center w-8 h-8 bg-red-100 text-red-600 rounded-lg transition-all duration-200 group-hover:bg-red-200">
                            <i class="fas fa-sign-out-alt text-sm"></i>
                        </div>
                        <span class="ml-3 font-semibold">Logout</span>
                    </a>
                </div>
            </nav>

            <!-- Footer Info -->
            <div class="p-4 border-t border-gray-200">
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>Version 2.1.0</span>
                    <span>Vezeeta</span>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-60 z-40 lg:hidden transition-opacity duration-300 opacity-0 pointer-events-none" id="sidebar-overlay"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden lg:ml-0">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 z-30 relative">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <!-- Page Title -->
                        <div>
                            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">@yield('page_title', 'Dashboard')</h1>
                            <p class="text-gray-600 text-sm mt-1">@yield('page_subtitle', 'Welcome to your doctor dashboard')</p>
                        </div>
                    </div>

                    <!-- Header Actions -->
                    <div class="flex items-center space-x-3">
                        <!-- Search -->
                        <div class="hidden sm:block relative">
                            <input type="text" placeholder="Search..." class="w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <div class="relative">
                            <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200 relative">
                                <i class="fas fa-bell text-lg"></i>
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">3</span>
                            </button>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="relative">
                            <button class="flex items-center space-x-3 p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200" onclick="toggleProfileDropdown()">
                                <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white shadow-lg">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-sm font-semibold text-gray-900">Dr. {{ auth('doctor')->user()->name ?? 'Doctor' }}</p>
                                    <p class="text-xs text-gray-500">Online</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                                <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-user-circle w-5 text-gray-400 mr-3"></i>
                                    View Profile
                                </a>
                                <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-cog w-5 text-gray-400 mr-3"></i>
                                    Settings
                                </a>
                                <hr class="my-2 border-gray-200">
                                <a href="{{ route('doctor.logout') }}" class="flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                    <i class="fas fa-sign-out-alt w-5 text-red-400 mr-3"></i>
                                    Sign out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-400 rounded-lg p-4 shadow-sm animate-fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            </div>
                            <div class="ml-auto">
                                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-green-400 hover:text-green-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 rounded-lg p-4 shadow-sm animate-fade-in">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-400 text-lg"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-red-800 font-medium">{{ session('error') }}</p>
                            </div>
                            <div class="ml-auto">
                                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-red-400 hover:text-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const isOpen = !sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100');
            } else {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100');
            }
        }

        // Profile dropdown functionality
        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const profileDropdown = document.getElementById('profileDropdown');

            // Close sidebar on mobile when clicking outside
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(e.target) && !e.target.closest('button[onclick="toggleSidebar()"]')) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('opacity-0', 'pointer-events-none');
                    overlay.classList.remove('opacity-100');
                }
            }

            // Close profile dropdown when clicking outside
            if (!e.target.closest('button[onclick="toggleProfileDropdown()"]') && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (window.innerWidth >= 1024) {
                // Desktop view - ensure sidebar is visible and overlay is hidden
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100');
            } else {
                // Mobile view - hide sidebar by default
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100');
            }
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state based on screen size
            if (window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
            }

            // Add smooth transitions after initial load
            setTimeout(() => {
                document.getElementById('sidebar').style.transition = 'transform 300ms cubic-bezier(0.4, 0, 0.2, 1)';
                document.getElementById('sidebar-overlay').style.transition = 'opacity 300ms ease-in-out';
            }, 100);
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // ESC key closes sidebar on mobile
            if (e.key === 'Escape' && window.innerWidth < 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100');
            }
        });
    </script>
</body>

</html>
