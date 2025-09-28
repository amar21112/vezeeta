@extends('admin.layouts.app')

@section('title', 'Reports & Analytics')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Statistics Overview -->
    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #00d4aa, #00b894);">
                <div class="stats-number">{{ $appointmentsByStatus->sum() }}</div>
                <div class="stats-label">
                    <i class="fas fa-calendar-check me-2"></i>Total Appointments
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #74b9ff, #0984e3);">
                <div class="stats-number">{{ $appointmentsByStatus->get('completed', 0) }}</div>
                <div class="stats-label">
                    <i class="fas fa-check-circle me-2"></i>Completed
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #fdcb6e, #e17055);">
                <div class="stats-number">{{ $appointmentsByStatus->get('pending', 0) }}</div>
                <div class="stats-label">
                    <i class="fas fa-clock me-2"></i>Pending
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="stats-card" style="background: linear-gradient(135deg, #e17055, #d63031);">
                <div class="stats-number">{{ $appointmentsByStatus->get('cancelled', 0) }}</div>
                <div class="stats-label">
                    <i class="fas fa-times-circle me-2"></i>Cancelled
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Monthly Appointments Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>Monthly Appointments ({{ date('Y') }})
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Appointment Status Distribution -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Status Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" width="300" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Specialists -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Top Specialists by Doctor Count
                    </h5>
                </div>
                <div class="card-body">
                    @if($topSpecialists->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Specialist</th>
                                        <th>Doctors Count</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topSpecialists as $specialist)
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>{{ $specialist->special_name }}</td>
                                        <td>{{ $specialist->doctors_count }}</td>
                                        <td>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-primary" 
                                                     style="width: {{ ($specialist->doctors_count / $topSpecialists->max('doctors_count')) * 100 }}%">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No data available</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Monthly Appointments Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyData = @json($monthlyAppointments);

// Fill missing months with 0
const fullMonthlyData = [];
for (let i = 1; i <= 12; i++) {
    fullMonthlyData.push(monthlyData[i] || 0);
}

new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Appointments',
            data: fullMonthlyData,
            borderColor: '#00d4aa',
            backgroundColor: 'rgba(0, 212, 170, 0.1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Status Distribution Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusData = @json($appointmentsByStatus);

new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Confirmed', 'Completed', 'Cancelled'],
        datasets: [{
            data: [
                statusData.pending || 0,
                statusData.confirmed || 0,
                statusData.completed || 0,
                statusData.cancelled || 0
            ],
            backgroundColor: [
                '#fdcb6e',
                '#74b9ff',
                '#00d4aa',
                '#e17055'
            ],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endpush