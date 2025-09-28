/**
 * Search API Integration for Vezeeta Home Page
 * This file provides JavaScript functions to interact with the search API endpoints
 */

class VezeetaSearchAPI {
    constructor() {
        this.baseUrl = '/api';
        this.specialties = [];
        this.cities = [];
        this.loadedData = false;
    }

    /**
     * Initialize the search functionality
     */
    async init() {
        try {
            await this.loadSpecialties();
            await this.loadCities();
            this.bindEvents();
            this.loadedData = true;
        } catch (error) {
            console.error('Failed to initialize search API:', error);
        }
    }

    /**
     * Load all specialties from API
     */
    async loadSpecialties() {
        try {
            const response = await fetch(`${this.baseUrl}/specialties`);
            const data = await response.json();
            
            if (data.success) {
                this.specialties = data.data;
                this.populateSpecialtySelect();
            }
        } catch (error) {
            console.error('Failed to load specialties:', error);
        }
    }

    /**
     * Load all cities from API
     */
    async loadCities() {
        try {
            const response = await fetch(`${this.baseUrl}/cities`);
            const data = await response.json();
            
            if (data.success) {
                this.cities = data.data;
                this.populateCitySelect();
            }
        } catch (error) {
            console.error('Failed to load cities:', error);
        }
    }

    /**
     * Populate specialty select dropdown
     */
    populateSpecialtySelect() {
        const specialtySelect = document.getElementById('specialtySelect');
        if (!specialtySelect) return;

        // Clear existing options except the first one
        const firstOption = specialtySelect.querySelector('option[disabled][selected]');
        specialtySelect.innerHTML = '';
        if (firstOption) {
            specialtySelect.appendChild(firstOption);
        }

        // Add popular specialties group
        const popularGroup = document.createElement('optgroup');
        popularGroup.label = 'Most Popular';
        
        const popularSpecialties = ['dermatology', 'psychiatry', 'pediatrics', 'neurology', 'orthopedics', 'gynaecology', 'ent', 'cardiology'];
        
        this.specialties.forEach(specialty => {
            const option = document.createElement('option');
            option.value = specialty.name.toLowerCase();
            option.textContent = specialty.name;
            
            if (popularSpecialties.includes(specialty.name.toLowerCase())) {
                popularGroup.appendChild(option);
            }
        });
        
        specialtySelect.appendChild(popularGroup);

        // Add other specialties group
        const otherGroup = document.createElement('optgroup');
        otherGroup.label = 'Other Specialties';
        
        this.specialties.forEach(specialty => {
            if (!popularSpecialties.includes(specialty.name.toLowerCase())) {
                const option = document.createElement('option');
                option.value = specialty.name.toLowerCase();
                option.textContent = specialty.name;
                otherGroup.appendChild(option);
            }
        });
        
        specialtySelect.appendChild(otherGroup);
    }

    /**
     * Populate city select dropdown
     */
    populateCitySelect() {
        const citySelect = document.getElementById('city-select');
        if (!citySelect) return;

        // Clear existing options except the first one
        const firstOption = citySelect.querySelector('option[disabled][selected]');
        citySelect.innerHTML = '';
        if (firstOption) {
            citySelect.appendChild(firstOption);
        }

        // Add "All Cities" option
        const allOption = document.createElement('option');
        allOption.value = 'all';
        allOption.textContent = 'All Cities';
        citySelect.appendChild(allOption);

        // Add popular cities group
        const popularGroup = document.createElement('optgroup');
        popularGroup.label = 'Most Popular';
        
        const popularCities = ['cairo', 'giza', 'alexandria'];
        
        this.cities.forEach(city => {
            if (popularCities.includes(city.value)) {
                const option = document.createElement('option');
                option.value = city.value;
                option.textContent = city.label;
                popularGroup.appendChild(option);
            }
        });
        
        citySelect.appendChild(popularGroup);

        // Add other cities group
        const otherGroup = document.createElement('optgroup');
        otherGroup.label = 'Other Cities';
        
        this.cities.forEach(city => {
            if (!popularCities.includes(city.value)) {
                const option = document.createElement('option');
                option.value = city.value;
                option.textContent = city.label;
                otherGroup.appendChild(option);
            }
        });
        
        citySelect.appendChild(otherGroup);
    }

    /**
     * Search doctors based on form data
     */
    async searchDoctors(searchParams) {
        try {
            const queryString = new URLSearchParams(searchParams).toString();
            const response = await fetch(`${this.baseUrl}/doctors/search?${queryString}`);
            const data = await response.json();
            
            return data;
        } catch (error) {
            console.error('Search failed:', error);
            return { success: false, error: error.message };
        }
    }

    /**
     * Get all doctors
     */
    async getAllDoctors(page = 1, perPage = 20) {
        try {
            const response = await fetch(`${this.baseUrl}/doctors?page=${page}&per_page=${perPage}`);
            const data = await response.json();
            
            return data;
        } catch (error) {
            console.error('Failed to get doctors:', error);
            return { success: false, error: error.message };
        }
    }

    /**
     * Get specific doctor
     */
    async getDoctor(id) {
        try {
            const response = await fetch(`${this.baseUrl}/doctors/${id}`);
            const data = await response.json();
            
            return data;
        } catch (error) {
            console.error('Failed to get doctor:', error);
            return { success: false, error: error.message };
        }
    }

    /**
     * Get doctor appointments
     */
    async getDoctorAppointments(doctorId, params = {}) {
        try {
            const queryString = new URLSearchParams(params).toString();
            const response = await fetch(`${this.baseUrl}/doctors/${doctorId}/appointments?${queryString}`);
            const data = await response.json();
            
            return data;
        } catch (error) {
            console.error('Failed to get appointments:', error);
            return { success: false, error: error.message };
        }
    }

    /**
     * Bind form events
     */
    bindEvents() {
        const searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.addEventListener('submit', this.handleFormSubmit.bind(this));
        }
    }

    /**
     * Handle form submission
     */
    async handleFormSubmit(event) {
        // Don't prevent default - let the form submit normally for now
        // You can uncomment the following lines to make it AJAX-based:
        
        /*
        event.preventDefault();
        
        const formData = new FormData(event.target);
        const searchParams = {};
        
        for (let [key, value] of formData.entries()) {
            if (value) searchParams[key] = value;
        }
        
        const results = await this.searchDoctors(searchParams);
        
        if (results.success) {
            this.displayResults(results.data);
        } else {
            console.error('Search failed:', results.error);
        }
        */
    }

    /**
     * Display search results (for AJAX implementation)
     */
    displayResults(results) {
        // Implement this method to display search results on the page
        console.log('Search results:', results);
    }
}

// Initialize the search API when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const searchAPI = new VezeetaSearchAPI();
    searchAPI.init();
    
    // Make it globally accessible
    window.vezeetaSearch = searchAPI;
});

// Example usage:
/*
// Search for doctors
const searchResults = await vezeetaSearch.searchDoctors({
    specialty: 'cardiology',
    city: 'cairo',
    query: 'heart specialist'
});

// Get specific doctor
const doctor = await vezeetaSearch.getDoctor(123);

// Get doctor appointments
const appointments = await vezeetaSearch.getDoctorAppointments(123, {
    date_from: '2025-09-28',
    status: 'available'
});
*/