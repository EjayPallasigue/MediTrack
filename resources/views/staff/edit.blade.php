<x-layouts.admin title="Edit Staff Member">
    <header class="header">
        <h1 class="header-title">Edit Staff Member</h1>
        <div class="header-actions">
            <a href="{{ route('staff.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Staff
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Staff Information</h3>
        </div>
        <div class="card-body" style="padding: 25px;">
            <form method="POST" action="{{ route('staff.update', $staff) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="form-label">Full Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $staff->name) }}"
                               class="form-input"
                               placeholder="Enter full name"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $staff->email) }}"
                               class="form-input"
                               placeholder="Enter email address"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="form-label">Role *</label>
                        <select id="role" 
                                name="role" 
                                class="form-select"
                                required>
                            <option value="">Select a role</option>
                            <option value="admin" {{ old('role', $staff->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="doctor" {{ old('role', $staff->role) == 'doctor' ? 'selected' : '' }}>Doctor</option>
                            <option value="nurse" {{ old('role', $staff->role) == 'nurse' ? 'selected' : '' }}>Nurse</option>
                            <option value="receptionist" {{ old('role', $staff->role) == 'receptionist' ? 'selected' : '' }}>Receptionist</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               value="{{ old('phone', $staff->phone) }}"
                               class="form-input"
                               placeholder="e.g., 555-1234">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="specialization" class="form-label">Specialization</label>
                        <input type="text" 
                               id="specialization" 
                               name="specialization" 
                               value="{{ old('specialization', $staff->specialization) }}"
                               class="form-input"
                               placeholder="e.g., Internal Medicine, Cardiology, etc.">
                        @error('specialization')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input"
                               placeholder="Leave blank to keep current password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Leave blank to keep the current password</p>
                    </div>

                    <div>
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input"
                               placeholder="Confirm new password">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex gap-4">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                        </svg>
                        Update Staff Member
                    </button>
                    <a href="{{ route('staff.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
