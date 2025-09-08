<x-layouts.admin title="Billing & Invoices">
    <header class="header">
        <h1 class="header-title">Billing & Invoices</h1>
        <div class="header-actions">
            <a href="{{ route('invoices.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M7,15H9C9,16.08 9.37,17 10,17C10.63,17 11,16.08 11,15C11,13.92 10.63,13 10,13C9.37,13 9,12.08 9,11C9,9.92 9.37,9 10,9C10.63,9 11,9.92 11,11H13C13,9.92 12.63,9 12,9V7H8V9C7.37,9 7,9.92 7,11C7,12.08 7.37,13 8,13C8.63,13 9,13.92 9,15C9,16.08 8.63,17 8,17C7.37,17 7,16.08 7,15M12,18H20V16H12M12,14H20V12H12M12,10H20V8H12M4,18H6V16H4M4,14H6V12H4M4,10H6V8H4V10Z"/>
                </svg>
                Create Invoice
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Invoice Management</h3>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Total Invoices: {{ $invoices->total() }}</span>
            </div>
        </div>
        <div class="card-body">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th>Invoice #</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                        <tr>
                            <td>
                                <div class="font-mono text-sm font-medium text-gray-900">{{ $invoice->invoice_number }}</div>
                            </td>
                            <td>
                                <div class="font-medium text-gray-900">{{ $invoice->patient->full_name }}</div>
                                <div class="text-sm text-gray-500">ID: {{ $invoice->patient->id }}</div>
                            </td>
                            <td>{{ $invoice->invoice_date->format('M d, Y') }}</td>
                            <td>
                                <div class="font-medium text-gray-900">{{ $invoice->due_date->format('M d, Y') }}</div>
                                @if($invoice->due_date->isPast() && $invoice->status !== 'paid')
                                    <div class="text-xs text-red-600">Overdue</div>
                                @endif
                            </td>
                            <td>
                                <span class="patient-status 
                                    @if($invoice->status === 'draft') status-pending
                                    @elseif($invoice->status === 'sent') status-pending
                                    @elseif($invoice->status === 'paid') status-active
                                    @elseif($invoice->status === 'overdue') status-inactive
                                    @else status-pending
                                    @endif">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="font-semibold text-gray-900">${{ number_format($invoice->total_amount, 2) }}</span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">View</a>
                                    <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">Edit</a>
                                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;" onclick="return confirm('Delete this invoice?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #666;">No invoices found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($invoices->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $invoices->links() }}
        </div>
    @endif
</x-layouts.admin>
