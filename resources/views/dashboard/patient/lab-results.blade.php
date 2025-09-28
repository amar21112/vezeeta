@extends('layouts.app')
@section('title', 'Lab Results - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Patient Sidebar -->
            @php
                $patient_name = auth()->user()->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad(auth()->id(), 3, '0', STR_PAD_LEFT);
                $patient_avatar = auth()->user()->avatar ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $current_page = 'lab-results';
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'current_page' => $current_page,
            ])

            <!-- Lab Results Content -->
            <main class="lg:w-3/4 w-full space-y-6">
                
                <!-- Page Header -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Lab Results</h1>
                            <p class="text-gray-600 mt-1">Your laboratory test results and health indicators</p>
                        </div>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Upload Result
                            </button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-download mr-2"></i>Export All
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Health Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Latest Results</p>
                                <p class="text-2xl font-bold text-gray-900">12</p>
                                <p class="text-xs text-gray-500 mt-1">This month</p>
                            </div>
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <i class="fas fa-flask text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Normal Values</p>
                                <p class="text-2xl font-bold text-green-600">89%</p>
                                <p class="text-xs text-gray-500 mt-1">Within range</p>
                            </div>
                            <div class="p-3 bg-green-100 rounded-lg">
                                <i class="fas fa-check-circle text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pending Tests</p>
                                <p class="text-2xl font-bold text-orange-600">2</p>
                                <p class="text-xs text-gray-500 mt-1">Awaiting results</p>
                            </div>
                            <div class="p-3 bg-orange-100 rounded-lg">
                                <i class="fas fa-clock text-orange-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter and Search -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" placeholder="Search test results..." 
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>All Test Types</option>
                                <option>Blood Tests</option>
                                <option>Urine Tests</option>
                                <option>Imaging</option>
                                <option>Biopsy</option>
                            </select>
                            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option>All Time</option>
                                <option>Last Month</option>
                                <option>Last 3 Months</option>
                                <option>Last Year</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Recent Lab Results -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Lab Results</h2>
                        <p class="text-sm text-gray-600 mt-1">Your latest test results and trends</p>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        
                        <!-- Complete Blood Count (CBC) -->
                        <div class="border border-gray-200 rounded-xl p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-flask text-green-600"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-lg font-semibold text-gray-900">Complete Blood Count (CBC)</h3>
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Normal</span>
                                        </div>
                                        <p class="text-gray-600 mt-1">Al-Mokhtabar Lab - Ordered by Dr. Ahmed Hassan</p>
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            <span><i class="fas fa-calendar-alt mr-1"></i>Dec 15, 2024</span>
                                            <span><i class="fas fa-clock mr-1"></i>9:30 AM</span>
                                            <span><i class="fas fa-user-md mr-1"></i>Dr. Ahmed Hassan</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-400 hover:text-gray-600" title="View Trends">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-gray-600" title="Download PDF">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-gray-600" title="Share">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Test Values Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">WBC</p>
                                            <p class="text-lg font-bold text-gray-900">7.2</p>
                                            <p class="text-xs text-gray-500">K/μL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Normal (4.0-11.0)</p>
                                </div>
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">RBC</p>
                                            <p class="text-lg font-bold text-gray-900">4.8</p>
                                            <p class="text-xs text-gray-500">M/μL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Normal (4.2-5.4)</p>
                                </div>
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Hemoglobin</p>
                                            <p class="text-lg font-bold text-gray-900">14.2</p>
                                            <p class="text-xs text-gray-500">g/dL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Normal (12.0-16.0)</p>
                                </div>
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Platelets</p>
                                            <p class="text-lg font-bold text-gray-900">285</p>
                                            <p class="text-xs text-gray-500">K/μL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Normal (150-400)</p>
                                </div>
                            </div>
                            
                            <!-- Doctor's Note -->
                            <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-user-md text-blue-600 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">Doctor's Note</p>
                                        <p class="text-sm text-blue-800 mt-1">All blood count parameters are within normal range. Continue current medication regimen.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lipid Panel -->
                        <div class="border border-gray-200 rounded-xl p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-heart text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-lg font-semibold text-gray-900">Lipid Panel</h3>
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Attention Needed</span>
                                        </div>
                                        <p class="text-gray-600 mt-1">Cairo Medical Lab - Ordered by Dr. Sarah Mohamed</p>
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            <span><i class="fas fa-calendar-alt mr-1"></i>Dec 10, 2024</span>
                                            <span><i class="fas fa-clock mr-1"></i>8:00 AM</span>
                                            <span><i class="fas fa-user-md mr-1"></i>Dr. Sarah Mohamed</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-chart-line"></i>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="p-2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Test Values Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Total Cholesterol</p>
                                            <p class="text-lg font-bold text-gray-900">185</p>
                                            <p class="text-xs text-gray-500">mg/dL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Desirable (&lt;200)</p>
                                </div>
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">HDL</p>
                                            <p class="text-lg font-bold text-gray-900">52</p>
                                            <p class="text-xs text-gray-500">mg/dL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Good (≥40)</p>
                                </div>
                                <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">LDL</p>
                                            <p class="text-lg font-bold text-gray-900">142</p>
                                            <p class="text-xs text-gray-500">mg/dL</p>
                                        </div>
                                        <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                                    </div>
                                    <p class="text-xs text-yellow-600 mt-2">Borderline High (100-159)</p>
                                </div>
                                <div class="p-4 bg-green-50 rounded-lg border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Triglycerides</p>
                                            <p class="text-lg font-bold text-gray-900">128</p>
                                            <p class="text-xs text-gray-500">mg/dL</p>
                                        </div>
                                        <i class="fas fa-check-circle text-green-500"></i>
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Normal (&lt;150)</p>
                                </div>
                            </div>
                            
                            <!-- Doctor's Recommendation -->
                            <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-lightbulb text-yellow-600 mt-1"></i>
                                    <div>
                                        <p class="text-sm font-medium text-yellow-900">Recommendation</p>
                                        <p class="text-sm text-yellow-800 mt-1">LDL cholesterol is slightly elevated. Consider dietary modifications and continue lipid-lowering medication. Recheck in 3 months.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Test Results -->
                        <div class="border border-orange-200 rounded-xl p-6 bg-orange-50">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                                        <i class="fas fa-clock text-orange-600"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <h3 class="text-lg font-semibold text-gray-900">Thyroid Function Panel</h3>
                                            <span class="px-2 py-1 bg-orange-200 text-orange-800 text-xs rounded-full">Pending</span>
                                        </div>
                                        <p class="text-gray-600 mt-1">Alpha Lab - Ordered by Dr. Mohamed Ali</p>
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            <span><i class="fas fa-calendar-alt mr-1"></i>Dec 18, 2024</span>
                                            <span><i class="fas fa-clock mr-1"></i>7:30 AM</span>
                                            <span><i class="fas fa-hourglass-half mr-1 text-orange-500"></i>Results expected in 1-2 days</span>
                                        </div>
                                        <p class="text-sm text-orange-700 mt-3">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Your blood sample has been collected. Results will be available soon and you'll be notified by email.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Historical Trends -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Test Result Trends</h2>
                        <p class="text-sm text-gray-600 mt-1">Track your health indicators over time</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            
                            <!-- Cholesterol Trend Chart Placeholder -->
                            <div class="border border-gray-200 rounded-xl p-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Cholesterol Levels (Last 6 Months)</h4>
                                <div class="h-40 bg-gray-50 rounded-lg flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-chart-line text-2xl mb-2"></i>
                                        <p class="text-sm">Chart visualization would go here</p>
                                        <p class="text-xs">Showing Total, HDL, and LDL trends</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Blood Sugar Trend Chart Placeholder -->
                            <div class="border border-gray-200 rounded-xl p-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-3">Blood Sugar Levels (Last 3 Months)</h4>
                                <div class="h-40 bg-gray-50 rounded-lg flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-chart-area text-2xl mb-2"></i>
                                        <p class="text-sm">Chart visualization would go here</p>
                                        <p class="text-xs">Showing fasting glucose trends</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="text-center mt-6">
                            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-chart-bar mr-2"></i>View Detailed Analytics
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection