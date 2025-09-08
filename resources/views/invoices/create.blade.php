<x-layouts.admin title="Create Invoice">
    <header class="header">
        <h1 class="header-title">Create New Invoice</h1>
        <div class="header-actions">
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Invoices
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Invoice Details</h3>
        </div>
        <div class="card-body" style="padding: 25px;">
        <form action="{{ route('invoices.store') }}" method="POST" id="invoice-form">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="patient_id" class="form-label">Patient *</label>
                    <select name="patient_id" id="patient_id" required class="form-select">
                        <option value="">Select Patient</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ (old('patient_id') == $patient->id || request('patient_id') == $patient->id) ? 'selected' : '' }}>
                                {{ $patient->full_name }} ({{ $patient->phone ?? 'No phone' }})
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="appointment_id" class="form-label">Appointment (Optional)</label>
                    <select name="appointment_id" id="appointment_id" class="form-select">
                        <option value="">Select Appointment</option>
                        @foreach($appointments as $appointment)
                            <option value="{{ $appointment->id }}" {{ old('appointment_id') == $appointment->id ? 'selected' : '' }}>
                                {{ $appointment->patient->full_name }} - {{ $appointment->appointment_date->format('M d, Y') }}
                            </option>
                        @endforeach
                    </select>
                    @error('appointment_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="invoice_date" class="form-label">Invoice Date *</label>
                    <input type="date" name="invoice_date" id="invoice_date" 
                           value="{{ old('invoice_date', date('Y-m-d')) }}" required
                           class="form-input">
                    @error('invoice_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Due Date *</label>
                    <input type="date" name="due_date" id="due_date" 
                           value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                    @error('due_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select name="status" id="status" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="sent" {{ old('status') == 'sent' ? 'selected' : '' }}>Sent</option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="overdue" {{ old('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tax_rate" class="block text-sm font-medium text-gray-700 mb-2">Tax Rate (%)</label>
                    <input type="number" name="tax_rate" id="tax_rate" step="0.01" min="0" max="100"
                           value="{{ old('tax_rate', 0) }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                    @error('tax_rate')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" id="notes" rows="3"
                          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Invoice Items -->
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Invoice Items</h3>
                <div id="invoice-items">
                    <div class="invoice-item grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 p-4 border border-gray-200 rounded-lg">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                            <input type="text" name="items[0][description]" required
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                            <input type="number" name="items[0][quantity]" min="1" value="1" required
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price *</label>
                            <input type="number" name="items[0][unit_price]" step="0.01" min="0" required
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                        </div>
                        <div class="flex items-end">
                            <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-800">Remove</button>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addItem()" class="text-brand hover:text-brand-dark">+ Add Item</button>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('invoices.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="btn-brand">Create Invoice</button>
            </div>
        </form>
    </div>

    <script>
        let itemIndex = 1;

        function addItem() {
            const container = document.getElementById('invoice-items');
            const newItem = document.createElement('div');
            newItem.className = 'invoice-item grid grid-cols-1 md:grid-cols-4 gap-4 mb-4 p-4 border border-gray-200 rounded-lg';
            newItem.innerHTML = `
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                    <input type="text" name="items[${itemIndex}][description]" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                    <input type="number" name="items[${itemIndex}][quantity]" min="1" value="1" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Unit Price *</label>
                    <input type="number" name="items[${itemIndex}][unit_price]" step="0.01" min="0" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand">
                </div>
                <div class="flex items-end">
                    <button type="button" onclick="removeItem(this)" class="text-red-600 hover:text-red-800">Remove</button>
                </div>
            `;
            container.appendChild(newItem);
            itemIndex++;
        }

        function removeItem(button) {
            const item = button.closest('.invoice-item');
            item.remove();
        }
    </script>
</x-layouts.admin>
