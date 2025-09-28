# Vezeeta Search API Documentation

## Overview
This document describes the new API endpoints and functionality added to support the home page search feature. The search system allows users to find doctors based on specialty, location, and other criteria.

## API Endpoints

### 1. Get All Specialties
**GET** `/api/specialties`

Returns all medical specialties available in the system.

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Cardiology"
        },
        {
            "id": 2,
            "name": "Dermatology"
        }
    ]
}
```

### 2. Get All Cities
**GET** `/api/cities`

Returns all available cities/governorates from the config file.

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "value": "cairo",
            "label": "Cairo"
        },
        {
            "value": "alexandria",
            "label": "Alexandria"
        }
    ]
}
```

### 3. Search Doctors
**GET** `/api/doctors/search`

Search for doctors with multiple filter options.

**Query Parameters:**
- `specialty` (string, optional): Specialty name or ID
- `city` (string, optional): City/governorate value
- `area` (string, optional): Specific area within city
- `query` (string, optional): Doctor name or hospital name
- `search_type` (string, optional): 'book_doctor' or 'telehealth'
- `telehealth_type` (string, optional): 'video', 'audio', or 'chat'
- `per_page` (integer, optional): Number of results per page (max 50)

**Example:** `/api/doctors/search?specialty=cardiology&city=cairo&per_page=10`

**Response:**
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Dr. Ahmed Hassan",
                "specialties": [
                    {
                        "id": 1,
                        "name": "Cardiology"
                    }
                ],
                "appointments": []
            }
        ],
        "total": 25,
        "per_page": 10
    },
    "filters_applied": {
        "specialty": "cardiology",
        "city": "cairo"
    }
}
```

### 4. Get All Doctors
**GET** `/api/doctors`

Get all active doctors with pagination.

**Query Parameters:**
- `per_page` (integer, optional): Number of results per page (default: 20)
- `page` (integer, optional): Page number

**Response:**
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "name": "Dr. Ahmed Hassan",
                "specialties": [],
                "appointments": []
            }
        ],
        "total": 100,
        "per_page": 20
    }
}
```

### 5. Get Specific Doctor
**GET** `/api/doctors/{id}`

Get detailed information about a specific doctor.

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Dr. Ahmed Hassan",
        "bio": "Experienced cardiologist...",
        "specialties": [
            {
                "id": 1,
                "name": "Cardiology"
            }
        ],
        "appointments": [
            {
                "id": 1,
                "date": "2025-09-29",
                "time": "10:00:00",
                "status": "available"
            }
        ]
    }
}
```

### 6. Get Doctor Appointments
**GET** `/api/doctors/{id}/appointments`

Get available appointments for a specific doctor.

**Query Parameters:**
- `date_from` (date, optional): Start date filter
- `date_to` (date, optional): End date filter
- `status` (string, optional): 'available', 'booked', or 'cancelled'

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "date": "2025-09-29",
            "time": "10:00:00",
            "status": "available"
        }
    ],
    "doctor_id": 1
}
```

## Page Routes

### 1. Enhanced Doctors Listing Page
**GET** `/doctors`

Enhanced doctors listing page that supports search parameters.

**Query Parameters:**
- Same as search API parameters
- Results are displayed in a paginated view

### 2. Enhanced Doctor Profile Page
**GET** `/doctor/{id}`

Enhanced doctor profile page showing detailed information and available appointments.

## JavaScript Integration

Include the search API JavaScript file in your pages:

```html
<script src="/assets/js/search-api.js"></script>
```

### Usage Examples:

```javascript
// Initialize the search API
const searchAPI = new VezeetaSearchAPI();
await searchAPI.init();

// Search for doctors
const results = await searchAPI.searchDoctors({
    specialty: 'cardiology',
    city: 'cairo',
    query: 'heart specialist'
});

// Get specific doctor
const doctor = await searchAPI.getDoctor(123);

// Get doctor appointments
const appointments = await searchAPI.getDoctorAppointments(123, {
    date_from: '2025-09-28',
    status: 'available'
});
```

## Search Component Integration

The search component in `resources/views/components/search.blade.php` can now be enhanced to use these APIs. The specialties and cities dropdowns can be populated dynamically from the API endpoints.

### Example Integration:

1. Include the search-api.js file
2. Initialize the API on page load
3. The API will automatically populate the specialty and city dropdowns
4. Form submissions can be handled via AJAX or traditional form submission

## Error Handling

All API endpoints return consistent error responses:

```json
{
    "success": false,
    "message": "Error description",
    "error": "Detailed error message"
}
```

## Database Requirements

Make sure your database has:
- `specialists` table with `id` and `name` columns
- `doctors` table with `is_active` column
- `appointments` table with proper relationships
- `doctor_specialists` pivot table for many-to-many relationship

## Testing

You can test the API endpoints by visiting:
- `/test-api` - Basic API status check
- `/api/specialties` - Test specialties endpoint
- `/api/cities` - Test cities endpoint
- `/api/doctors` - Test doctors listing

## Next Steps

1. Update your frontend search component to use the new APIs
2. Add proper error handling in your JavaScript
3. Implement loading states for better user experience
4. Add more advanced filters as needed
5. Implement proper search result display pages