<x-layouts.admin title="Appointment Management">
    <header class="header">
        <h1 class="header-title">Appointment Management</h1>
        <div class="header-actions">
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                </svg>
                Schedule Appointment
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Scheduled Appointments</h3>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Total Appointments: {{ $appointments->total() }}</span>
            </div>
        </div>
        <div class="card-body">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Fee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>
                                <div class="font-medium text-gray-900">{{ $appointment->patient->full_name }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $appointment->patient->id }}</div>
                            </td>
                            <td>
                                <div class="font-medium text-gray-900">{{ $appointment->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $appointment->user->specialization ?? 'General' }}</div>
                            </td>
                            <td>
                                <div class="font-medium text-gray-900">{{ $appointment->formatted_date }}</div>
                                <div class="text-sm text-gray-500">{{ $appointment->formatted_time }}</div>
                            </td>
                            <td>
                                <span class="patient-status 
                                    @if($appointment->status === 'scheduled') status-pending
                                    @elseif($appointment->status === 'confirmed') status-active
                                    @elseif($appointment->status === 'in_progress') status-pending
                                    @elseif($appointment->status === 'completed') status-active
                                    @elseif($appointment->status === 'cancelled') status-inactive
                                    @else status-pending
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $appointment->status)) }}
                                </span>
                            </td>
                            <td>
                                <span class="font-semibold text-gray-900">${{ number_format($appointment->fee ?? 0, 2) }}</span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">View</a>
                                    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">Edit</a>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;" onclick="return confirm('Delete this appointment?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px; color: #666;">No appointments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($appointments->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $appointments->links() }}
        </div>
    @endif
</x-layouts.admin>
