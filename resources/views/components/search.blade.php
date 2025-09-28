@php
use App\Models\Specialist;

// Get specialists from database
$specialists = Specialist::orderBy('special_name')->get();

// Get governorates from config
$governorates = config('governorates');
@endphp

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

    <form class="search-bar" action="{{ route('doctors.search') }}" method="GET" id="searchForm">
      <div class="input-group">
        <i class="fas fa-stethoscope"></i>
        <select id="specialtySelect" name="specialty">
          <option value="" disabled selected>Select a specialty</option>
          <optgroup label="Most Popular">
            @php
            $popularSpecialties = ['Cardiology', 'Pediatrics', 'Dermatology', 'Orthopedics', 'Neurology', 'Gynecology', 'ENT (Ear, Nose, Throat)', 'Psychiatry'];
            @endphp
            @foreach($specialists->whereIn('special_name', $popularSpecialties) as $specialist)
              <option value="{{ $specialist->special_name }}">{{ $specialist->special_name }}</option>
            @endforeach
          </optgroup>
          <optgroup label="Other Specialties">
            @foreach($specialists->whereNotIn('special_name', $popularSpecialties) as $specialist)
              <option value="{{ $specialist->special_name }}">{{ $specialist->special_name }}</option>
            @endforeach
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
            @foreach($governorates as $key => $governorate)
              @if(!in_array($key, ['cairo', 'giza', 'alexandria']))
                <option value="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $governorate)) }}</option>
              @endif
            @endforeach
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
      'alexandria': ['Sidi Gaber', 'Stanley', 'Smouha', 'Montaza', 'Miami', 'Cleopatra'],
      'assiut': ['Assiut City', 'New Assiut', 'Dayrout', 'Manfalout'],
      'sohag': ['Sohag City', 'Akhmim', 'Girga', 'Balyana'],
      'qena': ['Qena City', 'Qus', 'Nag Hammadi', 'Dishna'],
      'luxor': ['Luxor City', 'Esna', 'Armant'],
      'aswan': ['Aswan City', 'Kom Ombo', 'Edfu', 'Abu Simbel'],
      'beni suef': ['Beni Suef City', 'New Beni Suef', 'Nasser', 'Ihnasia'],
      'fayoum': ['Fayoum City', 'Tamiya', 'Sinnuris', 'Itsa'],
      'minya': ['Minya City', 'New Minya', 'Mallawi', 'Samalout'],
      'kafr el sheikh': ['Kafr El Sheikh City', 'Desuq', 'Fuwwah', 'Qallin'],
      'damietta': ['Damietta City', 'New Damietta', 'Kafr Saad', 'Faraskur'],
      'beheira': ['Damanhour', 'Kafr El Dawwar', 'Rashid', 'Edko'],
      'dakahlia': ['Mansoura', 'Mit Ghamr', 'Talkha', 'Dekernes'],
      'gharbia': ['Tanta', 'Mahalla El Kubra', 'Kafr El Zayat', 'Zefta'],
      'ismailia': ['Ismailia City', 'Fayed', 'Qantara East', 'Abu Suwir'],
      'monufia': ['Shibin El Kom', 'Menouf', 'Sadat City', 'Ashmoun'],
      'qalyubia': ['Banha', 'Shubra El Kheima', 'Qaha', 'Kafr Shokr'],
      'sharkia': ['Zagazig', 'Tenth of Ramadan', 'Bilbis', 'Faqous'],
      'port said': ['Port Said City', 'Port Fouad'],
      'suez': ['Suez City', 'Ain Sokhna', 'Faisal'],
      'north sinai': ['Arish', 'Sheikh Zuweid', 'Bir al-Abd', 'Rafah'],
      'south sinai': ['Sharm El Sheikh', 'Dahab', 'Nuweiba', 'Taba'],
      'red sea': ['Hurghada', 'Safaga', 'Qusier', 'Marsa Alam'],
      'new valley': ['Kharga', 'Dakhla', 'Farafra', 'Bahariya'],
      'matrouh': ['Marsa Matrouh', 'El Alamein', 'Dabaa', 'Sallum']
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