@extends('admin.layouts.app')

@section('title', 'System Settings')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- System Information -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>System Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4"><strong>Application:</strong></div>
                        <div class="col-8">Vezeeta Admin Panel</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Version:</strong></div>
                        <div class="col-8">1.0.0</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Framework:</strong></div>
                        <div class="col-8">Laravel {{ app()->version() }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>PHP Version:</strong></div>
                        <div class="col-8">{{ PHP_VERSION }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Environment:</strong></div>
                        <div class="col-8">
                            <span class="badge {{ app()->environment('production') ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst(app()->environment()) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Timezone:</strong></div>
                        <div class="col-8">{{ config('app.timezone') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Database Information -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-database me-2"></i>Database Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4"><strong>Connection:</strong></div>
                        <div class="col-8">{{ config('database.default') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Database:</strong></div>
                        <div class="col-8">{{ config('database.connections.' . config('database.default') . '.database') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Host:</strong></div>
                        <div class="col-8">{{ config('database.connections.' . config('database.default') . '.host') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Port:</strong></div>
                        <div class="col-8">{{ config('database.connections.' . config('database.default') . '.port') }}</div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4"><strong>Status:</strong></div>
                        <div class="col-8">
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Connected
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-tools me-2"></i>System Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-broom fa-2x text-warning mb-2"></i>
                                    <h6>Clear Cache</h6>
                                    <p class="text-muted small">Clear application cache to improve performance</p>
                                    <button class="btn btn-warning btn-sm" onclick="clearCache()">
                                        <i class="fas fa-broom me-1"></i>Clear Cache
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-sync-alt fa-2x text-info mb-2"></i>
                                    <h6>Optimize</h6>
                                    <p class="text-muted small">Optimize the application for better performance</p>
                                    <button class="btn btn-info btn-sm" onclick="optimizeApp()">
                                        <i class="fas fa-sync-alt me-1"></i>Optimize
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-download fa-2x text-success mb-2"></i>
                                    <h6>Backup</h6>
                                    <p class="text-muted small">Create a backup of the database</p>
                                    <button class="btn btn-success btn-sm" onclick="createBackup()">
                                        <i class="fas fa-download me-1"></i>Backup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Files -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt me-2"></i>Recent System Logs
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Log files are stored in <code>storage/logs/</code> directory. 
                        Monitor these logs for system errors and important information.
                    </div>
                    
                    <div class="text-center py-4">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Log Viewer</h5>
                        <p class="text-muted">Log viewing functionality can be implemented here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function clearCache() {
    if (confirm('Are you sure you want to clear the application cache?')) {
        // Implement cache clearing functionality
        alert('Cache clearing functionality would be implemented here');
    }
}

function optimizeApp() {
    if (confirm('Are you sure you want to optimize the application?')) {
        // Implement optimization functionality
        alert('App optimization functionality would be implemented here');
    }
}

function createBackup() {
    if (confirm('Are you sure you want to create a database backup?')) {
        // Implement backup functionality
        alert('Database backup functionality would be implemented here');
    }
}
</script>
@endpush