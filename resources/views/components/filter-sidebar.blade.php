<div class="bg-white rounded-lg shadow-md p-6 h-fit">
  <!-- Filters Header -->
  <div class="flex items-center justify-between mb-6 bg-[#0070cd] -mx-6 -mt-6 py-2 rounded-t-lg">
    <h3 class="text-lg font-semibold text-white px-4 py-2 rounded flex items-center">
      <i class="fas fa-filter mr-2"></i>
      Filters
    </h3>
  </div>

  <!-- Title Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="title-filter">
      <div class="flex items-center">
        <i class="fas fa-user-md text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Title</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="title-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Professor</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Lecturer</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Consultant</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Specialist</span>
      </label>
    </div>
  </div>

  <!-- Sub Specialties Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="specialty-filter">
      <div class="flex items-center">
        <i class="fas fa-stethoscope text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Sub Specialties</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="specialty-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" checked class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">All</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Adult Dentistry</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Pediatric Dentistry</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Elder Dentistry</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Orthodontics</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Endodontics</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Cosmetic Dentistry</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Implantology</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Oral and Maxillofacial Surgery</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Periodontics</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Prosthodontics</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Oral Radiology</span>
      </label>
    </div>
  </div>

  <!-- Gender Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="gender-filter">
      <div class="flex items-center">
        <i class="fas fa-venus-mars text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Gender</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="gender-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Female</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Male</span>
      </label>
    </div>
  </div>

  <!-- Availability Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="availability-filter">
      <div class="flex items-center">
        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Availability</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="availability-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Any Day</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Today</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Tomorrow</span>
      </label>
    </div>
  </div>

  <!-- Promo Codes Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="promo-filter">
      <div class="flex items-center">
        <i class="fas fa-tag text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Promo Codes</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="promo-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Accept Promo Codes</span>
      </label>
    </div>
  </div>

  <!-- Examination Fee Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="fee-filter">
      <div class="flex items-center">
        <i class="fas fa-money-bill-wave text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Examination Fee</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="fee-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="radio" name="examination-fee" checked class="w-4 h-4 border border-gray-400 text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Any</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="radio" name="examination-fee" class="w-4 h-4 border border-gray-400 text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Less than 50</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="radio" name="examination-fee" class="w-4 h-4 border border-gray-400 text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">From 50 to 100</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="radio" name="examination-fee" class="w-4 h-4 border border-gray-400 text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">From 100 to 200</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="radio" name="examination-fee" class="w-4 h-4 border border-gray-400 text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">From 200 to 300</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="radio" name="examination-fee" class="w-4 h-4 border border-gray-400 text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Greater than 300</span>
      </label>
    </div>
  </div>

  <!-- Payment Methods Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="payment-filter">
      <div class="flex items-center">
        <i class="fas fa-credit-card text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Payment Methods</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="payment-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Accepts Online Payment</span>
      </label>
    </div>
  </div>

  <!-- Entity Filter -->
  <div class="mb-6">
    <div class="flex items-center justify-between cursor-pointer" data-collapse-toggle="entity-filter">
      <div class="flex items-center">
        <i class="fas fa-building text-blue-600 mr-2"></i>
        <span class="font-medium text-gray-700">Entity</span>
      </div>
      <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
    </div>
    <div id="entity-filter" class="mt-3 space-y-3">
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Hospital</span>
      </label>
      <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="w-4 h-4 border border-gray-400 rounded text-blue-600 focus:ring-blue-500 focus:ring-2">
        <span class="ml-3 text-sm text-gray-700">Clinic</span>
      </label>
    </div>
  </div>

  <!-- Clear Filters Button -->
  <button class="clear-filters w-full py-2 px-4 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 flex items-center justify-center">
    <i class="fas fa-times mr-2"></i>
    Clear All Filters
  </button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Handle collapsible sections
    const collapseToggles = document.querySelectorAll('[data-collapse-toggle]');

    collapseToggles.forEach(toggle => {
      const targetId = toggle.getAttribute('data-collapse-toggle');
      const targetElement = document.getElementById(targetId);
      const chevron = toggle.querySelector('.fa-chevron-down');

      // Ensure all sections are closed on page load
      if (targetElement) {
        targetElement.classList.add('hidden');
        chevron.style.transform = 'rotate(0deg)';
      }

      toggle.addEventListener('click', function() {
        if (targetElement.classList.contains('hidden')) {
          targetElement.classList.remove('hidden');
          chevron.style.transform = 'rotate(180deg)';
        } else {
          targetElement.classList.add('hidden');
          chevron.style.transform = 'rotate(0deg)';
        }
      });
    });
    // Handle clear all filters button
    const clearFiltersButton = document.querySelector('.clear-filters');
    clearFiltersButton.addEventListener('click', function() {
      // Uncheck all checkboxes
      const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach(checkbox => checkbox.checked = false);

      // Reset all radio buttons to default
      const radioGroups = document.querySelectorAll('input[type="radio"]');
      radioGroups.forEach(radio => {
        if (radio.defaultChecked) {
          radio.checked = true;
        }
      });
    });
  });
</script>