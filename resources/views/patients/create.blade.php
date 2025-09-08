<x-layouts.admin title="Add Patient">
    <header class="header">
        <h1 class="header-title">Add New Patient</h1>
        <div class="header-actions">
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Patients
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Patient Information</h3>
        </div>
        <div class="card-body" style="padding: 25px;">
            <form action="{{ route('patients.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                
                <div>
                    <label class="form-label">First Name *</label>
                    <input class="form-input" name="first_name" placeholder="Enter first name" required />
                </div>
                
                <div>
                    <label class="form-label">Last Name *</label>
                    <input class="form-input" name="last_name" placeholder="Enter last name" required />
                </div>
                
                <div>
                    <label class="form-label">Date of Birth</label>
                    <input class="form-input" type="date" name="date_of_birth" />
                </div>
                
                <div>
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Phone Number</label>
                    <input class="form-input" name="phone" placeholder="Enter phone number" />
                </div>
                
                <div>
                    <label class="form-label">Email Address</label>
                    <input class="form-input" type="email" name="email" placeholder="Enter email address" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="form-label">Address</label>
                    <input class="form-input" name="address" placeholder="Enter full address" />
                </div>
                
                <div>
                    <label class="form-label">City</label>
                    <input class="form-input" name="city" placeholder="Enter city" />
                </div>
                
                <div>
                    <label class="form-label">State</label>
                    <input class="form-input" name="state" placeholder="Enter state" />
                </div>
                
                <div>
                    <label class="form-label">Postal Code</label>
                    <input class="form-input" name="postal_code" placeholder="Enter postal code" />
                </div>
                
                <div>
                    <label class="form-label">Emergency Contact Name</label>
                    <input class="form-input" name="emergency_contact_name" placeholder="Enter emergency contact name" />
                </div>
                
                <div>
                    <label class="form-label">Emergency Contact Phone</label>
                    <input class="form-input" name="emergency_contact_phone" placeholder="Enter emergency contact phone" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="form-label">Medical Notes</label>
                    <textarea class="form-textarea" name="notes" rows="4" placeholder="Enter any medical notes or additional information"></textarea>
                </div>
                
                <div class="md:col-span-2 flex gap-4 pt-4">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                        </svg>
                        Save Patient
                    </button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>


