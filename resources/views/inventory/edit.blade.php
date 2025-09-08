<x-layouts.admin title="Edit Inventory Item">
    <header class="header">
        <h1 class="header-title">Edit Inventory Item</h1>
        <div class="header-actions">
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
            <h3 class="card-title">Item Information</h3>
        </div>
        <div class="card-body" style="padding: 25px;">
            <form action="{{ route('inventory.update', $inventory) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="form-label">Item Name *</label>
                    <input class="form-input" name="name" value="{{ old('name', $inventory->name) }}" placeholder="Enter item name" required />
                </div>
                
                <div>
                    <label class="form-label">Category *</label>
                    <select class="form-select" name="category" required>
                        <option value="">Select Category</option>
                        <option value="medication" @selected(old('category', $inventory->category) === 'medication')>Medication</option>
                        <option value="equipment" @selected(old('category', $inventory->category) === 'equipment')>Medical Equipment</option>
                        <option value="supplies" @selected(old('category', $inventory->category) === 'supplies')>Medical Supplies</option>
                        <option value="consumables" @selected(old('category', $inventory->category) === 'consumables')>Consumables</option>
                        <option value="tools" @selected(old('category', $inventory->category) === 'tools')>Medical Tools</option>
                        <option value="other" @selected(old('category', $inventory->category) === 'other')>Other</option>
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Quantity *</label>
                    <input class="form-input" type="number" name="quantity" min="0" value="{{ old('quantity', $inventory->quantity) }}" placeholder="Enter quantity" required />
                </div>
                
                <div>
                    <label class="form-label">Minimum Stock Level *</label>
                    <input class="form-input" type="number" name="minimum_stock" min="0" value="{{ old('minimum_stock', $inventory->minimum_stock) }}" placeholder="Enter minimum stock" required />
                </div>
                
                <div>
                    <label class="form-label">Unit Price *</label>
                    <input class="form-input" type="number" name="unit_price" step="0.01" min="0" value="{{ old('unit_price', $inventory->unit_price) }}" placeholder="Enter unit price" required />
                </div>
                
                <div>
                    <label class="form-label">Supplier</label>
                    <input class="form-input" name="supplier" value="{{ old('supplier', $inventory->supplier) }}" placeholder="Enter supplier name" />
                </div>
                
                <div>
                    <label class="form-label">Expiry Date</label>
                    <input class="form-input" type="date" name="expiry_date" value="{{ old('expiry_date', $inventory->expiry_date?->format('Y-m-d')) }}" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" name="description" rows="4" placeholder="Enter item description">{{ old('description', $inventory->description) }}</textarea>
                </div>
                
                <div class="md:col-span-2 flex gap-4 pt-4">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                        </svg>
                        Update Item
                    </button>
                    <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>
