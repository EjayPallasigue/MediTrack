@props(['title' => 'Dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MediTrack') }} — {{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: #f8f9fc;
                color: #2c3e50;
            }

            .dashboard-container {
                display: flex;
                min-height: 100vh;
            }

            /* Sidebar */
            .sidebar {
                width: 260px;
                background: linear-gradient(180deg, #b8563b 0%, #a04d35 100%);
                color: white;
                padding: 0;
                position: fixed;
                height: 100vh;
                overflow-y: auto;
                box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            }

            .sidebar-header {
                padding: 25px 20px;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                display: flex;
                align-items: center;
                gap: 12px;
            }

            .sidebar-logo {
                width: 40px;
                height: 40px;
                background: rgba(255,255,255,0.15);
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-logo svg {
                width: 24px;
                height: 24px;
                fill: white;
            }

            .sidebar-title {
                font-size: 20px;
                font-weight: 700;
                letter-spacing: 1px;
            }

            .nav-menu {
                list-style: none;
                padding: 20px 0;
            }

            .nav-item {
                margin-bottom: 5px;
            }

            .nav-link {
                display: flex;
                align-items: center;
                padding: 15px 20px;
                color: white;
                text-decoration: none;
                transition: all 0.3s ease;
                position: relative;
                gap: 12px;
                font-weight: 500;
            }

            .nav-link:hover, .nav-link.active {
                background: rgba(255,255,255,0.15);
                padding-left: 25px;
            }

            .nav-link.active::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                bottom: 0;
                width: 4px;
                background: white;
            }

            .nav-icon {
                width: 20px;
                height: 20px;
                fill: currentColor;
            }

            .user-info {
                position: absolute;
                bottom: 20px;
                left: 20px;
                right: 20px;
                padding: 15px;
                background: rgba(255,255,255,0.1);
                border-radius: 12px;
                backdrop-filter: blur(10px);
            }

            .user-name {
                font-weight: 600;
                margin-bottom: 5px;
            }

            .user-role {
                font-size: 12px;
                opacity: 0.8;
            }

            /* Main Content */
            .main-content {
                flex: 1;
                margin-left: 260px;
                padding: 30px;
                background: #f8f9fc;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 30px;
                background: white;
                padding: 20px 25px;
                border-radius: 15px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            }

            .header-title {
                font-size: 28px;
                font-weight: 700;
                color: #2c3e50;
            }

            .header-actions {
                display: flex;
                gap: 15px;
                align-items: center;
            }

            .btn {
                padding: 12px 20px;
                border: none;
                border-radius: 10px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .btn-primary {
                background: linear-gradient(135deg, #b8563b 0%, #a04d35 100%);
                color: white;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(184, 86, 59, 0.3);
            }

            .btn-secondary {
                background: #e3f2fd;
                color: #1976d2;
            }

            .btn-secondary:hover {
                background: #bbdefb;
            }

            /* Stats Cards */
            .stats-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 25px;
                margin-bottom: 30px;
            }

            .stat-card {
                background: white;
                padding: 25px;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                position: relative;
                overflow: hidden;
                transition: transform 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-5px);
            }

            .stat-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #b8563b, #27ae60, #3498db, #e74c3c);
            }

            .stat-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
            }

            .stat-title {
                font-size: 14px;
                color: #7f8c8d;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .stat-icon.patients { background: #e8f5e8; color: #27ae60; }
            .stat-icon.appointments { background: #e3f2fd; color: #2196f3; }
            .stat-icon.invoices { background: #fff3e0; color: #ff9800; }
            .stat-icon.reports { background: #fce4ec; color: #e91e63; }

            .stat-value {
                font-size: 36px;
                font-weight: 700;
                color: #2c3e50;
                margin-bottom: 10px;
            }

            .stat-change {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: 12px;
                font-weight: 600;
            }

            .stat-change.positive { color: #27ae60; }
            .stat-change.negative { color: #e74c3c; }

            /* Medical Status Indicators */
            .medical-status {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 20px;
                margin-bottom: 30px;
            }

            .status-card {
                background: white;
                padding: 20px;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                border-left: 4px solid;
            }

            .status-card.critical { border-left-color: #e74c3c; }
            .status-card.urgent { border-left-color: #f39c12; }
            .status-card.stable { border-left-color: #27ae60; }
            .status-card.pending { border-left-color: #3498db; }

            /* Activity Section */
            .activity-section {
                display: grid;
                grid-template-columns: 2fr 1fr;
                gap: 30px;
                margin-bottom: 30px;
            }

            .card {
                background: white;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.08);
                overflow: hidden;
            }

            .card-header {
                padding: 25px;
                border-bottom: 1px solid #ecf0f1;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .card-title {
                font-size: 18px;
                font-weight: 700;
                color: #2c3e50;
            }

            .card-body {
                padding: 0;
            }

            /* Patient Table */
            .patient-table {
                width: 100%;
                border-collapse: collapse;
            }

            .patient-table th,
            .patient-table td {
                padding: 15px 25px;
                text-align: left;
                border-bottom: 1px solid #ecf0f1;
            }

            .patient-table th {
                background: #f8f9fa;
                font-weight: 600;
                color: #2c3e50;
                font-size: 12px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .patient-table tbody tr:hover {
                background: #f8f9fc;
            }

            .patient-status {
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 11px;
                font-weight: 600;
                text-transform: uppercase;
            }

            .status-active { background: #d4edda; color: #155724; }
            .status-pending { background: #d1ecf1; color: #0c5460; }
            .status-inactive { background: #f8d7da; color: #721c24; }

            /* Quick Actions */
            .quick-actions {
                padding: 25px;
            }

            .action-item {
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 15px;
                border-radius: 10px;
                margin-bottom: 10px;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .action-item:hover {
                background: #f8f9fc;
            }

            .action-icon {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    transition: transform 0.3s ease;
                }

                .main-content {
                    margin-left: 0;
                    padding: 20px;
                }

                .stats-grid {
                    grid-template-columns: 1fr;
                }

                .activity-section {
                    grid-template-columns: 1fr;
                }
            }

            .pulse {
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.7; }
            }

            /* Success/Error Messages */
            .alert {
                padding: 15px 20px;
                border-radius: 10px;
                margin-bottom: 20px;
                font-weight: 500;
            }

            .alert-success {
                background: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }

            .alert-error {
                background: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }

            /* Form Styles */
            .form-input {
                width: 100%;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 12px 16px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: white;
            }

            .form-input:focus {
                outline: none;
                border-color: #b8563b;
                box-shadow: 0 0 0 3px rgba(184, 86, 59, 0.1);
            }

            .form-label {
                display: block;
                font-size: 14px;
                font-weight: 500;
                color: #374151;
                margin-bottom: 8px;
            }

            .form-select {
                width: 100%;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 12px 16px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: white;
                cursor: pointer;
            }

            .form-select:focus {
                outline: none;
                border-color: #b8563b;
                box-shadow: 0 0 0 3px rgba(184, 86, 59, 0.1);
            }

            .form-textarea {
                width: 100%;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                padding: 12px 16px;
                font-size: 14px;
                transition: all 0.3s ease;
                background: white;
                resize: vertical;
                min-height: 100px;
            }

            .form-textarea:focus {
                outline: none;
                border-color: #b8563b;
                box-shadow: 0 0 0 3px rgba(184, 86, 59, 0.1);
            }

            /* Button Styles */
            .btn-danger {
                background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
                color: white;
            }

            .btn-danger:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
            }
        </style>
    </head>
    <body>
        <div class="dashboard-container">
            <!-- Sidebar -->
            <nav class="sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-logo">
                        <svg viewBox="0 0 24 24">
                            <path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3M19 19H5V5H19V19M17 12H15V15H12V17H15V20H17V17H20V15H17V12M7 8H13V10H7V8M7 12H11V14H7V12Z"/>
                        </svg>
                    </div>
                    <div class="sidebar-title">MediTrack</div>
                </div>
                
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg class="nav-icon" viewBox="0 0 24 24">
                                <path d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z"/>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('patients.index') }}" class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
                            <svg class="nav-icon" viewBox="0 0 24 24">
                                <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                            </svg>
                            Patients
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('appointments.index') }}" class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                            <svg class="nav-icon" viewBox="0 0 24 24">
                                <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                            </svg>
                            Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('invoices.index') }}" class="nav-link {{ request()->routeIs('invoices.*') ? 'active' : '' }}">
                            <svg class="nav-icon" viewBox="0 0 24 24">
                                <path d="M7,15H9C9,16.08 9.37,17 10,17C10.63,17 11,16.08 11,15C11,13.92 10.63,13 10,13C9.37,13 9,12.08 9,11C9,9.92 9.37,9 10,9C10.63,9 11,9.92 11,11H13C13,9.92 12.63,9 12,9V7H8V9C7.37,9 7,9.92 7,11C7,12.08 7.37,13 8,13C8.63,13 9,13.92 9,15C9,16.08 8.63,17 8,17C7.37,17 7,16.08 7,15M12,18H20V16H12M12,14H20V12H12M12,10H20V8H12M4,18H6V16H4M4,14H6V12H4M4,10H6V8H4V10Z"/>
                            </svg>
                            Billing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('inventory.index') }}" class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                            <svg class="nav-icon" viewBox="0 0 24 24">
                                <path d="M14,17H7V15H14M17,13H7V11H17M17,9H7V7H17M19,3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3Z"/>
                            </svg>
                            Inventory
                        </a>
                    </li>
        <li class="nav-item">
            <a href="{{ route('staff.index') }}" class="nav-link {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z"/>
                </svg>
                Staff
            </a>
        </li>
                </ul>
                
                <div class="user-info">
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-role">{{ ucfirst(Auth::user()->role ?? 'User') }}</div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-danger" style="width: 100%; font-size: 12px; padding: 8px 12px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="main-content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>


