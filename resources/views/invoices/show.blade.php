<x-layouts.admin>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Invoice #{{ $invoice->invoice_number }}</h1>
        <div class="space-x-2">
            <a href="{{ route('invoices.edit', $invoice) }}" class="btn-brand">Edit Invoice</a>
            <a href="{{ route('invoices.index') }}" class="text-gray-600 hover:text-gray-800">← Back to Invoices</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">MediTrack Clinic</h2>
                        <p class="text-gray-600">123 Medical Street</p>
                        <p class="text-gray-600">Healthcare City, HC 12345</p>
                        <p class="text-gray-600">Phone: (555) 123-4567</p>
                    </div>
                    <div class="text-right">
                        <h3 class="text-lg font-semibold text-gray-900">Invoice</h3>
                        <p class="text-gray-600">#{{ $invoice->invoice_number }}</p>
                        <p class="text-gray-600">Date: {{ $invoice->invoice_date->format('M d, Y') }}</p>
                        <p class="text-gray-600">Due: {{ $invoice->due_date->format('M d, Y') }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="font-semibold text-gray-900 mb-2">Bill To:</h4>
                    <p class="text-gray-900">{{ $invoice->patient->full_name }}</p>
                    @if($invoice->patient->phone)
                        <p class="text-gray-600">{{ $invoice->patient->phone }}</p>
                    @endif
                    @if($invoice->patient->email)
                        <p class="text-gray-600">{{ $invoice->patient->email }}</p>
                    @endif
                    @if($invoice->patient->address)
                        <p class="text-gray-600">{{ $invoice->patient->address }}</p>
                        @if($invoice->patient->city)
                            <p class="text-gray-600">{{ $invoice->patient->city }}, {{ $invoice->patient->state }} {{ $invoice->patient->postal_code }}</p>
                        @endif
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($invoice->items as $item)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $item->description }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">₱{{ number_format($item->unit_price, 2) }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">₱{{ number_format($item->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex justify-end">
                    <div class="w-64">
                        <div class="flex justify-between py-2">
                            <span class="text-sm text-gray-600">Subtotal:</span>
                            <span class="text-sm text-gray-900">₱{{ number_format($invoice->subtotal, 2) }}</span>
                        </div>
                        @if($invoice->tax_rate > 0)
                            <div class="flex justify-between py-2">
                                <span class="text-sm text-gray-600">Tax ({{ $invoice->tax_rate }}%):</span>
                                <span class="text-sm text-gray-900">₱{{ number_format($invoice->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between py-2 border-t border-gray-200">
                            <span class="font-semibold text-gray-900">Total:</span>
                            <span class="font-semibold text-gray-900">₱{{ number_format($invoice->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                @if($invoice->notes)
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Notes:</h4>
                        <p class="text-gray-600">{{ $invoice->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Invoice Details</h3>
                
                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status</label>
                        <span class="mt-1 inline-flex px-2 py-1 text-xs rounded-full 
                            @if($invoice->status === 'draft') bg-gray-100 text-gray-800
                            @elseif($invoice->status === 'sent') bg-blue-100 text-blue-800
                            @elseif($invoice->status === 'paid') bg-green-100 text-green-800
                            @elseif($invoice->status === 'overdue') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Invoice Date</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $invoice->invoice_date->format('M d, Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Due Date</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $invoice->due_date->format('M d, Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500">Total Amount</label>
                        <p class="mt-1 text-lg font-semibold text-gray-900">₱{{ number_format($invoice->total_amount, 2) }}</p>
                    </div>
                </div>
                
                @if($invoice->appointment)
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Related Appointment</h4>
                        <p class="text-sm text-gray-600">{{ $invoice->appointment->formatted_date }}</p>
                        <p class="text-sm text-gray-600">{{ $invoice->appointment->user->name }}</p>
                        <a href="{{ route('appointments.show', $invoice->appointment) }}" class="text-brand hover:text-brand-dark text-sm">View Appointment →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
