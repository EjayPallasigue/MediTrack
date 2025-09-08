<x-layouts.admin title="Staff Management">
    <header class="header">
        <h1 class="header-title">Staff Management</h1>
        <div class="header-actions">
            <a href="{{ route('staff.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z"/>
                </svg>
                Add Staff Member
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Medical Team</h3>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Total Staff: {{ $staff->total() }}</span>
            </div>
        </div>
        <div class="card-body">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Specialization</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staff as $member)
                        <tr>
                            <td>
                                <div class="font-medium text-gray-900">{{ $member->name }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $member->id }}</div>
                            </td>
                            <td>{{ $member->email }}</td>
                            <td>
                                <span class="patient-status 
                                    @if($member->role === 'admin') status-inactive
                                    @elseif($member->role === 'doctor') status-active
                                    @elseif($member->role === 'nurse') status-active
                                    @elseif($member->role === 'receptionist') status-pending
                                    @else status-pending
                                    @endif">
                                    {{ ucfirst($member->role) }}
                                </span>
                            </td>
                            <td>{{ $member->specialization ?? 'N/A' }}</td>
                            <td>{{ $member->phone ?? 'N/A' }}</td>
                            <td>
                                <span class="patient-status status-active">Active</span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('staff.show', $member) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">View</a>
                                    <a href="{{ route('staff.edit', $member) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">Edit</a>
                                    <form action="{{ route('staff.destroy', $member) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;" onclick="return confirm('Delete this staff member?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #666;">No staff members found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($staff->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $staff->links() }}
        </div>
    @endif
</x-layouts.admin>
