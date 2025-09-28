@extends('layouts.app')
@section('title', 'Insurance Information - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Patient Sidebar -->
            @php
                $patient_name = auth()->user()->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad(auth()->id(), 3, '0', STR_PAD_LEFT);
                $patient_avatar = auth()->user()->avatar ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $current_page = 'insurance';
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'current_page' => $current_page,
            ])

            <!-- Insurance Content -->
            <main class="lg:w-3/4 w-full space-y-6">
                
                <!-- Page Header -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Insurance Information</h1>
                            <p class="text-gray-600 mt-1">Manage your insurance policies and coverage details</p>
                        </div>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Insurance
                            </button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                <i class="fas fa-upload mr-2"></i>Upload Card
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Primary Insurance -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Primary Insurance</h2>
                                <p class="text-sm text-gray-600 mt-1">Your main insurance coverage</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-sm rounded-full">Active</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-start space-x-6">
                            <!-- Insurance Card Visual -->
                            <div class="w-80 h-48 bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl p-6 text-white flex-shrink-0">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-lg font-bold">MedLife Insurance</h3>
                                        <p class="text-blue-200 text-sm">Comprehensive Health Plan</p>
                                    </div>
                                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-shield-alt text-white text-xl"></i>
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <div>
                                        <p class="text-blue-200 text-xs">Policy Number</p>
                                        <p class="font-mono text-sm">ML-2024-789456</p>
                                    </div>
                                    <div>
                                        <p class="text-blue-200 text-xs">Member ID</p>
                                        <p class="font-mono text-sm">{{ auth()->user()->name }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-end mt-4">
                                    <div>
                                        <p class="text-blue-200 text-xs">Valid Until</p>
                                        <p class="text-sm font-medium">12/2025</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-blue-200 text-xs">Group</p>
                                        <p class="text-sm">Corporate Plan</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Insurance Details -->
                            <div class="flex-1 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-700">Insurance Provider</h4>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">MedLife Insurance Company</p>
                                        <p class="text-sm text-gray-600">Customer Service: +20 2 1234 5678</p>
                                    </div>
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-700">Plan Type</h4>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">Premium Care Plus</p>
                                        <p class="text-sm text-gray-600">Comprehensive coverage</p>
                                    </div>
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-700">Effective Date</h4>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">January 1, 2024</p>
                                        <p class="text-sm text-gray-600">Renewed annually</p>
                                    </div>
                                    <div class="p-4 bg-gray-50 rounded-lg">
                                        <h4 class="text-sm font-medium text-gray-700">Deductible</h4>
                                        <p class="text-lg font-semibold text-gray-900 mt-1">EGP 1,000</p>
                                        <p class="text-sm text-gray-600">Annual deductible</p>
                                    </div>
                                </div>

                                <!-- Coverage Summary -->
                                <div class="p-4 bg-blue-50 rounded-lg">
                                    <h4 class="text-sm font-medium text-blue-900 mb-3">Coverage Summary</h4>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <p class="text-blue-700 font-medium">Consultations</p>
                                            <p class="text-blue-600">90% covered</p>
                                        </div>
                                        <div>
                                            <p class="text-blue-700 font-medium">Lab Tests</p>
                                            <p class="text-blue-600">80% covered</p>
                                        </div>
                                        <div>
                                            <p class="text-blue-700 font-medium">Medications</p>
                                            <p class="text-blue-600">70% covered</p>
                                        </div>
                                        <div>
                                            <p class="text-blue-700 font-medium">Emergency</p>
                                            <p class="text-blue-600">100% covered</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-3">
                                    <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                        <i class="fas fa-download mr-2"></i>Download Card
                                    </button>
                                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-edit mr-2"></i>Update Info
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secondary Insurance -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Secondary Insurance</h2>
                                <p class="text-sm text-gray-600 mt-1">Additional coverage for enhanced benefits</p>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm rounded-full">Pending</span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-plus text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Secondary Insurance</h3>
                            <p class="text-gray-600 mb-6">Add a secondary insurance policy for additional coverage and benefits.</p>
                            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Add Secondary Insurance
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Insurance Claims History -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Claims History</h2>
                                <p class="text-sm text-gray-600 mt-1">Track your insurance claims and reimbursements</p>
                            </div>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>Submit Claim
                            </button>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            
                            <!-- Approved Claim -->
                            <div class="flex items-center justify-between p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Consultation Claim - Dr. Ahmed Hassan</h3>
                                        <p class="text-sm text-gray-600">Claim #CLM-2024-001</p>
                                        <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                                            <span><i class="fas fa-calendar-alt mr-1"></i>Dec 15, 2024</span>
                                            <span><i class="fas fa-money-bill-alt mr-1"></i>EGP 300</span>
                                            <span class="text-green-600"><i class="fas fa-check mr-1"></i>Approved</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-green-700">EGP 270</p>
                                    <p class="text-xs text-gray-500">Reimbursed (90%)</p>
                                </div>
                            </div>

                            <!-- Processing Claim -->
                            <div class="flex items-center justify-between p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-clock text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Lab Tests Claim - Al-Mokhtabar</h3>
                                        <p class="text-sm text-gray-600">Claim #CLM-2024-002</p>
                                        <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                                            <span><i class="fas fa-calendar-alt mr-1"></i>Dec 12, 2024</span>
                                            <span><i class="fas fa-money-bill-alt mr-1"></i>EGP 450</span>
                                            <span class="text-yellow-600"><i class="fas fa-hourglass-half mr-1"></i>Processing</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-yellow-700">Under Review</p>
                                    <p class="text-xs text-gray-500">Expected: 3-5 days</p>
                                </div>
                            </div>

                            <!-- Rejected Claim -->
                            <div class="flex items-center justify-between p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-times-circle text-red-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Prescription Claim - Pharmacy Plus</h3>
                                        <p class="text-sm text-gray-600">Claim #CLM-2024-003</p>
                                        <div class="flex items-center space-x-4 mt-1 text-xs text-gray-500">
                                            <span><i class="fas fa-calendar-alt mr-1"></i>Dec 8, 2024</span>
                                            <span><i class="fas fa-money-bill-alt mr-1"></i>EGP 200</span>
                                            <span class="text-red-600"><i class="fas fa-times mr-1"></i>Rejected</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-red-700">Not Covered</p>
                                    <button class="text-xs text-blue-600 hover:text-blue-700 mt-1">Appeal Decision</button>
                                </div>
                            </div>

                        </div>

                        <!-- Claims Summary -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="text-center p-4 bg-blue-50 rounded-lg">
                                    <p class="text-2xl font-bold text-blue-600">12</p>
                                    <p class="text-sm text-blue-800">Total Claims</p>
                                </div>
                                <div class="text-center p-4 bg-green-50 rounded-lg">
                                    <p class="text-2xl font-bold text-green-600">9</p>
                                    <p class="text-sm text-green-800">Approved</p>
                                </div>
                                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                                    <p class="text-2xl font-bold text-yellow-600">2</p>
                                    <p class="text-sm text-yellow-800">Processing</p>
                                </div>
                                <div class="text-center p-4 bg-red-50 rounded-lg">
                                    <p class="text-2xl font-bold text-red-600">1</p>
                                    <p class="text-sm text-red-800">Rejected</p>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-6">
                            <button class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                                View All Claims History
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Insurance Network -->
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Insurance Network</h2>
                        <p class="text-sm text-gray-600 mt-1">Healthcare providers in your insurance network</p>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            
                            <!-- Network Hospital -->
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-hospital text-blue-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Cairo Medical Center</h3>
                                        <p class="text-xs text-gray-600">Premium Partner</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 mb-3">Full coverage for consultations, procedures, and emergency care.</p>
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">In-Network</span>
                                    <button class="text-xs text-blue-600 hover:text-blue-700">View Details</button>
                                </div>
                            </div>

                            <!-- Network Lab -->
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-flask text-green-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Al-Mokhtabar Labs</h3>
                                        <p class="text-xs text-gray-600">Diagnostic Partner</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 mb-3">80% coverage for all laboratory tests and diagnostic procedures.</p>
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">In-Network</span>
                                    <button class="text-xs text-blue-600 hover:text-blue-700">View Details</button>
                                </div>
                            </div>

                            <!-- Network Pharmacy -->
                            <div class="p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <div class="flex items-center space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-pills text-orange-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">Seif Pharmacy Chain</h3>
                                        <p class="text-xs text-gray-600">Pharmacy Partner</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-600 mb-3">70% coverage for generic medications, 50% for brand names.</p>
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">In-Network</span>
                                    <button class="text-xs text-blue-600 hover:text-blue-700">View Details</button>
                                </div>
                            </div>

                        </div>

                        <div class="text-center mt-6">
                            <button class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-search mr-2"></i>Find Network Providers
                            </button>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection