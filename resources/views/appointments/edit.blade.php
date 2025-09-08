<x-layouts.admin title="Edit Appointment">
    <header class="header">
        <h1 class="header-title">Edit Appointment</h1>
        <div class="header-actions">
            <a href="{{ route('appointments.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Appointments
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Appointment Details</h3>
        </div>
        <div class="card-body" style="padding: 25px;">
            <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="patient_id" class="form-label">Patient *</label>
                        <select name="patient_id" id="patient_id" required class="form-select">
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ (old('patient_id', $appointment->patient_id) == $patient->id) ? 'selected' : '' }}>
                                    {{ $patient->full_name }} ({{ $patient->phone ?? 'No phone' }})
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user_id" class="form-label">Doctor *</label>
                        <select name="user_id" id="user_id" required class="form-select">
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}" {{ (old('user_id', $appointment->user_id) == $doctor->id) ? 'selected' : '' }}>
                                    {{ $doctor->name }} {{ $doctor->specialization ? '(' . $doctor->specialization . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="appointment_date" class="form-label">Date *</label>
                        <input type="date" name="appointment_date" id="appointment_date" 
                               value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" required
                               min="{{ date('Y-m-d') }}"
                               class="form-input">
                        @error('appointment_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="form-label">Start Time *</label>
                        <input type="time" name="start_time" id="start_time" 
                               value="{{ old('start_time', $appointment->start_time->format('H:i')) }}" required
                               class="form-input">
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_time" class="form-label">End Time *</label>
                        <input type="time" name="end_time" id="end_time" 
                               value="{{ old('end_time', $appointment->end_time->format('H:i')) }}" required
                               class="form-input">
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="form-label">Status *</label>
                        <select name="status" id="status" required class="form-select">
                            <option value="scheduled" {{ old('status', $appointment->status) == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="in_progress" {{ old('status', $appointment->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="no_show" {{ old('status', $appointment->status) == 'no_show' ? 'selected' : '' }}>No Show</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fee" class="form-label">Fee (₱)</label>
                        <input type="number" name="fee" id="fee" step="0.01" min="0"
                               value="{{ old('fee', $appointment->fee) }}"
                               class="form-input">
                        @error('fee')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea name="notes" id="notes" rows="3"
                              class="form-textarea">{{ old('notes', $appointment->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea name="diagnosis" id="diagnosis" rows="3"
                              class="form-textarea">{{ old('diagnosis', $appointment->diagnosis) }}</textarea>
                    @error('diagnosis')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="treatment" class="form-label">Treatment</label>
                    <textarea name="treatment" id="treatment" rows="3"
                              class="form-textarea">{{ old('treatment', $appointment->treatment) }}</textarea>
                    @error('treatment')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex gap-4">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                        </svg>
                        Update Appointment
                    </button>
                    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
