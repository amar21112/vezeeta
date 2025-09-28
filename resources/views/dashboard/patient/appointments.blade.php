@extends('layouts.app')
@section('title', 'My Appointments - Vezeeta')
@section('content')

    @include('components.alert')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            <!-- Patient Sidebar -->
            @php
                $patient_name = auth()->user()->name;
                $patient_id = '#PT-' . date('Y') . '-' . str_pad(auth()->id(), 3, '0', STR_PAD_LEFT);
                $patient_avatar =
                    auth()->user()->avatar ??
                    'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face';
                $current_page = 'appointments';
                $appointments_count = auth()->user()->appointments ? auth()->user()->appointments->count() : 0;
                $completed_appointments = auth()->user()->appointments
                    ? auth()->user()->appointments->where('status', 'completed')->count()
                    : 0;
            @endphp
            @include('components.patient-sidebar', [
                'patient_name' => $patient_name,
                'patient_id' => $patient_id,
                'patient_avatar' => $patient_avatar,
                'current_page' => $current_page,
            ])

            <!-- Appointments Content -->
            <main class="lg:w-3/4 w-full">
                <div class="bg-white rounded-xl shadow-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">My Appointments</h2>
                            <div class="flex space-x-2">
                                <a href="{{ route('vezeeta.index') }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Book New
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        @if ($appointments->count() > 0)
                            <div class="space-y-4">
                                @foreach ($appointments as $appointment)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-4">
                                                <!-- Doctor Avatar -->
                                                <div
                                                    class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                                                    <i class="fas fa-user-md text-blue-600 text-xl"></i>
                                                </div>

                                                <!-- Appointment Details -->
                                                <div>
                                                    <h3 class="font-semibold text-gray-900">
                                                        Dr. {{ $appointment->doctor->name ?? 'Unknown Doctor' }}
                                                    </h3>
                                                    <p class="text-sm text-gray-600">
                                                        {{ $appointment->doctor->specialty ?? 'General Practice' }}
                                                    </p>
                                                    <div class="flex items-center space-x-4 mt-2">
                                                        <span class="flex items-center text-sm text-gray-500">
                                                            <i class="fas fa-calendar mr-1"></i>
                                                            {{ $appointment->appointment->date ? \Carbon\Carbon::parse($appointment->appointment->date)->format('M j, Y') : 'Date TBD' }}
                                                        </span>
                                                        <span class="flex items-center text-sm text-gray-500">
                                                            <i class="fas fa-clock mr-1"></i>
                                                            {{ $appointment->appointment->time ?? 'Time TBD' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status & Actions -->
                                            <div class="flex items-center space-x-3">
                                                <!-- Status Badge -->
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-medium
                                                    @if ($appointment->status == 'booked') bg-blue-100 text-blue-800
                                                    @elseif($appointment->status == 'completed') bg-green-100 text-green-800
                                                    @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($appointment->status ?? 'pending') }}
                                                </span>

                                                <!-- Actions -->
                                                @if ($appointment->status == 'booked' && $appointment->appointment_date >= now()->format('Y-m-d'))
                                                    <div class="flex space-x-2">
                                                        <button onclick="rescheduleAppointment({{ $appointment->id }})"
                                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition-colors text-xs">
                                                            Reschedule
                                                        </button>
                                                        <form
                                                            action="{{ route('patient.appointments.cancel', $appointment->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                onclick="return confirm('Are you sure you want to cancel this appointment?')"
                                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-xs">
                                                                Cancel
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($appointment->notes)
                                            <div class="mt-3 pt-3 border-t border-gray-100">
                                                <p class="text-sm text-gray-600">
                                                    <i class="fas fa-sticky-note mr-1"></i>
                                                    {{ $appointment->notes }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination if needed -->
                            @if (method_exists($appointments, 'links'))
                                <div class="mt-6">
                                    {{ $appointments->links() }}
                                </div>
                            @endif
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-calendar-check text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900 mb-2">No Appointments Yet</h3>
                                <p class="text-gray-500 mb-6">You haven't booked any appointments yet. Start by finding a
                                    doctor.</p>
                                <a href="{{ route('vezeeta.index') }}"
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Book Your First Appointment
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Reschedule Modal -->
    <div id="rescheduleModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reschedule Appointment</h3>
                <form id="rescheduleForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select New Date & Time</label>
                        <select name="new_appointment_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                            <option value="">Choose available slot</option>
                            <!-- This would be populated dynamically -->
                        </select>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeRescheduleModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Reschedule
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function rescheduleAppointment(appointmentId) {
            const modal = document.getElementById('rescheduleModal');
            const form = document.getElementById('rescheduleForm');
            form.action = `/dashboard/patient/appointments/${appointmentId}/reschedule`;
            modal.classList.remove('hidden');
        }

        function closeRescheduleModal() {
            document.getElementById('rescheduleModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('rescheduleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRescheduleModal();
            }
        });
    </script>

@endsection
