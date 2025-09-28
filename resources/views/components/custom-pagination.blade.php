@if ($paginator->hasPages())
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <!-- Mobile Pagination -->
        <div class="flex justify-between items-center sm:hidden mb-4">
            <div class="text-sm text-gray-700">
                Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}
            </div>
            <div class="flex space-x-2">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        <i class="fas fa-chevron-left mr-1"></i>
                        Previous
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-chevron-left mr-1"></i>
                        Previous
                    </a>
                @endif

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                        Next
                        <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                @else
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-md cursor-not-allowed">
                        Next
                        <i class="fas fa-chevron-right ml-1"></i>
                    </span>
                @endif
            </div>
        </div>

        <!-- Desktop Pagination -->
        <div class="hidden sm:flex sm:items-center sm:justify-between">
            <!-- Results Info -->
            <div class="text-sm text-gray-700">
                <div class="flex items-center space-x-1">
                    <i class="fas fa-info-circle text-blue-500"></i>
                    <span>
                        Showing
                        @if ($paginator->firstItem())
                            <span class="font-semibold text-blue-600">{{ $paginator->firstItem() }}</span>
                            to
                            <span class="font-semibold text-blue-600">{{ $paginator->lastItem() }}</span>
                        @else
                            {{ $paginator->count() }}
                        @endif
                        of
                        <span class="font-semibold text-blue-600">{{ $paginator->total() }}</span>
                        doctors
                    </span>
                </div>
            </div>

            <!-- Pagination Controls -->
            <div class="flex items-center space-x-1">
                {{-- Previous Page --}}
                @if ($paginator->onFirstPage())
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-l-md cursor-not-allowed">
                        <i class="fas fa-chevron-double-left mr-1"></i>
                        First
                    </span>
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border-l-0 border border-gray-200 cursor-not-allowed">
                        <i class="fas fa-chevron-left mr-1"></i>
                        Prev
                    </span>
                @else
                    <a href="{{ $paginator->url(1) }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-l-md hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                        <i class="fas fa-chevron-double-left mr-1"></i>
                        First
                    </a>
                    <a href="{{ $paginator->previousPageUrl() }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border-l-0 border border-gray-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                        <i class="fas fa-chevron-left mr-1"></i>
                        Prev
                    </a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border-l-0 border border-gray-200">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-blue-600 border-l-0 border border-blue-600">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 bg-white border-l-0 border border-gray-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border-l-0 border border-gray-200 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                        Next
                        <i class="fas fa-chevron-right ml-1"></i>
                    </a>
                    <a href="{{ $paginator->url($paginator->lastPage()) }}" 
                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border-l-0 border border-gray-200 rounded-r-md hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-all duration-200">
                        Last
                        <i class="fas fa-chevron-double-right ml-1"></i>
                    </a>
                @else
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border-l-0 border border-gray-200 cursor-not-allowed">
                        Next
                        <i class="fas fa-chevron-right ml-1"></i>
                    </span>
                    <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border-l-0 border border-gray-200 rounded-r-md cursor-not-allowed">
                        Last
                        <i class="fas fa-chevron-double-right ml-1"></i>
                    </span>
                @endif
            </div>
        </div>

        <!-- Additional Controls -->
        <div class="mt-6 pt-4 border-t border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <!-- Items per page -->
                <div class="flex items-center space-x-3">
                    <label for="per-page-select" class="text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-list mr-2 text-blue-500"></i>
                        Show:
                    </label>
                    <select id="per-page-select" 
                            class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="10" {{ request()->get('per_page', 15) == 10 ? 'selected' : '' }}>10 doctors</option>
                        <option value="15" {{ request()->get('per_page', 15) == 15 ? 'selected' : '' }}>15 doctors</option>
                        <option value="25" {{ request()->get('per_page', 15) == 25 ? 'selected' : '' }}>25 doctors</option>
                        <option value="50" {{ request()->get('per_page', 15) == 50 ? 'selected' : '' }}>50 doctors</option>
                    </select>
                </div>

                <!-- Page Jump -->
                @if ($paginator->lastPage() > 1)
                <div class="flex items-center space-x-3">
                    <label for="jump-to-page" class="text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-arrow-right mr-2 text-blue-500"></i>
                        Go to page:
                    </label>
                    <div class="flex items-center space-x-2">
                        <input type="number" 
                               id="jump-to-page" 
                               min="1" 
                               max="{{ $paginator->lastPage() }}"
                               value="{{ $paginator->currentPage() }}"
                               class="w-16 border border-gray-300 rounded-md px-3 py-2 text-sm text-center focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <span class="text-sm text-gray-500">of {{ $paginator->lastPage() }}</span>
                        <button id="go-to-page" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            <i class="fas fa-arrow-right mr-1"></i>
                            Go
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Per page selector functionality
            const perPageSelect = document.getElementById('per-page-select');
            if (perPageSelect) {
                perPageSelect.addEventListener('change', function() {
                    const url = new URL(window.location);
                    url.searchParams.set('per_page', this.value);
                    url.searchParams.set('page', '1'); // Reset to first page
                    
                    // Show loading state
                    this.disabled = true;
                    this.style.opacity = '0.5';
                    
                    // Add loading spinner
                    const spinner = document.createElement('i');
                    spinner.className = 'fas fa-spinner fa-spin ml-2';
                    this.parentNode.appendChild(spinner);
                    
                    window.location.href = url.toString();
                });
            }

            // Jump to page functionality
            const jumpToPageInput = document.getElementById('jump-to-page');
            const goToPageBtn = document.getElementById('go-to-page');
            
            if (jumpToPageInput && goToPageBtn) {
                function goToPage() {
                    const page = parseInt(jumpToPageInput.value);
                    const maxPage = {{ $paginator->lastPage() }};
                    
                    if (page >= 1 && page <= maxPage && page !== {{ $paginator->currentPage() }}) {
                        // Show loading state
                        goToPageBtn.disabled = true;
                        goToPageBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Loading...';
                        
                        const url = new URL(window.location);
                        url.searchParams.set('page', page);
                        window.location.href = url.toString();
                    } else if (page === {{ $paginator->currentPage() }}) {
                        // Already on this page
                        jumpToPageInput.focus();
                    } else {
                        jumpToPageInput.value = {{ $paginator->currentPage() }};
                        jumpToPageInput.focus();
                        
                        // Show error message
                        const errorMsg = document.createElement('div');
                        errorMsg.className = 'text-red-500 text-xs mt-1';
                        errorMsg.textContent = 'Please enter a valid page number between 1 and ' + maxPage;
                        jumpToPageInput.parentNode.appendChild(errorMsg);
                        
                        setTimeout(() => {
                            if (errorMsg.parentNode) {
                                errorMsg.parentNode.removeChild(errorMsg);
                            }
                        }, 3000);
                    }
                }

                goToPageBtn.addEventListener('click', goToPage);
                
                jumpToPageInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        goToPage();
                    }
                });

                // Auto-select input content on focus
                jumpToPageInput.addEventListener('focus', function() {
                    this.select();
                });
            }

            // Add smooth scrolling animation when clicking pagination links
            document.querySelectorAll('a[href*="page="]').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add a subtle loading effect
                    const loadingOverlay = document.createElement('div');
                    loadingOverlay.className = 'fixed inset-0 bg-white bg-opacity-50 flex items-center justify-center z-50';
                    loadingOverlay.innerHTML = `
                        <div class="flex flex-col items-center">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                            <p class="mt-4 text-gray-600">Loading doctors...</p>
                        </div>
                    `;
                    document.body.appendChild(loadingOverlay);
                });
            });
        });
    </script>
@endif