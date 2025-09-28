@extends('layouts.app')
@section('title', 'Home - Vezeeta.com')

@section('content')

@include('components.alert')


<div class="top-section overflow-hidden">
  <div class="main">
    <div class="container">
      <h3>Better Healthcare for a Better Life</h3>
      <p class="p1">Book online or call <i class="fa-solid fa-phone text-danger"></i>
        16676</p>
      @include('components.search')
    </div>
  </div>
</div>

<div class="featured">
  <div class="container">
    <h5>Featured Doctors</h5>
    <div class="specialities mb-3 flex flex-wrap gap-2 my-5">
      <?php
      $specialities = [
        "All Specialities",
        "Dentistry",
        "Gastroenterology and Endoscopy",
        "Plastic Surgery",
        "Gynaecology and Infertility",
        "Dermatology",
        "General Surgery",
        "Psychiatry",
        "Orthopedics",
        "ENT",
        "Rheumatology",
        "Pediatric Surgery",
        "Vascular Surgery",
        "Oncology",
        "Nephrology",
        "Andrology And Male Infertility"
      ];

      foreach ($specialities as $speciality) {
        echo "<button class='filter-btn px-3 py-2 border border-blue-500 text-blue-500 rounded shadow-sm hover:bg-blue-500 hover:text-white cursor-pointer'>$speciality</button>";
      }
      ?>
    </div>

    <!-- هنا هيتولد الكروت -->
    <div id="doctors-list" class="flex flex-wrap gap-3"></div>
  </div>
</div>

<div class="carousel-container container my-10">
  <div class="flex justify-between items-center mb-3">
    <h4>Choose from top offers</h4>
    <a href="#" class="text-primary font-weight-bold">All Offers &gt;</a>
  </div>
  <div id="offersCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner flex justify-center">


      <div class="carousel-item active">
        <div class="flex">
          <!-- Card 1 -->
          <div class="offer-card mr-3">
            <span class="discount-badge">40% OFF</span>
            <img src="https://www.heritagedentalsanantonio.com/wp-content/uploads/2024/02/Heritage_FI.jpg" alt="Teeth Cleaning">
            <div class="offer-content">
              <p class="offer-title">Teeth Cleaning</p>
              <p>
                <span class="old-price">1500 EGP</span>
                <span class="new-price">900 EGP</span>
              </p>
              <p class="offers-count">94 Offers</p>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="offer-card mr-3">
            <span class="discount-badge">20% OFF</span>
            <img src="https://jadoreinstytut.com/wp-content/uploads/2020/12/Na-czym-polega-oczyszczanie-twarzy-u-kosmetyczki2.jpg" alt="Facial Cleansing">
            <div class="offer-content">
              <p class="offer-title">Facial Cleansing</p>
              <p>
                <span class="old-price">2000 EGP</span>
                <span class="new-price">1600 EGP</span>
              </p>
              <p class="offers-count">39 Offers</p>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="offer-card mr-3">
            <span class="discount-badge">20% OFF</span>
            <img src="https://straightsmile.ca/wp-content/uploads/2017/07/Traditional-metal-braces.jpg" alt="Metal Braces">
            <div class="offer-content">
              <p class="offer-title">Metal Braces</p>
              <p>
                <span class="old-price">10000 EGP</span>
                <span class="new-price">8000 EGP</span>
              </p>
              <p class="offers-count">3 Offers</p>
            </div>
          </div>

          <!-- Card 4 -->
          <div class="offer-card">
            <span class="discount-badge">20% OFF</span>
            <img src="https://www.drgmarks.co.za/wp-content/uploads/2017/02/084CCE28-3507-4387-AE72-6A0638798434.jpeg" alt="Face peeling">
            <div class="offer-content">
              <p class="offer-title">Face peeling</p>
              <p>
                <span class="old-price">2000 EGP</span>
                <span class="new-price">1600 EGP</span>
              </p>
              <p class="offers-count">4 Offers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Section: Top Specialties -->
