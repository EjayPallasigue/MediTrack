<x-layouts.admin title="Edit Invoice">
    <header class="header">
        <h1 class="header-title">Edit Invoice</h1>
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
            <h3 class="card-title">Invoice Information</h3>
        </div>
        <div class="card-body" style="padding: 25px;">
            <form action="{{ route('invoices.update', $invoice) }}" method="POST" id="invoice-form">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="form-label">Patient *</label>
                        <select class="form-select" name="patient_id" required>
                            <option value="">Select Patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" @selected(old('patient_id', $invoice->patient_id) == $patient->id)>
                                    {{ $patient->full_name }} (ID: {{ $patient->id }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="form-label">Appointment</label>
                        <select class="form-select" name="appointment_id">
                            <option value="">Select Appointment (Optional)</option>
                            @foreach($appointments as $appointment)
                                <option value="{{ $appointment->id }}" @selected(old('appointment_id', $invoice->appointment_id) == $appointment->id)>
                                    {{ $appointment->patient->full_name }} - {{ $appointment->formatted_date }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="form-label">Invoice Date *</label>
                        <input class="form-input" type="date" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" required />
                    </div>
                    
                    <div>
                        <label class="form-label">Due Date *</label>
                        <input class="form-input" type="date" name="due_date" value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" required />
                    </div>
                    
                    <div>
                        <label class="form-label">Status *</label>
                        <select class="form-select" name="status" required>
                            <option value="draft" @selected(old('status', $invoice->status) === 'draft')>Draft</option>
                            <option value="sent" @selected(old('status', $invoice->status) === 'sent')>Sent</option>
                            <option value="paid" @selected(old('status', $invoice->status) === 'paid')>Paid</option>
                            <option value="overdue" @selected(old('status', $invoice->status) === 'overdue')>Overdue</option>
                            <option value="cancelled" @selected(old('status', $invoice->status) === 'cancelled')>Cancelled</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="form-label">Tax Rate (%)</label>
                        <input class="form-input" type="number" name="tax_rate" step="0.01" min="0" max="100" value="{{ old('tax_rate', $invoice->tax_rate) }}" placeholder="Enter tax rate" />
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="form-label">Notes</label>
                    <textarea class="form-textarea" name="notes" rows="3" placeholder="Enter any additional notes">{{ old('notes', $invoice->notes) }}</textarea>
                </div>
                
                <!-- Invoice Items -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-900">Invoice Items</h4>
                        <button type="button" id="add-item" class="btn btn-secondary">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                            </svg>
                            Add Item
                        </button>
                    </div>
                    
                    <div id="invoice-items">
                        @foreach(old('items', $invoice->items->toArray()) as $index => $item)
                            <div class="invoice-item border border-gray-200 rounded-lg p-4 mb-4">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="form-label">Description *</label>
                                        <input class="form-input" name="items[{{ $index }}][description]" value="{{ $item['description'] }}" placeholder="Enter item description" required />
                                    </div>
                                    <div>
                                        <label class="form-label">Quantity *</label>
                                        <input class="form-input" type="number" name="items[{{ $index }}][quantity]" min="1" value="{{ $item['quantity'] }}" placeholder="Qty" required />
                                    </div>
                                    <div>
                                        <label class="form-label">Unit Price *</label>
                                        <div class="flex gap-2">
                                            <input class="form-input" type="number" name="items[{{ $index }}][unit_price]" step="0.01" min="0" value="{{ $item['unit_price'] }}" placeholder="0.00" required />
                                            <button type="button" class="btn btn-danger remove-item" style="padding: 8px 12px;">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Totals -->
                <div class="bg-gray-50 p-4 rounded-lg mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Subtotal:</span>
                        <span class="font-semibold text-gray-900" id="subtotal">₱0.00</span>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Tax:</span>
                        <span class="font-semibold text-gray-900" id="tax-amount">₱0.00</span>
                    </div>
                    <div class="flex justify-between items-center text-lg font-bold border-t pt-2">
                        <span class="text-gray-900">Total:</span>
                        <span class="text-gray-900" id="total-amount">₱0.00</span>
                    </div>
                </div>
                
                <div class="flex gap-4">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                        </svg>
                        Update Invoice
                    </button>
                    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        let itemIndex = {{ count(old('items', $invoice->items->toArray())) }};
        
        document.getElementById('add-item').addEventListener('click', function() {
            const itemsContainer = document.getElementById('invoice-items');
            const itemHtml = `
                <div class="invoice-item border border-gray-200 rounded-lg p-4 mb-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <label class="form-label">Description *</label>
                            <input class="form-input" name="items[${itemIndex}][description]" placeholder="Enter item description" required />
                        </div>
                        <div>
                            <label class="form-label">Quantity *</label>
                            <input class="form-input" type="number" name="items[${itemIndex}][quantity]" min="1" placeholder="Qty" required />
                        </div>
                        <div>
                            <label class="form-label">Unit Price *</label>
                            <div class="flex gap-2">
                                <input class="form-input" type="number" name="items[${itemIndex}][unit_price]" step="0.01" min="0" placeholder="0.00" required />
                                <button type="button" class="btn btn-danger remove-item" style="padding: 8px 12px;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            itemsContainer.insertAdjacentHTML('beforeend', itemHtml);
            itemIndex++;
            updateTotals();
        });
        
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-item')) {
                e.target.closest('.invoice-item').remove();
                updateTotals();
            }
        });
        
        function updateTotals() {
            const items = document.querySelectorAll('.invoice-item');
            let subtotal = 0;
            
            items.forEach(item => {
                const quantity = parseFloat(item.querySelector('input[name*="[quantity]"]').value) || 0;
                const unitPrice = parseFloat(item.querySelector('input[name*="[unit_price]"]').value) || 0;
                subtotal += quantity * unitPrice;
            });
            
            const taxRate = parseFloat(document.querySelector('input[name="tax_rate"]').value) || 0;
            const taxAmount = subtotal * (taxRate / 100);
            const totalAmount = subtotal + taxAmount;
            
            document.getElementById('subtotal').textContent = '₱' + subtotal.toFixed(2);
            document.getElementById('tax-amount').textContent = '₱' + taxAmount.toFixed(2);
            document.getElementById('total-amount').textContent = '₱' + totalAmount.toFixed(2);
        }
        
        // Add event listeners for real-time calculation
        document.addEventListener('input', function(e) {
            if (e.target.matches('input[name*="[quantity]"], input[name*="[unit_price]"], input[name="tax_rate"]')) {
                updateTotals();
            }
        });
        
        // Initialize totals on page load
        updateTotals();
    </script>
</x-layouts.admin>
