@extends('doctor.dashboard.layout')
@section('title', 'Manage Specialities')
@section('page_title', 'Medical Specialities')
@section('page_subtitle', 'Manage your medical specializations and expertise areas')

@section('content')
    <!-- Action Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-stethoscope text-emerald-600 text-xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Medical Specialities</h2>
                <p class="text-gray-600">Select your areas of medical expertise</p>
            </div>
        </div>
        
        <div class="flex space-x-3">
            <button onclick="showAllSpecialities()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-list mr-2"></i>
                View All
            </button>
            <button onclick="showSelectedOnly()" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-check-circle mr-2"></i>
                Selected Only
            </button>
        </div>
    </div>

    <!-- Current Specialities Status -->
    @if(isset($doctor) && $doctor->specialties && $doctor->specialties->count() > 0)
        <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-6 mb-8">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check-circle text-emerald-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-emerald-900">Your Current Specialities</h3>
                    <div class="flex flex-wrap gap-2 mt-3">
                        @foreach($doctor->specialties as $specialty)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                                <i class="fas fa-check mr-2"></i>
                                {{ $specialty->special_name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 mb-8">
            <div class="flex items-start space-x-4">
                <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-yellow-900">No Specialities Selected</h3>
                    <p class="text-yellow-700 mt-1">Please select your medical specialities to complete your profile and help patients find you more easily.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Specialities Selection Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-white">Available Medical Specialities</h3>
                <div class="text-emerald-100 text-sm">
                    Select all that apply to your practice
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Search Box -->
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchSpecialities" placeholder="Search specialities..." class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('doctor.specialities.store') }}">
                @csrf
                
                <!-- Specialities Grid -->
                <div id="specialitiesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    @if(isset($specialities) && $specialities->count() > 0)
                        @foreach($specialities as $speciality)
                            @php
                                $isSelected = isset($doctor) && $doctor->specialties && $doctor->specialties->contains('id', $speciality->id);
                                $oldSelected = is_array(old('specialities')) && in_array($speciality->id, old('specialities'));
                                $checked = $isSelected || $oldSelected;
                            @endphp
                            
                            <div class="specialty-item border border-gray-200 rounded-xl p-4 hover:shadow-md transition-all duration-200 {{ $checked ? 'bg-emerald-50 border-emerald-300' : 'hover:bg-gray-50' }}" data-name="{{ strtolower($speciality->special_name) }}">
                                <label class="flex items-start space-x-3 cursor-pointer">
                                    <input type="checkbox" 
                                           name="specialities[]" 
                                           value="{{ $speciality->id }}"
                                           class="specialty-checkbox mt-1 h-5 w-5 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                                           {{ $checked ? 'checked' : '' }}
                                           onchange="toggleSpecialtyCard(this)">
                                    
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-user-md text-emerald-600"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-semibold text-gray-900 text-sm">{{ $speciality->special_name }}</h4>
                                                @if($speciality->description)
                                                    <p class="text-xs text-gray-500 mt-1">{{ Str::limit($speciality->description, 60) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- Selected indicator -->
                                        <div class="specialty-indicator mt-2 {{ $checked ? '' : 'hidden' }}">
                                            <div class="flex items-center text-xs text-emerald-600">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Selected
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    @else
                        <div class="col-span-full text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-stethoscope text-gray-400 text-2xl"></i>
                            </div>
                            <p class="text-gray-500 text-lg">No specialities available</p>
                            <p class="text-gray-400 text-sm mt-1">Please contact admin to add medical specialities</p>
                        </div>
                    @endif
                </div>

                <!-- Selection Summary -->
                <div id="selectionSummary" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6" style="display: none;">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-medium text-blue-900">Selection Summary</h4>
                            <p class="text-blue-700 text-sm" id="summaryText">0 specialities selected</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if(isset($specialities) && $specialities->count() > 0)
                    <div class="border-t border-gray-200 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex space-x-3">
                            <button type="button" onclick="selectAll()" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                Select All
                            </button>
                            <button type="button" onclick="clearAll()" class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                Clear All
                            </button>
                        </div>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('doctor.profile') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Back to Dashboard
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                                <i class="fas fa-save mr-2"></i>
                                Save Specialities
                            </button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Popular Specialities Section -->
    @if(isset($specialities) && $specialities->count() > 0)
        <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular Specialities</h3>
            <div class="flex flex-wrap gap-2">
                @php
                    $popularSpecialities = $specialities->take(8); // Show first 8 as "popular"
                @endphp
                @foreach($popularSpecialities as $speciality)
                    <button type="button" 
                            onclick="toggleSpecialtyById({{ $speciality->id }})" 
                            class="px-3 py-2 border border-gray-200 text-gray-700 rounded-lg hover:bg-emerald-50 hover:border-emerald-300 hover:text-emerald-700 transition-colors text-sm">
                        {{ $speciality->special_name }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    <script>
        // Search functionality
        document.getElementById('searchSpecialities').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const specialtyItems = document.querySelectorAll('.specialty-item');
            
            specialtyItems.forEach(item => {
                const name = item.dataset.name;
                if (name.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });

        // Toggle specialty card appearance
        function toggleSpecialtyCard(checkbox) {
            const card = checkbox.closest('.specialty-item');
            const indicator = card.querySelector('.specialty-indicator');
            
            if (checkbox.checked) {
                card.classList.add('bg-emerald-50', 'border-emerald-300');
                card.classList.remove('bg-white');
                indicator.classList.remove('hidden');
            } else {
                card.classList.remove('bg-emerald-50', 'border-emerald-300');
                card.classList.add('bg-white');
                indicator.classList.add('hidden');
            }
            
            updateSelectionSummary();
        }

        // Update selection summary
        function updateSelectionSummary() {
            const checkedBoxes = document.querySelectorAll('.specialty-checkbox:checked');
            const summary = document.getElementById('selectionSummary');
            const summaryText = document.getElementById('summaryText');
            
            if (checkedBoxes.length > 0) {
                summary.style.display = 'block';
                summaryText.textContent = `${checkedBoxes.length} specialit${checkedBoxes.length === 1 ? 'y' : 'ies'} selected`;
            } else {
                summary.style.display = 'none';
            }
        }

        // Select all specialities
        function selectAll() {
            const checkboxes = document.querySelectorAll('.specialty-checkbox:not(:checked)');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
                toggleSpecialtyCard(checkbox);
            });
        }

        // Clear all selections
        function clearAll() {
            const checkboxes = document.querySelectorAll('.specialty-checkbox:checked');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
                toggleSpecialtyCard(checkbox);
            });
        }

        // Toggle specialty by ID (for popular buttons)
        function toggleSpecialtyById(specialtyId) {
            const checkbox = document.querySelector(`input[value="${specialtyId}"]`);
            if (checkbox) {
                checkbox.checked = !checkbox.checked;
                toggleSpecialtyCard(checkbox);
            }
        }

        // Show all specialities
        function showAllSpecialities() {
            const specialtyItems = document.querySelectorAll('.specialty-item');
            specialtyItems.forEach(item => {
                item.style.display = 'block';
            });
            document.getElementById('searchSpecialities').value = '';
        }

        // Show selected only
        function showSelectedOnly() {
            const specialtyItems = document.querySelectorAll('.specialty-item');
            specialtyItems.forEach(item => {
                const checkbox = item.querySelector('.specialty-checkbox');
                if (checkbox.checked) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            document.getElementById('searchSpecialities').value = '';
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectionSummary();
            
            // Apply initial card styling for pre-selected items
            const checkedBoxes = document.querySelectorAll('.specialty-checkbox:checked');
            checkedBoxes.forEach(checkbox => {
                toggleSpecialtyCard(checkbox);
            });
        });
    </script>
@endsection