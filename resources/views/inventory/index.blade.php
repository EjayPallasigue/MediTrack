<x-layouts.admin title="Inventory Management">
    <header class="header">
        <h1 class="header-title">Inventory Management</h1>
        <div class="header-actions">
            <a href="{{ route('inventory.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                </svg>
                Add Item
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Medical Supplies & Equipment</h3>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-500">Total Items: {{ $items->total() }}</span>
            </div>
        </div>
        <div class="card-body">
            <table class="patient-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Unit Price</th>
                        <th>Supplier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>
                                <div class="font-medium text-gray-900">{{ $item->name }}</div>
                                @if($item->description)
                                    <div class="text-sm text-gray-500">{{ Str::limit($item->description, 50) }}</div>
                                @endif
                            </td>
                            <td>{{ $item->category }}</td>
                            <td>
                                <span class="font-semibold {{ $item->quantity < 10 ? 'text-red-600' : 'text-gray-900' }}">
                                    {{ $item->quantity }}
                                </span>
                            </td>
                            <td>
                                <span class="patient-status 
                                    @if($item->status === 'in_stock') status-active
                                    @elseif($item->status === 'low_stock') status-pending
                                    @elseif($item->status === 'out_of_stock') status-inactive
                                    @elseif($item->status === 'expired') status-inactive
                                    @else status-pending
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                </span>
                            </td>
                            <td>₱{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ $item->supplier ?? 'N/A' }}</td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('inventory.show', $item) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">View</a>
                                    <a href="{{ route('inventory.edit', $item) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 12px;">Edit</a>
                                    <form action="{{ route('inventory.destroy', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 12px; padding: 6px 12px;" onclick="return confirm('Delete this item?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 20px; color: #666;">No inventory items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($items->hasPages())
        <div class="mt-6 flex justify-center">
            {{ $items->links() }}
        </div>
    @endif
</x-layouts.admin>
