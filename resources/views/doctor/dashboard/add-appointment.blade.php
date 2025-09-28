@extends('doctor.dashboard.layout')
@section('title', 'Add Appointment Slots')
@section('page_title', 'Add New Appointment Slots')
@section('page_subtitle', 'Create available time slots for patients to book')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-xl font-semibold text-white">Create Appointment Slots</h3>
                        <p class="text-emerald-100 text-sm mt-1">Set your availability for patients to book appointments</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-plus text-white text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-red-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('doctor.appointments.store') }}" class="space-y-8">
                    @csrf

                    <!-- Price Setting -->
                    <div class="border-b border-gray-200 pb-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Consultation Fee</h4>
                        <div class="max-w-md">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Price per Appointment (₪) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">₪</span>
                                </div>
                                <input type="number" 
                                       name="price" 
                                       id="price"
                                       min="0" 
                                       max="30000" 
                                       step="0.01"
                                       class="appearance-none block w-full pl-8 pr-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm @error('price') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                       value="{{ old('price', 200) }}" 
                                       required
                                       placeholder="200">
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Set a competitive price for your consultation</p>
                        </div>
                    </div>

                    <!-- Date & Time Selection -->
                    <div class="space-y-6">
                        <h4 class="text-lg font-semibold text-gray-900">Available Slots</h4>
                        
                        <!-- Dynamic Appointment Slots -->
                        <div id="appointmentSlots" class="space-y-4">
                            <div class="appointment-slot border border-gray-200 rounded-lg p-6 bg-gray-50">
                                <div class="flex items-center justify-between mb-4">
                                    <h5 class="font-medium text-gray-900">Appointment Slot #1</h5>
                                    <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-800 transition-colors" style="display: none;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Date <span class="text-red-500">*</span>
                                        </label>
                                        <input type="date" 
                                               class="date-input appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                               min="{{ date('Y-m-d') }}" 
                                               required
                                               onchange="updateDateTime(this)">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Time <span class="text-red-500">*</span>
                                        </label>
                                        <input type="time" 
                                               class="time-input appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                               required
                                               onchange="updateDateTime(this)">
                                    </div>
                                </div>
                                
                                <!-- Hidden input to store combined datetime -->
                                <input type="hidden" class="datetime-combined" name="appointments[]">
                            </div>
                        </div>

                        <!-- Add More Slots Button -->
                        <button type="button" onclick="addNewSlot()" class="inline-flex items-center px-4 py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Add Another Time Slot
                        </button>
                    </div>

                    <!-- Quick Time Slot Generator -->
                    <div class="border-t border-gray-200 pt-8">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Quick Slot Generator</h4>
                        <p class="text-sm text-gray-600 mb-4">Generate multiple slots for a specific day with regular intervals</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-blue-50 rounded-lg">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                                <input type="date" id="quickDate" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm" min="{{ date('Y-m-d') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
                                <input type="time" id="quickStartTime" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="09:00">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
                                <input type="time" id="quickEndTime" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="17:00">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Interval (minutes)</label>
                                <select id="quickInterval" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="30">30 minutes</option>
                                    <option value="45">45 minutes</option>
                                    <option value="60">1 hour</option>
                                    <option value="90">1.5 hours</option>
                                    <option value="120">2 hours</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="button" onclick="generateQuickSlots()" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <i class="fas fa-magic mr-2"></i>
                            Generate Slots
                        </button>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="border-t border-gray-200 pt-8 flex justify-between items-center">
                        <a href="{{ route('doctor.appointments') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Appointments
                        </a>
                        
                        <div class="flex space-x-3">
                            <button type="button" onclick="previewSlots()" class="inline-flex items-center px-6 py-3 border border-emerald-600 text-emerald-600 font-medium rounded-lg hover:bg-emerald-50 transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                Preview
                            </button>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors" onclick="return validateForm()">
                                <i class="fas fa-save mr-2"></i>
                                Create Appointment Slots
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 max-h-96 overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Preview Appointment Slots</h3>
                <button onclick="hidePreview()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="previewContent" class="space-y-2"></div>
            <div class="mt-6 flex justify-end">
                <button onclick="hidePreview()" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium rounded-lg transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        let slotCount = 1;

        function addNewSlot() {
            slotCount++;
            const slotsContainer = document.getElementById('appointmentSlots');
            const newSlot = document.createElement('div');
            newSlot.className = 'appointment-slot border border-gray-200 rounded-lg p-6 bg-gray-50';
            newSlot.innerHTML = `
                <div class="flex items-center justify-between mb-4">
                    <h5 class="font-medium text-gray-900">Appointment Slot #${slotCount}</h5>
                    <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-800 transition-colors">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               class="date-input appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                               min="${new Date().toISOString().split('T')[0]}" 
                               required
                               onchange="updateDateTime(this)">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Time <span class="text-red-500">*</span>
                        </label>
                        <input type="time" 
                               class="time-input appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                               required
                               onchange="updateDateTime(this)">
                    </div>
                </div>
                
                <input type="hidden" class="datetime-combined" name="appointments[]">
            `;
            slotsContainer.appendChild(newSlot);
            
            // Show remove button for all slots when there's more than one
            updateRemoveButtons();
        }

        function removeSlot(button) {
            const slot = button.closest('.appointment-slot');
            slot.remove();
            updateRemoveButtons();
            updateSlotNumbers();
        }

        function updateRemoveButtons() {
            const slots = document.querySelectorAll('.appointment-slot');
            const removeButtons = document.querySelectorAll('.appointment-slot button[onclick*="removeSlot"]');
            
            removeButtons.forEach(button => {
                button.style.display = slots.length > 1 ? 'block' : 'none';
            });
        }

        function updateSlotNumbers() {
            const slots = document.querySelectorAll('.appointment-slot h5');
            slots.forEach((title, index) => {
                title.textContent = `Appointment Slot #${index + 1}`;
            });
        }

        function updateDateTime(input) {
            const slot = input.closest('.appointment-slot');
            const dateInput = slot.querySelector('.date-input');
            const timeInput = slot.querySelector('.time-input');
            const hiddenInput = slot.querySelector('.datetime-combined');
            
            if (dateInput.value && timeInput.value) {
                hiddenInput.value = `${dateInput.value}T${timeInput.value}`;
            }
        }

        function generateQuickSlots() {
            const date = document.getElementById('quickDate').value;
            const startTime = document.getElementById('quickStartTime').value;
            const endTime = document.getElementById('quickEndTime').value;
            const interval = parseInt(document.getElementById('quickInterval').value);
            
            if (!date || !startTime || !endTime) {
                alert('Please fill in all quick generator fields');
                return;
            }
            
            const start = new Date(`${date}T${startTime}`);
            const end = new Date(`${date}T${endTime}`);
            
            if (start >= end) {
                alert('End time must be after start time');
                return;
            }
            
            // Clear existing slots
            const slotsContainer = document.getElementById('appointmentSlots');
            slotsContainer.innerHTML = '';
            slotCount = 0;
            
            const current = new Date(start);
            while (current < end) {
                slotCount++;
                const dateStr = current.toISOString().split('T')[0];
                const timeStr = current.toTimeString().split(' ')[0].substring(0, 5);
                
                const newSlot = document.createElement('div');
                newSlot.className = 'appointment-slot border border-gray-200 rounded-lg p-6 bg-gray-50';
                newSlot.innerHTML = `
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="font-medium text-gray-900">Appointment Slot #${slotCount}</h5>
                        <button type="button" onclick="removeSlot(this)" class="text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   class="date-input appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                   value="${dateStr}"
                                   min="${new Date().toISOString().split('T')[0]}" 
                                   required
                                   onchange="updateDateTime(this)">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Time <span class="text-red-500">*</span>
                            </label>
                            <input type="time" 
                                   class="time-input appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                                   value="${timeStr}"
                                   required
                                   onchange="updateDateTime(this)">
                        </div>
                    </div>
                    
                    <input type="hidden" class="datetime-combined" name="appointments[]" value="${dateStr}T${timeStr}">
                `;
                slotsContainer.appendChild(newSlot);
                
                current.setMinutes(current.getMinutes() + interval);
            }
            
            updateRemoveButtons();
        }

        function previewSlots() {
            const slots = document.querySelectorAll('.datetime-combined');
            const price = document.getElementById('price').value;
            const previewContent = document.getElementById('previewContent');
            
            previewContent.innerHTML = '';
            
            if (!price) {
                alert('Please set a price first');
                return;
            }
            
            const validSlots = Array.from(slots).filter(slot => slot.value);
            
            if (validSlots.length === 0) {
                previewContent.innerHTML = '<p class="text-gray-500">No valid slots to preview</p>';
            } else {
                previewContent.innerHTML = `
                    <div class="mb-4 p-3 bg-emerald-50 rounded-lg">
                        <p class="font-medium text-emerald-800">Consultation Fee: ₪${price}</p>
                        <p class="text-sm text-emerald-600">${validSlots.length} slots will be created</p>
                    </div>
                `;
                
                validSlots.forEach((slot, index) => {
                    const datetime = new Date(slot.value);
                    const dateStr = datetime.toLocaleDateString();
                    const timeStr = datetime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    
                    previewContent.innerHTML += `
                        <div class="flex justify-between items-center p-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Slot ${index + 1}</span>
                            <span class="text-sm font-medium">${dateStr} at ${timeStr}</span>
                        </div>
                    `;
                });
            }
            
            document.getElementById('previewModal').classList.remove('hidden');
            document.getElementById('previewModal').classList.add('flex');
        }

        function hidePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewModal').classList.remove('flex');
        }

        // Initialize first slot datetime combination
        document.addEventListener('DOMContentLoaded', function() {
            updateRemoveButtons();
        });

        // Validate form before submission
        function validateForm() {
            const hiddenInputs = document.querySelectorAll('.datetime-combined');
            const price = document.getElementById('price').value;
            
            if (!price || price <= 0) {
                alert('Please set a valid price');
                return false;
            }
            
            let validSlots = 0;
            hiddenInputs.forEach(input => {
                if (input.value && input.value.includes('T')) {
                    validSlots++;
                }
            });
            
            if (validSlots === 0) {
                alert('Please add at least one complete appointment slot (both date and time)');
                return false;
            }
            
            // Remove empty hidden inputs to avoid validation errors
            hiddenInputs.forEach(input => {
                if (!input.value || !input.value.includes('T')) {
                    input.remove();
                }
            });
            
            return true;
        }
    </script>
@endsection