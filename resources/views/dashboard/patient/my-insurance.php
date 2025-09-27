<?php
$page_title = 'My Insurance - Vezeeta';
include_once('../../components/header.php');
?>

<body class="bg-gray-50">
  <!-- Breadcrumb -->
  <div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center space-x-2 py-3 text-sm text-gray-600">
        <a href="<?php echo $ROOT_PATH; ?>" class="text-blue-600 hover:text-blue-800">Vezeeta</a>
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        <a href="patient-profile.php" class="text-blue-600 hover:text-blue-800">Patient Profile</a>
        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
        <span class="text-gray-800">My Insurance</span>
      </div>
    </div>
  </div>

  <!-- Main Container -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex flex-col lg:flex-row gap-6">

      <!-- Include Patient Sidebar Component -->
      <?php
      // Set sidebar data
      $patient_name = 'Ahmed Mohamed';
      $patient_id = '#PT-2024-001';
      $patient_avatar = 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
      $appointments_count = 12;
      $completed_appointments = 8;
      $current_page = 'insurance'; // This will highlight the Insurance menu item
      
      // Include the sidebar component
      include_once('../../components/patient-sidebar.php');
      ?>

      <!-- Main Content -->
      <main class="lg:w-3/4 w-full">
        <div class="bg-white rounded-xl shadow-lg">
          <!-- Header -->
          <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
              <h2 class="text-xl font-semibold text-gray-900">My Insurance</h2>
              <button class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Add Insurance
              </button>
            </div>
          </div>

          <!-- Insurance Cards -->
          <div class="p-6 space-y-6">
            
            <!-- Active Insurance Card -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-6 text-white">
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-lg font-semibold mb-2">Primary Insurance</h3>
                  <p class="text-blue-100">Medical Insurance Company</p>
                  <p class="text-sm text-blue-200">Policy Number: MIC-2024-456789</p>
                </div>
                <div class="text-right">
                  <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">Active</span>
                  <p class="text-sm text-blue-200 mt-2">Valid until: Dec 2025</p>
                </div>
              </div>
              <div class="mt-4 pt-4 border-t border-blue-500">
                <div class="grid grid-cols-3 gap-4 text-center">
                  <div>
                    <p class="text-2xl font-bold">85%</p>
                    <p class="text-xs text-blue-200">Coverage</p>
                  </div>
                  <div>
                    <p class="text-2xl font-bold">$500</p>
                    <p class="text-xs text-blue-200">Deductible</p>
                  </div>
                  <div>
                    <p class="text-2xl font-bold">$2,000</p>
                    <p class="text-xs text-blue-200">Max Coverage</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Secondary Insurance -->
            <div class="border border-gray-200 rounded-xl p-6">
              <div class="flex justify-between items-start">
                <div>
                  <h3 class="text-lg font-semibold text-gray-900 mb-2">Secondary Insurance</h3>
                  <p class="text-gray-600">Health Plus Insurance</p>
                  <p class="text-sm text-gray-500">Policy Number: HPI-2024-123456</p>
                </div>
                <div class="text-right">
                  <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-xs">Pending</span>
                  <p class="text-sm text-gray-500 mt-2">Expires: Jun 2025</p>
                </div>
              </div>
              <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="grid grid-cols-3 gap-4 text-center">
                  <div>
                    <p class="text-2xl font-bold text-gray-900">60%</p>
                    <p class="text-xs text-gray-500">Coverage</p>
                  </div>
                  <div>
                    <p class="text-2xl font-bold text-gray-900">$300</p>
                    <p class="text-xs text-gray-500">Deductible</p>
                  </div>
                  <div>
                    <p class="text-2xl font-bold text-gray-900">$1,500</p>
                    <p class="text-xs text-gray-500">Max Coverage</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Insurance Usage Statistics -->
            <div class="bg-gray-50 rounded-xl p-6">
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Usage This Year</h3>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 text-center">
                  <i class="fas fa-dollar-sign text-2xl text-blue-600 mb-2"></i>
                  <p class="text-2xl font-bold text-gray-900">$1,250</p>
                  <p class="text-sm text-gray-500">Total Claims</p>
                </div>
                <div class="bg-white rounded-lg p-4 text-center">
                  <i class="fas fa-file-medical text-2xl text-green-600 mb-2"></i>
                  <p class="text-2xl font-bold text-gray-900">8</p>
                  <p class="text-sm text-gray-500">Claims Filed</p>
                </div>
                <div class="bg-white rounded-lg p-4 text-center">
                  <i class="fas fa-percentage text-2xl text-orange-600 mb-2"></i>
                  <p class="text-2xl font-bold text-gray-900">62%</p>
                  <p class="text-sm text-gray-500">Coverage Used</p>
                </div>
              </div>
            </div>

            <!-- Recent Claims -->
            <div>
              <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Claims</h3>
              <div class="space-y-3">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                  <div class="flex items-center space-x-3">
                    <i class="fas fa-stethoscope text-blue-600"></i>
                    <div>
                      <p class="font-medium text-gray-900">General Checkup</p>
                      <p class="text-sm text-gray-500">Dr. Ahmed Hassan • Sep 15, 2025</p>
                    </div>
                  </div>
                  <div class="text-right">
                    <p class="font-medium text-gray-900">$150</p>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Approved</span>
                  </div>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                  <div class="flex items-center space-x-3">
                    <i class="fas fa-x-ray text-blue-600"></i>
                    <div>
                      <p class="font-medium text-gray-900">X-Ray Examination</p>
                      <p class="text-sm text-gray-500">City Medical Center • Sep 10, 2025</p>
                    </div>
                  </div>
                  <div class="text-right">
                    <p class="font-medium text-gray-900">$200</p>
                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">Processing</span>
                  </div>
                </div>
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                  <div class="flex items-center space-x-3">
                    <i class="fas fa-pills text-blue-600"></i>
                    <div>
                      <p class="font-medium text-gray-900">Prescription Medications</p>
                      <p class="text-sm text-gray-500">Al-Ezaby Pharmacy • Sep 5, 2025</p>
                    </div>
                  </div>
                  <div class="text-right">
                    <p class="font-medium text-gray-900">$75</p>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Approved</span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>

    </div>
  </div>

</body>