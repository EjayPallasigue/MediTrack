<x-layouts.admin title="Patient Details">
    <header class="header">
        <h1 class="header-title">{{ $patient->full_name }}</h1>
        <div class="header-actions">
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Patients
            </a>
            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                </svg>
                Edit Patient
            </a>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Patient Information -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Patient Information</h3>
                    <span class="patient-status status-active">Active</span>
                </div>
                <div class="card-body" style="padding: 25px;">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Patient ID</label>
                            <p class="text-lg font-semibold text-gray-900">#{{ $patient->id }}</p>
                        </div>
                        
                        <div>
                            <label class="form-label">Full Name</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $patient->full_name }}</p>
                        </div>
                        
                        <div>
                            <label class="form-label">Date of Birth</label>
                            <p class="text-gray-900">{{ $patient->date_of_birth ? $patient->date_of_birth->format('M d, Y') : 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <label class="form-label">Gender</label>
                            <p class="text-gray-900">{{ ucfirst($patient->gender ?? 'N/A') }}</p>
                        </div>
                        
                        <div>
                            <label class="form-label">Phone Number</label>
                            <p class="text-gray-900">{{ $patient->phone ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <label class="form-label">Email Address</label>
                            <p class="text-gray-900">{{ $patient->email ?? 'N/A' }}</p>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="form-label">Address</label>
                            <p class="text-gray-900">
                                @if($patient->address)
                                    {{ $patient->address }}<br>
                                    {{ $patient->city }}, {{ $patient->state }} {{ $patient->postal_code }}
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emergency Contact & Notes -->
        <div class="space-y-6">
            <!-- Emergency Contact -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Emergency Contact</h3>
                </div>
                <div class="card-body" style="padding: 25px;">
                    <div class="space-y-4">
                        <div>
                            <label class="form-label">Contact Name</label>
                            <p class="text-gray-900">{{ $patient->emergency_contact_name ?? 'N/A' }}</p>
                        </div>
                        
                        <div>
                            <label class="form-label">Contact Phone</label>
                            <p class="text-gray-900">{{ $patient->emergency_contact_phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Notes -->
            @if($patient->notes)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Medical Notes</h3>
                </div>
                <div class="card-body" style="padding: 25px;">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $patient->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <a href="{{ route('appointments.create', ['patient_id' => $patient->id]) }}" class="action-item">
                        <div class="action-icon" style="background: #e3f2fd; color: #2196f3;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Schedule Appointment</div>
                            <div style="font-size: 12px; color: #666;">Book appointment for this patient</div>
                        </div>
                    </a>

                    <a href="{{ route('invoices.create', ['patient_id' => $patient->id]) }}" class="action-item">
                        <div class="action-icon" style="background: #fff3e0; color: #ff9800;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7,15H9C9,16.08 9.37,17 10,17C10.63,17 11,16.08 11,15C11,13.92 10.63,13 10,13C9.37,13 9,12.08 9,11C9,9.92 9.37,9 10,9C10.63,9 11,9.92 11,11H13C13,9.92 12.63,9 12,9V7H8V9C7.37,9 7,9.92 7,11C7,12.08 7.37,13 8,13C8.63,13 9,13.92 9,15C9,16.08 8.63,17 8,17C7.37,17 7,16.08 7,15M12,18H20V16H12M12,14H20V12H12M12,10H20V8H12M4,18H6V16H4M4,14H6V12H4M4,10H6V8H4V10Z"/>
                            </svg>
                        </div>
                        <div>
                            <div style="font-weight: 600;">Create Invoice</div>
                            <div style="font-size: 12px; color: #666;">Generate invoice for this patient</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>


