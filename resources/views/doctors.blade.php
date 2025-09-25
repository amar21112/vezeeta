@php
    $page_title = 'Vezeeta - Find Doctors';

    // Default specialty name for the breadcrumb and title
    $specialtyName = 'Doctors';

    // Get search parameters
    $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
    $specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';
    $city = isset($_GET['city']) ? $_GET['city'] : '';
    $area = isset($_GET['area']) ? $_GET['area'] : '';
    $telehealth_type = isset($_GET['telehealth_type']) ? $_GET['telehealth_type'] : '';

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
            @include('doctors-data')
            @php
                // Get all doctors data

                $allDoctors = getAllDoctors();

                // Filter doctors based on search criteria
                if (
                    !empty($searchQuery) ||
                    !empty($specialty) ||
                    !empty($city) ||
                    !empty($area) ||
                    !empty($telehealth_type)
                ) {
                    $filteredDoctors = [];

                    foreach ($allDoctors as $id => $doctor) {
                        $matchesSearch = true;

                        // Filter by search query (doctor name)
                        if (!empty($searchQuery)) {
                            if (stripos($doctor['name'], $searchQuery) === false) {
                                $matchesSearch = false;
                            }
                        }

                        // Filter by specialty
                        if (!empty($specialty)) {
                            $specialtyFound = false;
                            foreach ($doctor['specialties'] as $doctorSpecialty) {
                                if (stripos($doctorSpecialty, $specialty) !== false) {
                                    $specialtyFound = true;
                                    break;
                                }
                            }
                            if (!$specialtyFound) {
                                $matchesSearch = false;
                            }
                        }

                        // Filter by location (city)
                        if (!empty($city)) {
                            if (stripos($doctor['location'], $city) === false) {
                                $matchesSearch = false;
                            }
                        }

                        // Add doctor to filtered results if all conditions match
                        if ($matchesSearch) {
                            $filteredDoctors[$id] = $doctor;
                        }
                    }

                    // Use filtered doctors for display
                    $allDoctors = $filteredDoctors;
                }

                // Pagination logic
                $doctorsPerPage = 3;
                $totalDoctors = count($allDoctors);
                $totalPages = ceil($totalDoctors / $doctorsPerPage);
                $currentPage = isset($_GET['page']) ? max(1, min((int) $_GET['page'], $totalPages)) : 1;

                // Calculate offset for current page
                $offset = ($currentPage - 1) * $doctorsPerPage;

                // Get doctors for current page
                $doctors = array_slice($allDoctors, $offset, $doctorsPerPage, true);
            @endphp
            <!-- Main Content -->
            <div id="main-content" class="lg:w-3/4">
                <!-- Header Section -->
                <div class="mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-2"><?php echo $specialtyName; ?></h1>
                            <p class="text-gray-600">
                                <?php echo $totalDoctors; ?> Doctors
                                <?php if ($totalPages > 1): ?>
                                <span class="text-gray-500">
                                    (Showing <?php echo $offset + 1; ?>-<?php echo min($offset + $doctorsPerPage, $totalDoctors); ?> of <?php echo $totalDoctors; ?>)
                                </span>
                                <?php endif; ?>

                                <?php if (!empty($searchQuery) || !empty($specialty) || !empty($city) || !empty($area) || !empty($telehealth_type)): ?>
                                <a href="doctors.php" class="ml-2 text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-times-circle"></i> Clear filters
                                </a>
                                <?php endif; ?>
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
                <?php if ($totalPages > 1): ?>
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-6">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-blue-700">
                            <i class="fas fa-info-circle mr-2"></i>
                            Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                        </span>
                        <span class="text-blue-600">
                            Showing doctors <?php echo $offset + 1; ?>-<?php echo min($offset + $doctorsPerPage, $totalDoctors); ?>
                        </span>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Search Summary -->
                @if (!empty($searchQuery) || !empty($specialty) || !empty($city) || !empty($area) || !empty($telehealth_type))
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 mb-6">
                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="text-gray-700 font-medium">Active filters:</span>

                            <?php if (!empty($specialty)): ?>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Specialty: <?php echo ucfirst($specialty); ?>
                                <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['specialty' => ''])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            <?php endif; ?>

                            <?php if (!empty($city)): ?>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                City: <?php echo ucfirst($city); ?>
                                <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['city' => ''])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            <?php endif; ?>

                            <?php if (!empty($area)): ?>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Area: <?php echo ucfirst($area); ?>
                                <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['area' => ''])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            <?php endif; ?>

                            <?php if (!empty($searchQuery)): ?>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Search: "<?php echo htmlspecialchars($searchQuery); ?>"
                                <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['query' => ''])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            <?php endif; ?>

                            <?php if (!empty($telehealth_type)): ?>
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                Telehealth: <?php echo ucfirst($telehealth_type); ?>
                                <a href="<?php echo '?' . http_build_query(array_merge($_GET, ['telehealth_type' => ''])); ?>" class="ml-1 text-blue-600 hover:text-blue-800">×</a>
                            </span>
                            <?php endif; ?>

                            <a href="doctors.php" class="text-blue-600 hover:text-blue-800 text-xs underline ml-auto">
                                Clear all filters
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Doctors List -->
                <div class="space-y-6">
                    <?php
        // Display message if no doctors found
        if (count($doctors) === 0): ?>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                        <div class="text-lg font-medium text-blue-800 mb-2">No doctors found</div>
                        <p class="text-blue-600">Please try different search criteria or clear some filters.</p>
                        <a href="../index.php"
                            class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Return
                            to homepage</a>
                    </div>
                    <?php else:
          // Display each doctor card for current page
          foreach ($doctors as $doctor): ?>
                    <div class="doctor-card-container">
                        @include('components.doctor-card', ['doctor' => $doctor])
                    </div>
                    <?php endforeach;
        endif; ?>
                </div>

                <!-- Pagination -->
                <?php
      // Only show pagination if there are multiple pages
      if ($totalPages > 1): ?>
                <div class="mt-8 flex items-center justify-center">
                    <nav class="flex items-center space-x-2">
                        <?php
                        // Helper function to build pagination URLs preserving existing parameters
                        function buildPaginationUrl($page)
                        {
                            $params = $_GET;
                            $params['page'] = $page;
                            return '?' . http_build_query($params);
                        }
                        ?>

                        <!-- Previous button -->
                        <?php if ($currentPage > 1): ?>
                        <a href="<?php echo buildPaginationUrl($currentPage - 1); ?>"
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                            <i class="fas fa-chevron-left mr-1"></i>
                            Previous
                        </a>
                        <?php else: ?>
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left mr-1"></i>
                            Previous
                        </span>
                        <?php endif; ?>

                        <div class="flex items-center space-x-1">
                            <?php
              // Show page numbers
              $startPage = max(1, $currentPage - 2);
              $endPage = min($totalPages, $currentPage + 2);

              // Show first page if not in range
              if ($startPage > 1): ?>
                            <a href="<?php echo buildPaginationUrl(1); ?>"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">1</a>
                            <?php if ($startPage > 2): ?>
                            <span class="px-2 py-2 text-sm text-gray-500">...</span>
                            <?php endif; ?>
                            <?php endif; ?>

                            <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                            <?php if ($i == $currentPage): ?>
                            <span
                                class="px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-lg"><?php echo $i; ?></span>
                            <?php else: ?>
                            <a href="<?php echo buildPaginationUrl($i); ?>"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50"><?php echo $i; ?></a>
                            <?php endif; ?>
                            <?php endfor; ?>

                            <!-- Show last page if not in range -->
                            <?php if ($endPage < $totalPages): ?>
                            <?php if ($endPage < $totalPages - 1): ?>
                            <span class="px-2 py-2 text-sm text-gray-500">...</span>
                            <?php endif; ?>
                            <a href="<?php echo buildPaginationUrl($totalPages); ?>"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50"><?php echo $totalPages; ?></a>
                            <?php endif; ?>
                        </div>

                        <!-- Next button -->
                        <?php if ($currentPage < $totalPages): ?>
                        <a href="<?php echo buildPaginationUrl($currentPage + 1); ?>"
                            class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-700">
                            Next
                            <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                        <?php else: ?>
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                            Next
                            <i class="fas fa-chevron-right ml-1"></i>
                        </span>
                        <?php endif; ?>
                    </nav>
                </div>
                <?php endif; ?>
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

            // Add smooth scrolling for pagination
            const paginationLinks = document.querySelectorAll('nav a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add loading state
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Loading...';
                    this.style.pointerEvents = 'none';

                    // Allow the navigation to proceed normally
                    setTimeout(() => {
                        // Scroll to top of results after page loads
                        window.scrollTo({
                            top: document.querySelector('#main-content').offsetTop -
                                100,
                            behavior: 'smooth'
                        });
                    }, 100);
                });
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
