@php
    $page_title = 'Vezeeta - Find Doctors';

    // Default specialty name for the breadcrumb and title
    $specialtyName = 'Doctors';

    // Get search parameters from data passed by controller
    $searchParams = $data['searchParams'] ?? [];
    $searchQuery = $searchParams['query'] ?? '';
    $specialty = $searchParams['specialty'] ?? '';
    $city = $searchParams['city'] ?? '';
    $area = $searchParams['area'] ?? '';
    $telehealth_type = $searchParams['telehealth_type'] ?? '';

    // Update specialty name for display
    if (!empty($specialty)) {
        $specialtyName = ucfirst($specialty);
        $page_title = "Vezeeta - Find $specialtyName";
    }

    // Set location string for breadcrumb
    $locationString = !empty($city) ? ucfirst($city) : 'Egypt';
    if (!empty($area)) {
        $locationString .= ', ' . ucfirst($area);
    }
@endphp

@extends('layouts.app')
@section('title', $page_title)

@section('content')

    <!-- Breadcrumb -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 py-3 text-sm text-gray-600">
                <a href="/" class="text-blue-600 hover:text-blue-800">Vezeeta</a>
                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-800"><?php echo $specialtyName; ?> in <?php echo $locationString; ?></span>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar - Filters -->
            <div id="sidebar" class="lg:w-1/4">
                <div id="filter-container" class="sticky top-6">
                    @include('components.filter-sidebar')
                </div>
            </div>

            @php
                // Get doctors data from controller
                $doctorsData = $data['doctors'];
                $totalDoctors = $data['totalDoctors'];
                
                // Pagination information
                $currentPage = $doctorsData->currentPage();
                $perPage = $doctorsData->perPage();
                $totalPages = $doctorsData->lastPage();
                $firstItem = $doctorsData->firstItem();
                $lastItem = $doctorsData->lastItem();
                
                // Get actual doctors for current page
                $doctors = $doctorsData->items();
            @endphp
            <!-- Main Content -->
            <div id="main-content" class="lg:w-3/4">
                <!-- Header Section -->
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $specialtyName }}</h1>
                            <p class="text-gray-600">
                                {{ $totalDoctors }} Doctors
                                @if ($totalPages > 1)
                                <span class="text-gray-500">
                                    (Showing {{ $firstItem }}-{{ $lastItem }} of {{ $totalDoctors }})
                                </span>
                                @endif

                                @if (!empty($searchQuery) || !empty($specialty) || !empty($city) || !empty($area) || !empty($telehealth_type))
                                <a href="{{ route('doctors.page') }}" class="ml-2 text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-times-circle"></i> Clear filters
                                </a>
                                @endif
                            </p>
                        </div>
                        <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                            <div class="flex items-center">
                                <label for="sort-select" class="text-sm font-medium text-gray-700 mr-2">Sorting:</label>
                                <select id="sort-select"
                                    class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option>Best Match</option>
                                    <option>Highest Rated</option>
                                    <option>Lowest Price</option>
                                    <option>Nearest</option>
                                    <option>Earliest Available</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page Info Bar -->
                @if ($totalPages > 1)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-700">
                            <i class="fas fa-info-circle mr-2"></i>
                            Page {{ $currentPage }} of {{ $totalPages }}
                        </span>
                        <span class="text-blue-600">
                            Showing doctors {{ $firstItem }}-{{ $lastItem }}
                        </span>
                    </div>
                </div>
                @endif

                <!-- Search Summary -->
                @if (!empty($searchQuery) || !empty($specialty) || !empty($city) || !empty($area) || !empty($telehealth_type))
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 mb-6">
                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="text-gray-700 font-medium">Active filters:</span>

                            @if (!empty($specialty))
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Specialty: {{ ucfirst($specialty) }}
                                <a href="{{ request()->fullUrlWithQuery(['specialty' => '']) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            @endif

                            @if (!empty($city))
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                City: {{ ucfirst($city) }}
                                <a href="{{ request()->fullUrlWithQuery(['city' => '']) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            @endif

                            @if (!empty($area))
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Area: {{ ucfirst($area) }}
                                <a href="{{ request()->fullUrlWithQuery(['area' => '']) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            @endif

                            @if (!empty($searchQuery))
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Search: "{{ $searchQuery }}"
                                <a href="{{ request()->fullUrlWithQuery(['query' => '']) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            @endif

                            @if (!empty($telehealth_type))
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Telehealth: {{ ucfirst($telehealth_type) }}
                                <a href="{{ request()->fullUrlWithQuery(['telehealth_type' => '']) }}" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            @endif

                            <a href="{{ route('doctors.page') }}" class="text-blue-600 hover:text-blue-800 text-xs underline ml-auto">
                                Clear all filters
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Doctors List -->
                <div class="space-y-6">
                    @if (count($doctors) === 0)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                        <div class="text-lg font-medium text-blue-800 mb-2">No doctors found</div>
                        <p class="text-blue-600">Please try different search criteria or clear some filters.</p>
                        <a href="{{ route('home') }}"
                            class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Return
                            to homepage</a>
                    </div>
                    @else
                    @foreach ($doctors as $doctor)
                    <div class="doctor-card-container">
                        @include('components.doctor-card-db', ['doctor' => $doctor])
                    </div>
                    @endforeach
                    @endif
                </div>

                <!-- Pagination -->
                @if ($doctorsData->hasPages())
                <div class="mt-8">
                    @include('components.custom-pagination', ['paginator' => $doctorsData])
                </div>
                @endif
            </div>
        </div>
    </div>


    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle sort dropdown change
            const sortSelect = document.getElementById('sort-select');
            sortSelect.addEventListener('change', function() {
                // In a real application, this would trigger a new search/sort
                console.log('Sorting by:', this.value);
            });

            // Add smooth scrolling for pagination - Updated for new pagination
            document.addEventListener('click', function(e) {
                // Check if the clicked element is a pagination link
                if (e.target.closest('a[href*="page="]')) {
                    const link = e.target.closest('a[href*="page="]');
                    if (link && !link.classList.contains('disabled')) {
                        // Scroll to top of results after page loads
                        setTimeout(() => {
                            window.scrollTo({
                                top: document.querySelector('#main-content')?.offsetTop - 100 || 0,
                                behavior: 'smooth'
                            });
                        }, 100);
                    }
                }
            });

            // Handle responsive behavior
            function handleResize() {
                const sidebar = document.querySelector('#sidebar');
                const mainContent = document.querySelector('#main-content');

                if (window.innerWidth < 1024) {
                    console.log(window.innerWidth);
                    // Mobile: Make sidebar collapsible
                    if (sidebar && !sidebar.querySelector('.mobile-toggle')) {
                        const toggleButton = document.createElement('button');
                        toggleButton.className =
                            'mobile-toggle lg:hidden w-full mb-4 py-2 px-4 bg-blue-600 text-white rounded-lg flex items-center justify-center';
                        toggleButton.innerHTML = '<i class="fas fa-filter mr-2"></i>Show Filters';

                        const filterContainer = document.querySelector('#filter-container');
                        sidebar.insertBefore(toggleButton, filterContainer);
                        filterContainer.classList.add('max-lg:hidden');

                        toggleButton.addEventListener('click', function() {
                            const isHidden = filterContainer.classList.contains('max-lg:hidden');
                            if (isHidden) {
                                filterContainer.classList.remove('max-lg:hidden');
                                this.innerHTML = '<i class="fas fa-times mr-2"></i>Hide Filters';
                            } else {
                                filterContainer.classList.add('max-lg:hidden');
                                this.innerHTML = '<i class="fas fa-filter mr-2"></i>Show Filters';
                            }
                        });
                    }
                }
            }

            // Initial call and event listener
            handleResize();
            window.addEventListener('resize', handleResize);

            // Add loading states for book buttons
            const bookButtons = document.querySelectorAll('.book-btn');
            bookButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.disabled) {
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Booking...';

                        // Simulate API call
                        setTimeout(() => {
                            this.innerHTML = '<i class="fas fa-check mr-2"></i>BOOKED';
                            this.classList.remove('bg-red-600', 'hover:bg-red-700');
                            this.classList.add('bg-green-600');
                        }, 2000);
                    }
                });
            });
        });
    </script>

@endsection