<!-- Top Specialties -->
<div class="container my-5">
  <h4 class="mb-4">Book from top specialties</h4>
  <div class="flex justify-center gap-2">
    <div class="col-md-3 mb-3">
      <div class="specialty-card">
        <img src="https://assets.clevelandclinic.org/transform/78ec4257-9fdf-4be0-9f97-a53263613bdb/CC_HE_1248172109_ClearSkin_jpg" alt="Skin">
        <p>Skin</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="specialty-card">
        <img src="https://smile-dentalcare.co.uk/wp-content/uploads/teeth-whitening-after-treatment.jpg" alt="Teeth">
        <p>Teeth</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="specialty-card">
        <img src="https://sa1s3optim.patientpop.com/assets/images/provider/photos/2645292.jpg" alt="Mental">
        <p>Mental, Emotional or Behavioral</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="specialty-card">
        <img src="https://media.istockphoto.com/id/1357549139/photo/shot-of-an-adorable-baby-boy-wearing-a-hoody-towel.jpg?s=612x612&w=0&k=20&c=oAayvd2sgtE7QJu7WLNdPgtLQhFfTSXlZBef2KqmjUI=" alt="Child">
        <p>Child</p>
      </div>
    </div>
  </div>
</div>

<!-- Features -->
<div class="container my-5">
  <h4 class="mb-4">Why book with us?</h4>
  <div class="row">
    <div class="col-md-3 mb-3">
      <div class="feature-card">
        <h5>All your healthcare needs</h5>
        <p>Search and book a clinic visit, home visit, or a teleconsultation...</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="feature-card">
        <h5>Verified patient reviews</h5>
        <p>Doctor ratings are from patients who booked and visited...</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="feature-card">
        <h5>Your booking is confirmed</h5>
        <p>Your booking is automatically confirmed...</p>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="feature-card">
        <h5>Book for free, and pay in the clinic</h5>
        <p>The consultation fees stated on Vezeeta...</p>
      </div>
    </div>
  </div>
</div>

