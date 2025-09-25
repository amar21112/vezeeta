<div class="search-section">
  <div class="container">
    <div class="search-tabs">
      <div class="tab active" id="bookDoctorTab">
        <button class="nav-link active" id="bookDoctorBtn">
          <i class="fas fa-user-md me-2"></i> Book a doctor
        </button>
        <p>Examination or procedure</p>
      </div>
      <div class="tab" id="telehealthTab">
        <button class="nav-link" id="telehealthBtn">
          <i class="fas fa-video me-2"></i> Telehealth
        </button>
        <p>Call consultation with doctor</p>
      </div>
    </div>

    <form class="search-bar" action="doctors" method="GET" id="searchForm">
      <div class="input-group">
        <i class="fas fa-stethoscope"></i>
        <select id="specialtySelect" name="specialty">
          <option value="" disabled selected>Select a specialty</option>
          <optgroup label="Most Popular">
            <option value="dermatology">Dermatology</option>
            <option value="psychiatry">Psychiatry</option>
            <option value="pediatrics">Pediatrics</option>
            <option value="neurology">Neurology</option>
            <option value="orthopedics">Orthopedics</option>
            <option value="gynaecology">Gynaecology</option>
            <option value="ent">ENT</option>
            <option value="cardiology">Cardiology and vascular disease</option>
          </optgroup>
          <optgroup label="Other Specialties">
            <option value="allergy">Allergy and Immunology (Sensitivity and Immunity)</option>
            <option value="andrology">Andrology and Male Infertility</option>
            <option value="audiology">Audiology</option>
            <option value="cardiology_thoracic">Cardiology and Thoracic Surgery (Heart & Chest)</option>
            <option value="chest_respiratory">Chest and Respiratory</option>
            <option value="diabetes_endocrinology">Diabetes and Endocrinology</option>
            <option value="diagnostic_radiology">Diagnostic Radiology (Scan Centers)</option>
            <option value="dietitian_nutrition">Dietitian and Nutrition</option>
            <option value="family_medicine">Family Medicine</option>
          </optgroup>
        </select>
      </div>

      <div class="input-group telehealth-only">
        <i class="fas fa-video"></i>
        <select id="telehealthType" name="telehealth_type">
          <option value="" disabled selected>Consultation type</option>
          <option value="video">Video Call</option>
          <option value="audio">Audio Call</option>
          <option value="chat">Chat</option>
        </select>
      </div>

      <div class="input-group location-group">
        <i class="fas fa-map-marker-alt"></i>
        <select name="city" id="city-select">
          <option value="" disabled selected>Choose City</option>
          <optgroup label="Most popular">
            <option value="all">All Cities</option>
            <option value="cairo">Cairo</option>
            <option value="giza">Giza</option>
            <option value="alexandria">Alexandria</option>
          </optgroup>
          <optgroup label="Other cities">
            <option value="asyut">Asyut</option>
            <option value="sohag">Sohag</option>
            <option value="qena">Qena</option>
            <option value="luxor">Luxor</option>
            <option value="aswan">Aswan</option>
            <option value="beni-suef">Beni Suef</option>
            <option value="fayoum">Fayoum</option>
            <option value="minya">Minya</option>
            <option value="kafr-elsheikh">Kafr El-Sheikh</option>
            <option value="damietta">Damietta</option>
          </optgroup>
        </select>
      </div>

      <div class="input-group location-group">
        <i class="fas fa-map-marker-alt"></i>
        <select name="area" id="area-select">
          <option value="" disabled selected>Choose area</option>
          <option value="all">All Areas</option>
        </select>
      </div>

      <div class="input-group location-group">
        <i class="fas fa-user-md"></i>
        <input type="text" name="query" placeholder="Doctor name or hospital...">
      </div>

      <button class="search-button" type="submit">
        <i class="fas fa-search"></i> Search
      </button>

      <!-- Hidden input to track search type -->
      <input type="hidden" name="search_type" id="searchTypeInput" value="book_doctor">
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const bookDoctorTab = document.getElementById('bookDoctorTab');
    const telehealthTab = document.getElementById('telehealthTab');
    const bookDoctorBtn = document.getElementById('bookDoctorBtn');
    const telehealthBtn = document.getElementById('telehealthBtn');
    const locationGroups = document.querySelectorAll('.location-group');
    const telehealthOnly = document.querySelector('.telehealth-only');
    const specialtySelect = document.getElementById('specialtySelect');

    const searchTypeInput = document.getElementById('searchTypeInput');
    const searchForm = document.getElementById('searchForm');

    // Check URL parameters to pre-fill the form
    const urlParams = new URLSearchParams(window.location.search);
    const specialtyParam = urlParams.get('specialty');
    const cityParam = urlParams.get('city');
    const areaParam = urlParams.get('area');
    const queryParam = urlParams.get('query');
    const telehealthTypeParam = urlParams.get('telehealth_type');
    const searchTypeParam = urlParams.get('search_type');

    // Pre-fill form fields if URL parameters exist
    if (specialtyParam) {
      const specialtyOption = Array.from(specialtySelect.options).find(option => option.value === specialtyParam);
      if (specialtyOption) {
        specialtyOption.selected = true;
      }
    }

    if (telehealthTypeParam) {
      const telehealthTypeSelect = document.getElementById('telehealthType');
      const telehealthOption = Array.from(telehealthTypeSelect.options).find(option => option.value === telehealthTypeParam);
      if (telehealthOption) {
        telehealthOption.selected = true;
      }
    }

    if (cityParam) {
      const citySelect = document.getElementById('city-select');
      const cityOption = Array.from(citySelect.options).find(option => option.value === cityParam);
      if (cityOption) {
        cityOption.selected = true;
        // Trigger change event to load areas
        const event = new Event('change');
        citySelect.dispatchEvent(event);

        // Select area if exists
        if (areaParam) {
          setTimeout(() => {
            const areaSelect = document.getElementById('area-select');
            const areaOption = Array.from(areaSelect.options).find(option => option.value === areaParam);
            if (areaOption) {
              areaOption.selected = true;
            }
          }, 100);
        }
      }
    }

    if (queryParam) {
      const queryInput = document.querySelector('input[name="query"]');
      if (queryInput) {
        queryInput.value = queryParam;
      }
    }

    // Activate correct tab based on search type
    if (searchTypeParam === 'telehealth' || telehealthTypeParam) {
      activateTelehealth();
    } else {
      activateBookDoctor();
    }

    function activateBookDoctor() {
      bookDoctorTab.classList.add('active');
      telehealthTab.classList.remove('active', 'telehealth-active');
      locationGroups.forEach(group => group.style.display = 'flex');
      telehealthOnly.style.display = 'none';
      specialtySelect.querySelector('option[disabled][selected]').textContent = 'Select a specialty';
      searchTypeInput.value = 'book_doctor';
    }

    function activateTelehealth() {
      telehealthTab.classList.add('active', 'telehealth-active');
      bookDoctorTab.classList.remove('active');
      locationGroups.forEach(group => group.style.display = 'none');
      telehealthOnly.style.display = 'flex';
      specialtySelect.querySelector('option[disabled][selected]').textContent = 'Select specialty for consultation';
      searchTypeInput.value = 'telehealth';
    }

    bookDoctorBtn.addEventListener('click', activateBookDoctor);
    telehealthBtn.addEventListener('click', activateTelehealth);
    bookDoctorTab.addEventListener('click', activateBookDoctor);
    telehealthTab.addEventListener('click', activateTelehealth);

    // Handle form submission
    searchForm.addEventListener('submit', function(e) {
      const specialty = document.getElementById('specialtySelect').value;
      const city = document.getElementById('city-select').value;
      const area = document.getElementById('area-select').value;
      const doctorName = document.querySelector('input[placeholder*="Doctor name"]').value;
      const telehealthType = document.getElementById('telehealthType').value;

      // Add loading state to search button
      const searchButton = document.querySelector('.search-button');
      const originalContent = searchButton.innerHTML;
      searchButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
      searchButton.disabled = true;

      // If no specialty is selected and it's required, prevent submission
      // if (!specialty && searchTypeInput.value === 'book_doctor') {
      //   e.preventDefault();
      //   // alert('Please select a specialty');
      //   searchButton.innerHTML = originalContent;
      //   searchButton.disabled = false;
      //   // return;
      // }

      // // For telehealth, check if consultation type is selected
      // if (searchTypeInput.value === 'telehealth' && !telehealthType) {
      //   e.preventDefault();
      //   // alert('Please select a consultation type');
      //   searchButton.innerHTML = originalContent;
      //   searchButton.disabled = false;
      //   // return;
      // }

      // Allow form to submit naturally
    });

    // Handle dynamic area loading based on city selection
    const citySelect = document.getElementById('city-select');
    const areaSelect = document.getElementById('area-select');

    const areasByCity = {
      'cairo': ['Nasr City', 'Heliopolis', 'Maadi', 'Zamalek', 'Downtown', 'New Cairo', 'Rehab', 'Tagamoa'],
      'giza': ['Dokki', 'Mohandessin', 'Agouza', 'Haram', '6th October', 'Sheikh Zayed'],
      'alexandria': ['Sidi Gaber', 'Stanley', 'Smouha', 'Montaza', 'Miami', 'Cleopatra']
    };

    citySelect.addEventListener('change', function() {
      const selectedCity = this.value;
      areaSelect.innerHTML = '<option value="" disabled selected>Choose area</option>';

      if (selectedCity === 'all') {
        areaSelect.innerHTML += '<option value="all">All Areas</option>';
      } else if (areasByCity[selectedCity]) {
        areaSelect.innerHTML += '<option value="all">All Areas in ' + this.options[this.selectedIndex].text + '</option>';
        areasByCity[selectedCity].forEach(area => {
          areaSelect.innerHTML += `<option value="${area.toLowerCase().replace(/\s+/g, '-')}">${area}</option>`;
        });
      }
    });
  });
</script>