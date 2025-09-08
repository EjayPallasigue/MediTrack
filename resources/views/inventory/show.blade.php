<x-layouts.admin title="Inventory Item Details">
    <header class="header">
        <h1 class="header-title">Item Details</h1>
        <div class="header-actions">
            <a href="{{ route('inventory.edit', $inventory) }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                </svg>
                Edit Item
            </a>
            <a href="{{ route('inventory.index') }}" class="btn btn-secondary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                </svg>
                Back to Inventory
            </a>
        </div>
    </header>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $inventory->name }}</h3>
            <div class="flex items-center gap-3">
                <span class="patient-status 
                    @if($inventory->status === 'in_stock') status-active
                    @elseif($inventory->status === 'low_stock') status-pending
                    @elseif($inventory->status === 'out_of_stock') status-inactive
                    @elseif($inventory->status === 'expired') status-inactive
                    @else status-pending
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $inventory->status)) }}
                </span>
            </div>
        </div>
        <div class="card-body" style="padding: 25px;">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Item Name</label>
                            <p class="text-gray-900 font-medium">{{ $inventory->name }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Category</label>
                            <p class="text-gray-900 font-medium">{{ ucfirst($inventory->category) }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Description</label>
                            <p class="text-gray-900">{{ $inventory->description ?: 'No description provided' }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Supplier</label>
                            <p class="text-gray-900">{{ $inventory->supplier ?: 'Not specified' }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Stock Information</h4>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Current Quantity</label>
                            <p class="text-2xl font-bold {{ $inventory->quantity < 10 ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $inventory->quantity }}
                            </p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Minimum Stock Level</label>
                            <p class="text-gray-900 font-medium">{{ $inventory->minimum_stock }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Unit Price</label>
                            <p class="text-gray-900 font-medium">₱{{ number_format($inventory->unit_price, 2) }}</p>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500">Total Value</label>
                            <p class="text-gray-900 font-medium">₱{{ number_format($inventory->quantity * $inventory->unit_price, 2) }}</p>
                        </div>
                        
                        @if($inventory->expiry_date)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Expiry Date</label>
                            <p class="text-gray-900 font-medium {{ $inventory->expiry_date->isPast() ? 'text-red-600' : '' }}">
                                {{ $inventory->expiry_date->format('M d, Y') }}
                                @if($inventory->expiry_date->isPast())
                                    <span class="text-red-600 text-sm">(Expired)</span>
                                @elseif($inventory->expiry_date->diffInDays() <= 30)
                                    <span class="text-orange-600 text-sm">(Expires Soon)</span>
                                @endif
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <div class="flex gap-4">
                    <a href="{{ route('inventory.edit', $inventory) }}" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Edit Item
                    </a>
                    <form action="{{ route('inventory.destroy', $inventory) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                            </svg>
                            Delete Item
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
