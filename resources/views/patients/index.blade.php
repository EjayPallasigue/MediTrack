<x-layouts.admin title="Patient Management">
    <header class="header">
        <h1 class="header-title">Patient Management</h1>
        <div class="header-actions">
            <a href="{{ route('patients.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                </svg>
                Add Patient
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Patient Records</h3>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Total Patients: {{ $patients->total() }}</span>
            </div>
        </div>
        <div class="card-body">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                        <tr>
                            <td>
                                <div class="font-medium text-gray-900">{{ $patient->full_name }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $patient->id }}</div>
                            </td>
                            <td>{{ $patient->phone ?? 'N/A' }}</td>
                            <td>{{ $patient->email ?? 'N/A' }}</td>
                            <td>{{ $patient->date_of_birth ? $patient->date_of_birth->format('M d, Y') : 'N/A' }}</td>
                            <td>
                                <span class="patient-status status-active">Active</span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('patients.show', $patient) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">View</a>
                                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">Edit</a>
                                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;" onclick="return confirm('Delete this patient?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 20px; color: #666;">No patients found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($patients->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $patients->links() }}
        </div>
    @endif
</x-layouts.admin>


