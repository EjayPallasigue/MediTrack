<x-layouts.admin>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Appointment Details</h1>
        <div class="space-x-2">
            <a href="{{ route('appointments.edit', $appointment) }}" class="btn-brand">Edit Appointment</a>
            <a href="{{ route('appointments.index') }}" class="text-gray-600 hover:text-gray-800">← Back to Appointments</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Appointment Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Patient</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->full_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Doctor</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Date</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->formatted_date }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Time</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->formatted_time }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status</label>
                        <span class="mt-1 inline-flex px-2 py-1 text-xs rounded-full 
                            @if($appointment->status === 'scheduled') bg-yellow-100 text-yellow-800
                            @elseif($appointment->status === 'confirmed') bg-blue-100 text-blue-800
                            @elseif($appointment->status === 'in_progress') bg-purple-100 text-purple-800
                            @elseif($appointment->status === 'completed') bg-green-100 text-green-800
                            @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Fee</label>
                        <p class="mt-1 text-sm text-gray-900">₱{{ number_format($appointment->fee ?? 0, 2) }}</p>
                    </div>
                </div>

                @if($appointment->notes)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">Notes</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->notes }}</p>
                    </div>
                @endif

                @if($appointment->diagnosis)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">Diagnosis</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->diagnosis }}</p>
                    </div>
                @endif

                @if($appointment->treatment)
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-500">Treatment</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->treatment }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Patient Information</h2>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->full_name }}</p>
                    </div>
                    
                    @if($appointment->patient->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Phone</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->phone }}</p>
                        </div>
                    @endif
                    
                    @if($appointment->patient->email)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->email }}</p>
                        </div>
                    @endif
                    
                    @if($appointment->patient->date_of_birth)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Date of Birth</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->date_of_birth ? $appointment->patient->date_of_birth->format('M d, Y') : 'N/A' }}</p>
                        </div>
                    @endif
                    
                    @if($appointment->patient->gender)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Gender</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst($appointment->patient->gender) }}</p>
                        </div>
                    @endif
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('patients.show', $appointment->patient) }}" class="text-brand hover:text-brand-dark">View Full Patient Profile →</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
