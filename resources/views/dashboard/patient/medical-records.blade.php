@extends('layouts.app')
@section('title', 'Medical Records - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Patient Sidebar -->
            @php
                $patient_name = auth()->user()->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad(auth()->id(), 3, '0', STR_PAD_LEFT);
                $patient_avatar = auth()->user()->avatar ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $current_page = 'medical-records';
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'current_page' => $current_page,
            ])

            <!-- Medical Records Content -->
            <main class="lg:w-3/4 w-full space-y-6">
                
                <!-- Page Header -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Medical Records</h1>
                            <p class="text-gray-600 mt-1">Your complete medical history and documents</p>
                        </div>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Record
                            </button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-download mr-2"></i>Export All
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="border-b border-gray-200">
                        <nav class="flex space-x-8 px-6" aria-label="Tabs">
                            <button class="border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600" id="tab-all">
                                All Records
                            </button>
                            <button class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="tab-consultations">
                                Consultations
                            </button>
                            <button class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="tab-prescriptions">
                                Prescriptions
                            </button>
                            <button class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="tab-lab-results">
                                Lab Results
                            </button>
                            <button class="border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" id="tab-imaging">
                                Imaging
                            </button>
                        </nav>
                    </div>

                    <!-- Records List -->
                    <div class="p-6">
                        <!-- Search and Filter -->
                        <div class="flex flex-col sm:flex-row gap-4 mb-6">
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" placeholder="Search medical records..." 
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                                </div>
                            </div>
                            <div class="flex space-x-3">
                                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option>All Doctors</option>
                                    <option>Dr. Ahmed Hassan</option>
                                    <option>Dr. Sarah Mohamed</option>
                                    <option>Dr. Omar Khaled</option>
                                </select>
                                <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option>All Time</option>
                                    <option>Last Month</option>
                                    <option>Last 3 Months</option>
                                    <option>Last Year</option>
                                </select>
                            </div>
                        </div>

                        <!-- Records Grid -->
                        <div class="space-y-4">
                            
                            <!-- Consultation Record -->
                            <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-user-md text-blue-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <h3 class="text-lg font-semibold text-gray-900">General Consultation</h3>
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Consultation</span>
                                            </div>
                                            <p class="text-gray-600 mt-1">Dr. Ahmed Hassan - Internal Medicine</p>
                                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                <span><i class="fas fa-calendar-alt mr-1"></i>Dec 15, 2024</span>
                                                <span><i class="fas fa-clock mr-1"></i>2:30 PM</span>
                                                <span><i class="fas fa-map-marker-alt mr-1"></i>Clinic Visit</span>
                                            </div>
                                            <p class="text-sm text-gray-700 mt-3">
                                                Routine checkup and health assessment. Patient reports feeling well with no significant symptoms.
                                                Blood pressure and vital signs normal.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Lab Results Record -->
                            <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-flask text-green-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <h3 class="text-lg font-semibold text-gray-900">Complete Blood Count (CBC)</h3>
                                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Lab Result</span>
                                            </div>
                                            <p class="text-gray-600 mt-1">Al-Mokhtabar Lab - Ordered by Dr. Ahmed Hassan</p>
                                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                <span><i class="fas fa-calendar-alt mr-1"></i>Dec 12, 2024</span>
                                                <span><i class="fas fa-clock mr-1"></i>9:00 AM</span>
                                                <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i>Normal</span>
                                            </div>
                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4 p-4 bg-gray-50 rounded-lg">
                                                <div>
                                                    <span class="text-xs text-gray-500">WBC</span>
                                                    <p class="font-medium">7.2 K/uL</p>
                                                </div>
                                                <div>
                                                    <span class="text-xs text-gray-500">RBC</span>
                                                    <p class="font-medium">4.8 M/uL</p>
                                                </div>
                                                <div>
                                                    <span class="text-xs text-gray-500">Hgb</span>
                                                    <p class="font-medium">14.2 g/dL</p>
                                                </div>
                                                <div>
                                                    <span class="text-xs text-gray-500">Platelets</span>
                                                    <p class="font-medium">285 K/uL</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Prescription Record -->
                            <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-pills text-orange-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <h3 class="text-lg font-semibold text-gray-900">Prescription #RX-2024-001</h3>
                                                <span class="px-2 py-1 bg-orange-100 text-orange-800 text-xs rounded-full">Prescription</span>
                                            </div>
                                            <p class="text-gray-600 mt-1">Dr. Sarah Mohamed - Cardiology</p>
                                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                <span><i class="fas fa-calendar-alt mr-1"></i>Dec 10, 2024</span>
                                                <span><i class="fas fa-clock mr-1"></i>11:45 AM</span>
                                                <span class="text-orange-600"><i class="fas fa-pills mr-1"></i>3 Medications</span>
                                            </div>
                                            <div class="mt-4 space-y-2">
                                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                    <div>
                                                        <p class="font-medium">Amlodipine 5mg</p>
                                                        <p class="text-sm text-gray-600">Once daily, after breakfast</p>
                                                    </div>
                                                    <span class="text-xs text-gray-500">30 days</span>
                                                </div>
                                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                                    <div>
                                                        <p class="font-medium">Metformin 500mg</p>
                                                        <p class="text-sm text-gray-600">Twice daily, with meals</p>
                                                    </div>
                                                    <span class="text-xs text-gray-500">30 days</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Imaging Record -->
                            <div class="border border-gray-200 rounded-xl p-6 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-4">
                                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                                            <i class="fas fa-x-ray text-purple-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2">
                                                <h3 class="text-lg font-semibold text-gray-900">Chest X-Ray</h3>
                                                <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full">Imaging</span>
                                            </div>
                                            <p class="text-gray-600 mt-1">Cairo Radiology Center - Ordered by Dr. Omar Khaled</p>
                                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                <span><i class="fas fa-calendar-alt mr-1"></i>Dec 8, 2024</span>
                                                <span><i class="fas fa-clock mr-1"></i>3:15 PM</span>
                                                <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i>Normal</span>
                                            </div>
                                            <p class="text-sm text-gray-700 mt-3">
                                                Chest X-ray shows clear lung fields with no evidence of acute disease. 
                                                Heart size and mediastinal contours are normal.
                                            </p>
                                            <div class="flex items-center space-x-3 mt-4">
                                                <button class="px-3 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm hover:bg-blue-100">
                                                    <i class="fas fa-eye mr-1"></i>View Images
                                                </button>
                                                <button class="px-3 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm hover:bg-gray-100">
                                                    <i class="fas fa-file-pdf mr-1"></i>Full Report
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-download"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Load More -->
                        <div class="text-center mt-8">
                            <button class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                Load More Records
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('[id^="tab-"]');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active classes from all tabs
                    tabs.forEach(t => {
                        t.classList.remove('border-blue-500', 'text-blue-600');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Add active classes to clicked tab
                    this.classList.remove('border-transparent', 'text-gray-500');
                    this.classList.add('border-blue-500', 'text-blue-600');
                });
            });
        });
    </script>

@endsection