<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Vezeeta Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #00d4aa;
            --primary-dark: #00b894;
            --secondary-color: #6c757d;
            --sidebar-bg: #2c3e50;
            --sidebar-text: #ecf0f1;
            --sidebar-hover: #34495e;
            --content-bg: #f8f9fa;
        }

        body {
            background-color: var(--content-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: var(--sidebar-bg);
            min-height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--sidebar-hover);
            text-align: center;
        }

        .sidebar-brand h4 {
            color: var(--primary-color);
            margin: 0;
            font-weight: 700;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-link {
            color: var(--sidebar-text);
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--sidebar-hover);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        .navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 2rem;
        }

        .content-wrapper {
            padding: 2rem;
            min-height: calc(100vh - 80px);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .card-header {
            background: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            text-align: center;
            padding: 2rem;
            border-radius: 15px;
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-pending {
            background-color: #ffeaa7;
            color: #fdcb6e;
        }

        .status-confirmed {
            background-color: #74b9ff;
            color: #0984e3;
        }

        .status-completed {
            background-color: #00b894;
            color: white;
        }

        .status-cancelled {
            background-color: #e17055;
            color: white;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        .dropdown-toggle::after {
            display: none;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-heartbeat"></i> Vezeeta</h4>
            <small class="!text-white">Admin Panel</small>
        </div>
        
        <div class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.patients*') ? 'active' : '' }}" href="{{ route('admin.patients') }}">
                        <i class="fas fa-users"></i>
                        Patients
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}" href="{{ route('admin.doctors') }}">
                        <i class="fas fa-user-md"></i>
                        Doctors
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.appointments*') ? 'active' : '' }}" href="{{ route('admin.appointments') }}">
                        <i class="fas fa-calendar-check"></i>
                        Appointments
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.specialists*') ? 'active' : '' }}" href="{{ route('admin.specialists.index') }}">
                        <i class="fas fa-stethoscope"></i>
                        Specialists
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}" href="{{ route('admin.reports') }}">
                        <i class="fas fa-chart-bar"></i>
                        Reports
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.admins*') ? 'active' : '' }}" href="{{ route('admin.admins') }}">
                        <i class="fas fa-user-shield"></i>
                        Admin Management
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                        <i class="fas fa-cogs"></i>
                        Settings
                    </a>
                </li>
                
                <hr class="my-3 text-muted">
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user-circle"></i>
                        Profile
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="btn btn-outline-primary sidebar-toggle me-3" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="flex-grow-1">
                <ol class="breadcrumb mb-0">
                    @yield('breadcrumb')
                </ol>
            </nav>

            <!-- User Menu -->
            <div class="dropdown">
                <button class="btn dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <div class="user-avatar me-2">
                        {{ substr(auth('admin')->user()->name, 0, 1) }}
                    </div>
                    <span>{{ auth('admin')->user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user-circle me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.settings') }}"><i class="fas fa-cogs me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Sidebar Toggle for Mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Auto-dismiss alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // CSRF Token for AJAX requests
        window.axios = axios;
        window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        }
    </script>

    @stack('scripts')
</body>
</html>