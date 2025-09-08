<x-layouts.admin>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Staff Member Details</h1>
        <div class="flex space-x-3">
            <a href="{{ route('staff.edit', $staff) }}" class="btn-secondary">Edit</a>
            <a href="{{ route('staff.index') }}" class="btn-secondary">Back to Staff</a>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">{{ $staff->name }}</h2>
            <p class="text-sm text-gray-600">{{ $staff->email }}</p>
        </div>
        
        <div class="px-6 py-4">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $staff->name }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $staff->email }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Role</dt>
                    <dd class="mt-1">
                        <span class="px-2 py-1 text-xs rounded-full 
                            @if($staff->role === 'admin') bg-purple-100 text-purple-800
                            @elseif($staff->role === 'doctor') bg-blue-100 text-blue-800
                            @elseif($staff->role === 'nurse') bg-green-100 text-green-800
                            @elseif($staff->role === 'receptionist') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($staff->role) }}
                        </span>
                    </dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Phone Number</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $staff->phone ?? 'Not provided' }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Specialization</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $staff->specialization ?? 'Not specified' }}</dd>
                </div>
                
                <div>
                    <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $staff->created_at->format('M d, Y') }}</dd>
                </div>
            </dl>
        </div>
        
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Last updated: {{ $staff->updated_at->format('M d, Y \a\t g:i A') }}
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('staff.edit', $staff) }}" class="btn-brand">Edit Staff Member</a>
                    <form action="{{ route('staff.destroy', $staff) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this staff member? This action cannot be undone.')">
                            Delete Staff Member
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
