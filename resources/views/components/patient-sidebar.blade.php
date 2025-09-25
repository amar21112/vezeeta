@php

/**
* Patient Dashboard Sidebar Component
* Displays patient profile navigation, user info, and statistics
*/

// Default values for patient data (can be overridden when including the component)
$patient_name = $patient_name ?? 'Ahmed Mohamed';
$patient_id = $patient_id ?? '#PT-2024-001';
$patient_avatar = $patient_avatar ?? 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
$appointments_count = $appointments_count ?? 12;
$completed_appointments = $completed_appointments ?? 8;
$current_page = $current_page ?? 'profile'; // profile, password, insurance, appointments, records, notifications

// Navigation menu items
$nav_items = [
'profile' => [
'icon' => 'fas fa-user',
'label' => 'Profile Information',
'url' => 'patient-profile.php'
],
'password' => [
'icon' => 'fas fa-lock',
'label' => 'Change Password',
'url' => 'change-password.php'
],
'insurance' => [
'icon' => 'fas fa-shield-halved',
'label' => 'My Insurance',
'url' => 'my-insurance.php'
],
'appointments' => [
'icon' => 'fas fa-calendar-check',
'label' => 'My Appointments',
'url' => 'my-appointments.php'
],
'records' => [
'icon' => 'fas fa-file-medical',
'label' => 'Medical Records',
'url' => 'medical-records.php'
],
'notifications' => [
'icon' => 'fas fa-bell',
'label' => 'Notifications',
'url' => 'notifications.php'
]
];
@endphp

<aside class="lg:w-1/4 w-full">
  <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
    <!-- User Avatar Section -->
    <div class="text-center mb-6">
      <div class="relative inline-block">
        <img src="<?php echo htmlspecialchars($patient_avatar); ?>"
          alt="Profile Picture"
          class="w-24 h-24 rounded-full mx-auto mb-3 border-4 border-blue-100 object-cover">
        <button class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 text-xs hover:bg-blue-700 transition-colors"
          onclick="openAvatarUpload()">
          <i class="fas fa-camera"></i>
        </button>
      </div>
      <h3 class="text-lg font-semibold text-gray-900"><?php echo htmlspecialchars($patient_name); ?></h3>
      <p class="text-sm text-gray-500">Patient ID: <?php echo htmlspecialchars($patient_id); ?></p>
    </div>

    <!-- Navigation Menu -->
    <nav class="space-y-2">
      <?php foreach ($nav_items as $key => $item): ?>
        <a href="<?php echo htmlspecialchars($item['url']); ?>"
          class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors
                  <?php echo ($current_page === $key) ? 'text-white bg-blue-600' : 'text-gray-700 hover:bg-gray-100'; ?>">
          <i class="<?php echo htmlspecialchars($item['icon']); ?> w-5 h-5"></i>
          <span><?php echo htmlspecialchars($item['label']); ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <!-- Account Stats -->
    <div class="mt-6 pt-6 border-t border-gray-200">
      <div class="grid grid-cols-2 gap-4 text-center">
        <div>
          <div class="text-2xl font-bold text-blue-600"><?php echo $appointments_count; ?></div>
          <div class="text-xs text-gray-500">Appointments</div>
        </div>
        <div>
          <div class="text-2xl font-bold text-green-600"><?php echo $completed_appointments; ?></div>
          <div class="text-xs text-gray-500">Completed</div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 pt-6 border-t border-gray-200">
      <h4 class="text-sm font-medium text-gray-700 mb-3">Quick Actions</h4>
      <div class="space-y-2">
        <button onclick="bookAppointment()"
          class="w-full flex items-center justify-center space-x-2 px-4 py-2 text-sm bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
          <i class="fas fa-plus"></i>
          <span>Book Appointment</span>
        </button>
        <button onclick="viewReports()"
          class="w-full flex items-center justify-center space-x-2 px-4 py-2 text-sm bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors">
          <i class="fas fa-file-alt"></i>
          <span>View Reports</span>
        </button>
      </div>
    </div>

    <!-- Support Section -->
    <div class="mt-6 pt-6 border-t border-gray-200">
      <div class="text-center">
        <p class="text-xs text-gray-500 mb-2">Need help?</p>
        <button onclick="contactSupport()"
          class="text-xs text-blue-600 hover:text-blue-800 underline">
          Contact Support
        </button>
      </div>
    </div>
  </div>
</aside>

<!-- Avatar Upload Modal (Hidden by default) -->
<div id="avatarModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4">
    <h3 class="text-lg font-semibold mb-4">Update Profile Picture</h3>
    <div class="space-y-4">
      <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
        <p class="text-sm text-gray-500">Drag and drop your photo here, or click to browse</p>
        <input type="file" accept="image/*" class="hidden" id="avatarInput">
        <button onclick="document.getElementById('avatarInput').click()"
          class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
          Choose Photo
        </button>
      </div>
      <div class="flex justify-end space-x-3">
        <button onclick="closeAvatarUpload()"
          class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
          Cancel
        </button>
        <button onclick="uploadAvatar()"
          class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
          Upload
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Sidebar component JavaScript functions
  function openAvatarUpload() {
    document.getElementById('avatarModal').classList.remove('hidden');
  }

  function closeAvatarUpload() {
    document.getElementById('avatarModal').classList.add('hidden');
  }

  function uploadAvatar() {
    const fileInput = document.getElementById('avatarInput');
    if (fileInput.files.length > 0) {
      // Simulate avatar upload
      console.log('Uploading avatar:', fileInput.files[0]);
      // Here you would typically send the file to your server

      // Show success message and close modal
      alert('Avatar updated successfully!');
      closeAvatarUpload();
    } else {
      alert('Please select a photo to upload.');
    }
  }

  function bookAppointment() {
    // Redirect to booking page or open booking modal
    window.location.href = '../../views/doctors.php';
  }

  function viewReports() {
    // Redirect to medical reports page
    console.log('Opening medical reports...');
    // window.location.href = 'medical-reports.php';
  }

  function contactSupport() {
    // Open support chat or redirect to support page
    console.log('Opening support...');
    // You could open a chat widget or redirect to support page
  }

  // Handle file input change for avatar preview
  document.getElementById('avatarInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        // Preview the image in the modal
        console.log('File selected:', file.name);
      };
      reader.readAsDataURL(file);
    }
  });
</script>