<script>
  // Array فيها بيانات الأطباء
  const doctors = [{
      name: "Mohamed Hassan",
      specialty: "Gynaecology and Infertility",
      location: "El-Haram",
      rating: "4.7",
      image: "https://snibbs.co/cdn/shop/articles/What_are_the_Challenges_of_Being_a_Doctor.jpg?v=1684314843"
    },
    {
      name: "Sara Ali",
      specialty: "Cardiology",
      location: "Nasr City",
      rating: "4.9",
      image: "https://img.freepik.com/free-photo/portrait-doctor_144627-39373.jpg"
    },
    {
      name: "Ahmed Tarek",
      specialty: "Neurology",
      location: "Dokki",
      rating: "4.8",
      image: " https://img.freepik.com/free-photo/smiling-female-doctor-white-coat-posing-camera_23-2147896179.jpg"
    },
    {
      name: "Laila Mahmoud",
      specialty: "Dermatology",
      location: "Maadi",
      rating: "4.6",
      image: "https://www.future-doctor.de/wp-content/uploads/2024/11/shutterstock_2173377961-1000x667.jpg"
    },
    {
      name: "Omar Farouk",
      specialty: "Orthopedics",
      location: "Heliopolis",
      rating: "4.9",
      image: "https://www.future-doctor.de/wp-content/uploads/2024/08/shutterstock_2480850611.jpg"
    },
    {
      name: "Nora Adel",
      specialty: "Pediatrics",
      location: "Giza",
      rating: "4.5",
      image: "https://s3-eu-west-1.amazonaws.com/intercare-web-public/wysiwyg-uploads%2F1580196666465-doctor.jpg"
    },
    {
      name: "Tamer Saeed",
      specialty: "ENT",
      location: "6th of October",
      rating: "4.7",
      image: "https://familydoctor.org/wp-content/uploads/2018/02/41808433_l.jpg"
    },
    {
      name: "Huda Magdy",
      specialty: "Psychiatry",
      location: "Nasr City",
      rating: "4.8",
      image: "https://www.yourfreecareertest.com/wp-content/uploads/2018/01/how_to_become_a_doctor.jpg"
    },
    {
      name: "Khaled Nabil",
      specialty: "Oncology",
      location: "Downtown Cairo",
      rating: "4.9",
      image: "https://www.liveabout.com/thmb/zNzhc9WxUE_lf6r3P0yuAfBaoV0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/doctor-with-stethoscope-in-hospital-642394515-5aa9a0b8a9d4f90037431454.jpg"
    },
    {
      name: "Yasmin Omar",
      specialty: "Plastic Surgery",
      location: "Zamalek",
      rating: "4.6",
      image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzEB9_L4Xz06sQsM8KBaOuS7XBqeBBuWBvugr4uaFeNlXmoEiU59nskHZJ_La6MEZvR2M&usqp=CAU"
    },
    {
      name: "Mostafa Ali",
      specialty: "General Surgery",
      location: "Shubra",
      rating: "4.7",
      image: "https://static.vecteezy.com/system/resources/thumbnails/026/375/249/small_2x/ai-generative-portrait-of-confident-male-doctor-in-white-coat-and-stethoscope-standing-with-arms-crossed-and-looking-at-camera-photo.jpg"
    },
    {
      name: "Rania Fathy",
      specialty: "Rheumatology",
      location: "Nasr City",
      rating: "4.5",
      image: "https://plus.unsplash.com/premium_photo-1664475450083-5c9eef17a191?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZmVtYWxlJTIwZG9jdG9yfGVufDB8fDB8fHww"
    },
    {
      name: "Hossam Eldin",
      specialty: "Vascular Surgery",
      location: "Mohandessin",
      rating: "4.8",
      image: "https://t3.ftcdn.net/jpg/04/43/33/46/360_F_443334611_LWOYm4T463bkhZD8wTojJdeEzQ40DUWX.jpg"
    },
    {
      name: "Mona Ashraf",
      specialty: "Nephrology",
      location: "New Cairo",
      rating: "4.9",
      image: "https://www.news-medical.net/images/Article_Images/ImageForArticle_21444_17237252394561665.jpg"
    },
    {
      name: "Salma Hany",
      specialty: "Allergy and Immunology",
      location: "Helwan",
      rating: "4.6",
      image: "https://assets.nautil.us/sites/3/nautilus/2KWTrHUH-French_BREAKER.png?auto=compress&fm=png&ixlib=php-3.3.1"
    },
    {
      name: "Adel Mansour",
      specialty: "Chest and Respiratory",
      location: "Shubra",
      rating: "4.7",
      image: "https://www.shutterstock.com/image-photo/healthcare-medical-staff-concept-portrait-600nw-2281024823.jpg"
    },
    {
      name: "Farida Youssef",
      specialty: "Family Medicine",
      location: "New Cairo",
      rating: "4.8",
      image: "https://t4.ftcdn.net/jpg/03/20/74/45/360_F_320744517_TaGkT7aRlqqWdfGUuzRKDABtFEoN5CiO.jpg"
    },
    {
      name: "Mahmoud Reda",
      specialty: "Diabetes and Endocrinology",
      location: "Nasr City",
      rating: "4.9",
      image: "https://www.shutterstock.com/image-photo/cheerful-middle-aged-chinese-male-600nw-2215576975.jpg"
    }
  ];

  // المكان اللي هيتحط فيه الكروت
  const container = document.getElementById("doctors-list");

  // لوب لعرض كل دكتور
  doctors.forEach(doc => {
    container.innerHTML += `
      <a href="#" class="doctor-card">
        <div class="card-image-container">
            <img src="${doc.image}" alt="${doc.name}">
            <span class="rating"><i class="fas fa-star" style= color:yellow;"></i> ${doc.rating}</span>
        </div>
        <div class="card-content">
            <h4 class="doctor-name">${doc.name}</h4>
            <p class="specialty">${doc.specialty}</p>
            <p class="location"><i class="fas fa-map-marker-alt"></i> ${doc.location}</p>
        </div>
      </a>
    `;
  });
</script>

@endsection