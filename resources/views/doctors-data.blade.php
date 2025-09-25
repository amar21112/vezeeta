@php

/**
* Centralized doctors data - shared across all pages
* In a real application, this would come from a database
*/

// Function to get all doctors data
if(!function_exists('getAllDoctors')){
function getAllDoctors()
{
return [
1 => [
'id' => 1,
'name' => 'Mohamed Mostafa',
'title' => 'Doctor',
'image' => 'https://avatars.githubusercontent.com/u/116978549?v=4',
'rating' => 4.5,
'reviews_count' => 510,
'location' => 'Minia - Egypt',
'fees' => 200,
'waiting_time' => 21,
'call_cost' => 16676,
'about' => 'Dr. Mohamed Mostafa is a highly experienced dentist specializing in dental implants and cosmetic dentistry. With over 15 years of experience, he has helped thousands of patients achieve their perfect smile using the latest dental technologies and techniques.',
'specialties' => ['Dental Implants', 'Cosmetic Dentistry'],
'specialty' => 'Dental implants and cosmetic dentistry',
'badges' => ['Informative', 'Good Listener', 'Friendly'],
'promo' => null,
'symptoms_services' => ['Dental Implants', 'Veneers', 'Teeth Whitening', 'Cosmetic Fillings', 'Smile Makeover'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
2 => [
'id' => 2,
'name' => 'Mohamed Ayman',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Root Canal Treatment', 'Cosmetic Dentistry', 'Laser Surgery'],
'specialty' => 'Root Canal Treatment, Cosmetic Dentistry, Laser Surgery',
'rating' => 5,
'reviews_count' => 416,
'location' => 'Nasr City - Egypt Medical Center (EMC)',
'fees' => 400,
'waiting_time' => 13,
'call_cost' => 16676,
'badges' => ['Informative', 'Good Listener', 'Friendly'],
'promo' => '240 EGP with Shamel',
'about' => 'Dr. Mohamed Ayman is a renowned dental specialist with expertise in root canal treatments and laser dentistry. He holds advanced certifications in endodontics and has pioneered several minimally invasive dental procedures.',
'symptoms_services' => ['Root Canal', 'Laser Treatment', 'Pain Management', 'Dental Emergencies', 'Cosmetic Procedures'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
3 => [
'id' => 3,
'name' => 'Omar 3adel',
'title' => 'Professor',
'image' => 'https://plus.unsplash.com/premium_photo-1658506671316-0b293df7c72b?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
'specialties' => ['Orthodontics', 'Pediatric Dentistry'],
'specialty' => 'Orthodontics, Pediatric Dentistry',
'rating' => 4.0,
'reviews_count' => 892,
'location' => 'Heliopolis - Medical Plaza',
'fees' => 350,
'waiting_time' => 15,
'call_cost' => 16676,
'badges' => ['Experienced', 'Patient', 'Professional'],
'promo' => null,
'about' => 'Professor Omar 3adel is a leading orthodontist and pediatric dentist with over 20 years of experience. He specializes in treating children and adolescents, making dental care a comfortable and positive experience for young patients.',
'symptoms_services' => ['Braces', 'Invisalign', 'Pediatric Care', 'Teeth Alignment', 'Preventive Care'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
4 => [
'id' => 4,
'name' => 'Beshoy Saad',
'title' => 'Consultant',
'image' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Oral Surgery', 'Implantology'],
'specialty' => 'Oral Surgery, Implantology',
'rating' => 4.6,
'reviews_count' => 654,
'location' => 'Maadi - German Medical Center',
'fees' => 500,
'waiting_time' => 20,
'call_cost' => 16676,
'badges' => ['Expert', 'Careful', 'Reliable'],
'promo' => '150 EGP with Insurance',
'about' => 'Consultant Beshoy Saad is a distinguished oral surgeon and implantologist with extensive training in complex dental procedures. He has performed thousands of successful implant surgeries and is known for his precision and patient care.',
'symptoms_services' => ['Oral Surgery', 'Dental Implants', 'Wisdom Teeth', 'Jaw Surgery', 'Bone Grafting'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
5 => [
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
6 => [
'id' => 1,
'name' => 'Mohamed Mostafa',
'title' => 'Doctor',
'image' => 'https://avatars.githubusercontent.com/u/116978549?v=4',
'specialties' => ['Dental Implants', 'Cosmetic Dentistry'],
'specialty' => 'Dental implants and cosmetic dentistry',
'rating' => 4.5,
'reviews_count' => 510,
'location' => 'Minia - Egypt',
'fees' => 200,
'waiting_time' => 21,
'call_cost' => 16676,
'badges' => ['Informative', 'Good Listener', 'Friendly'],
'promo' => null,
'about' => 'Dr. Mohamed Mostafa is a highly experienced dentist specializing in dental implants and cosmetic dentistry. With over 15 years of experience, he has helped thousands of patients achieve their perfect smile using the latest dental technologies and techniques.',
'symptoms_services' => ['Dental Implants', 'Veneers', 'Teeth Whitening', 'Cosmetic Fillings', 'Smile Makeover'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
7 => [
'id' => 2,
'name' => 'Mohamed Ayman',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Root Canal Treatment', 'Cosmetic Dentistry', 'Laser Surgery'],
'specialty' => 'Root Canal Treatment, Cosmetic Dentistry, Laser Surgery',
'rating' => 5,
'reviews_count' => 416,
'location' => 'Nasr City - Egypt Medical Center (EMC)',
'fees' => 400,
'waiting_time' => 13,
'call_cost' => 16676,
'badges' => ['Informative', 'Good Listener', 'Friendly'],
'promo' => '240 EGP with Shamel',
'about' => 'Dr. Mohamed Ayman is a renowned dental specialist with expertise in root canal treatments and laser dentistry. He holds advanced certifications in endodontics and has pioneered several minimally invasive dental procedures.',
'symptoms_services' => ['Root Canal', 'Laser Treatment', 'Pain Management', 'Dental Emergencies', 'Cosmetic Procedures'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
8 => [
'id' => 3,
'name' => 'Omar 3adel',
'title' => 'Professor',
'image' => 'https://plus.unsplash.com/premium_photo-1658506671316-0b293df7c72b?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
'specialties' => ['Orthodontics', 'Pediatric Dentistry'],
'specialty' => 'Orthodontics, Pediatric Dentistry',
'rating' => 4.0,
'reviews_count' => 892,
'location' => 'Heliopolis - Medical Plaza',
'fees' => 350,
'waiting_time' => 15,
'call_cost' => 16676,
'badges' => ['Experienced', 'Patient', 'Professional'],
'promo' => null,
'about' => 'Professor Omar 3adel is a leading orthodontist and pediatric dentist with over 20 years of experience. He specializes in treating children and adolescents, making dental care a comfortable and positive experience for young patients.',
'symptoms_services' => ['Braces', 'Invisalign', 'Pediatric Care', 'Teeth Alignment', 'Preventive Care'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
9 => [
'id' => 4,
'name' => 'Beshoy Saad',
'title' => 'Consultant',
'image' => 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Oral Surgery', 'Implantology'],
'specialty' => 'Oral Surgery, Implantology',
'rating' => 4.6,
'reviews_count' => 654,
'location' => 'Maadi - German Medical Center',
'fees' => 500,
'waiting_time' => 20,
'call_cost' => 16676,
'badges' => ['Expert', 'Careful', 'Reliable'],
'promo' => '150 EGP with Insurance',
'about' => 'Consultant Beshoy Saad is a distinguished oral surgeon and implantologist with extensive training in complex dental procedures. He has performed thousands of successful implant surgeries and is known for his precision and patient care.',
'symptoms_services' => ['Oral Surgery', 'Dental Implants', 'Wisdom Teeth', 'Jaw Surgery', 'Bone Grafting'],
'appointments' => [
"23/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '10:00 AM', 'available' => true],
['time' => '11:00 AM', 'available' => false],
['time' => '2:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => true],
['time' => '4:00 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '9:00 AM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '3:00 PM', 'available' => false],
['time' => '4:00 PM', 'available' => true],
['time' => '5:00 PM', 'available' => true],
['time' => '6:00 PM', 'available' => true],
['time' => '7:00 PM', 'available' => true]
],
],
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
[
'id' => 5,
'name' => 'Mennatullah Mohamed',
'title' => 'Doctor',
'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop&crop=face',
'specialties' => ['Dermatology', 'Cosmetic Dermatology', 'Laser', 'Pediatric Dermatology'],
'specialty' => 'Consultant dermatologist and aesthetic',
'rating' => 4.0,
'reviews_count' => 7,
'location' => 'Tanta : Kornesh elmorshaha - The Second Side',
'fees' => 220,
'waiting_time' => 10,
'call_cost' => 16676,
'badges' => ['Book online', 'Pay at the clinic!'],
'about' => 'Dr. Mennatullah Mohamed -Consultant in dermatology, cosmetology and laser -American Board of Cosmetology and Laser Surgery -instagram@maissa_clinic -tick tock@dr.maissaalrefaey - facebook@maissa beauty clinic',
'symptoms_services' => ['Acne', 'Herpetic skin infection', 'Shingles', 'Flushing', 'Skin hives'],
'appointments' => [
"23/09/2025" => [
['time' => '11:00 AM', 'available' => true],
['time' => '11:30 AM', 'available' => true],
['time' => '12:00 PM', 'available' => true],
['time' => '12:30 PM', 'available' => true],
['time' => '1:00 PM', 'available' => true],
['time' => '1:30 PM', 'available' => true]
],
"24/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"25/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
],
"26/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true],
['time' => '10:00 PM', 'available' => true]
],
"27/09/2025" => [
['time' => '7:00 PM', 'available' => true],
['time' => '7:30 PM', 'available' => true],
['time' => '8:00 PM', 'available' => true],
['time' => '8:30 PM', 'available' => true],
['time' => '9:00 PM', 'available' => true],
['time' => '9:30 PM', 'available' => true]
]
]
],
];
}
}
// Function to get a specific doctor by ID
if(!function_exists('getDoctorById')){
function getDoctorById($doctorId)
{
$doctors = getAllDoctors();
return $doctors[$doctorId] ?? null;
}
}
// Function to simulate API call for doctor data
if(!function_exists('fetchDoctorData')){
function fetchDoctorData($doctorId)
{
// Simulate API delay
usleep(100000); // 0.1 seconds

// Get doctor from our data
$doctor = getDoctorById($doctorId);

if ($doctor) {
return [
'success' => true,
'data' => $doctor,
'message' => 'Doctor data retrieved successfully'
];
} else {
return [
'success' => false,
'data' => null,
'message' => 'Doctor not found'
];
}
}
}


// Function to search doctors by name, specialty, etc.
if(!function_exists('searchDoctors')){
function searchDoctors($query = '', $specialty = '', $location = '')
{
$doctors = getAllDoctors();
$results = [];

foreach ($doctors as $doctor) {
$match = true;

if ($query && !stripos($doctor['name'], $query) && !stripos($doctor['specialty'], $query)) {
$match = false;
}

if ($specialty && !in_array($specialty, $doctor['specialties'])) {
$match = false;
}

if ($location && !stripos($doctor['location'], $location)) {
$match = false;
}

if ($match) {
$results[] = $doctor;
}
}

return $results;
}
}
@endphp