<x-layouts.admin title="Medical Dashboard">
    <header class="header">
        <h1 class="header-title">Medical Dashboard</h1>
        <div class="header-actions">
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M10,18A8,8 0 0,1 2,10A8,8 0 0,1 10,2A8,8 0 0,1 18,10A8,8 0 0,1 10,18M10,4A6,6 0 0,0 4,10A6,6 0 0,0 10,16A6,6 0 0,0 16,10A6,6 0 0,0 10,4M10,7A3,3 0 0,1 13,10A3,3 0 0,1 10,13A3,3 0 0,1 7,10A3,3 0 0,1 10,7Z"/>
                </svg>
                Generate Report
            </a>
            <a href="{{ route('patients.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                </svg>
                Add Patient
            </a>
        </div>
    </header>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Total Patients</div>
                <div class="stat-icon patients">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $totalPatients }}</div>
            <div class="stat-change positive">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13,20H11V8L5.5,13.5L4.08,12.08L12,4.16L19.92,12.08L18.5,13.5L13,8V20Z"/>
                </svg>
                Active patients in system
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Today's Appointments</div>
                <div class="stat-icon appointments">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $appointmentsToday }}</div>
            <div class="stat-change positive">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13,20H11V8L5.5,13.5L4.08,12.08L12,4.16L19.92,12.08L18.5,13.5L13,8V20Z"/>
                </svg>
                Scheduled for today
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Outstanding Invoices</div>
                <div class="stat-icon invoices">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M7,15H9C9,16.08 9.37,17 10,17C10.63,17 11,16.08 11,15C11,13.92 10.63,13 10,13C9.37,13 9,12.08 9,11C9,9.92 9.37,9 10,9C10.63,9 11,9.92 11,11H13C13,9.92 12.63,9 12,9V7H8V9C7.37,9 7,9.92 7,11C7,12.08 7.37,13 8,13C8.63,13 9,13.92 9,15C9,16.08 8.63,17 8,17C7.37,17 7,16.08 7,15M12,18H20V16H12M12,14H20V12H12M12,10H20V8H12M4,18H6V16H4M4,14H6V12H4M4,10H6V8H4V10Z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ $outstandingInvoices }}</div>
            <div class="stat-change {{ $outstandingInvoices > 0 ? 'negative pulse' : 'positive' }}">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M11,4H13V16L18.5,10.5L19.92,11.92L12,19.84L4.08,11.92L5.5,10.5L11,16V4Z"/>
                </svg>
                {{ $outstandingInvoices > 0 ? 'Requires attention' : 'All invoices paid' }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-header">
                <div class="stat-title">Staff Members</div>
                <div class="stat-icon reports">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z"/>
                    </svg>
                </div>
            </div>
            <div class="stat-value">{{ \App\Models\User::count() }}</div>
            <div class="stat-change positive">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M13,20H11V8L5.5,13.5L4.08,12.08L12,4.16L19.92,12.08L18.5,13.5L13,8V20Z"/>
                </svg>
                Active team members
            </div>
        </div>
    </div>

    <!-- Medical Status Indicators -->
    <div class="medical-status">
        <div class="status-card critical">
            <h4 style="color: #e74c3c; margin-bottom: 8px;">Critical Cases</h4>
            <div style="font-size: 24px; font-weight: bold;">0</div>
            <p style="font-size: 12px; color: #666;">Requires immediate attention</p>
        </div>
        <div class="status-card urgent">
            <h4 style="color: #f39c12; margin-bottom: 8px;">Urgent Reviews</h4>
            <div style="font-size: 24px; font-weight: bold;">{{ $outstandingInvoices }}</div>
            <p style="font-size: 12px; color: #666;">Outstanding invoices</p>
        </div>
        <div class="status-card stable">
            <h4 style="color: #27ae60; margin-bottom: 8px;">Stable Patients</h4>
            <div style="font-size: 24px; font-weight: bold;">{{ $totalPatients }}</div>
            <p style="font-size: 12px; color: #666;">Regular monitoring</p>
        </div>
        <div class="status-card pending">
            <h4 style="color: #3498db; margin-bottom: 8px;">Pending Appointments</h4>
            <div style="font-size: 24px; font-weight: bold;">{{ $appointmentsToday }}</div>
            <p style="font-size: 12px; color: #666;">Scheduled today</p>
        </div>
    </div>

    <!-- Activity Section -->
    <div class="activity-section">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Patient Activity</h3>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary" style="font-size: 12px; padding: 8px 15px;">View All</a>
            </div>
            <div class="card-body">
                <table class="patient-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Patient::latest()->take(5)->get() as $patient)
                            <tr>
                                <td>{{ $patient->full_name }}</td>
                                <td>{{ $patient->phone ?? 'N/A' }}</td>
                                <td>{{ $patient->email ?? 'N/A' }}</td>
                                <td>
                                    <span class="patient-status status-active">Active</span>
                                </td>
                                <td>{{ $patient->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 20px; color: #666;">No patients found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="quick-actions">
                <a href="{{ route('patients.create') }}" class="action-item">
                    <div class="action-icon" style="background: #e8f5e8; color: #27ae60;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Add New Patient</div>
                        <div style="font-size: 12px; color: #666;">Register a new patient</div>
                    </div>
                </a>

                <a href="{{ route('appointments.create') }}" class="action-item">
                    <div class="action-icon" style="background: #e3f2fd; color: #2196f3;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Schedule Appointment</div>
                        <div style="font-size: 12px; color: #666;">Book a new appointment</div>
                    </div>
                </a>

                <a href="{{ route('invoices.create') }}" class="action-item">
                    <div class="action-icon" style="background: #fff3e0; color: #ff9800;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7,15H9C9,16.08 9.37,17 10,17C10.63,17 11,16.08 11,15C11,13.92 10.63,13 10,13C9.37,13 9,12.08 9,11C9,9.92 9.37,9 10,9C10.63,9 11,9.92 11,11H13C13,9.92 12.63,9 12,9V7H8V9C7.37,9 7,9.92 7,11C7,12.08 7.37,13 8,13C8.63,13 9,13.92 9,15C9,16.08 8.63,17 8,17C7.37,17 7,16.08 7,15M12,18H20V16H12M12,14H20V12H12M12,10H20V8H12M4,18H6V16H4M4,14H6V12H4M4,10H6V8H4V10Z"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600;">Create Invoice</div>
                        <div style="font-size: 12px; color: #666;">Generate new invoice</div>
                    </div>
                </a>

        <a href="{{ route('staff.create') }}" class="action-item">
            <div class="action-icon" style="background: #fce4ec; color: #e91e63;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z"/>
                </svg>
            </div>
            <div>
                <div style="font-weight: 600;">Add Staff Member</div>
                <div style="font-size: 12px; color: #666;">Register new staff</div>
            </div>
        </a>
            </div>
        </div>
    </div>
</x-layouts.admin>


