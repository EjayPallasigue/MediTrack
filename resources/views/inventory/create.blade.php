<x-layouts.admin title="Add Inventory Item">
    <header class="header">
        <h1 class="header-title">Add New Inventory Item</h1>
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
            <form action="{{ route('inventory.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                
                <div>
                    <label class="form-label">Item Name *</label>
                    <input class="form-input" name="name" placeholder="Enter item name" required />
                </div>
                
                <div>
                    <label class="form-label">Category *</label>
                    <select class="form-select" name="category" required>
                        <option value="">Select Category</option>
                        <option value="medication">Medication</option>
                        <option value="equipment">Medical Equipment</option>
                        <option value="supplies">Medical Supplies</option>
                        <option value="consumables">Consumables</option>
                        <option value="tools">Medical Tools</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div>
                    <label class="form-label">Quantity *</label>
                    <input class="form-input" type="number" name="quantity" min="0" placeholder="Enter quantity" required />
                </div>
                
                <div>
                    <label class="form-label">Minimum Stock Level *</label>
                    <input class="form-input" type="number" name="minimum_stock" min="0" placeholder="Enter minimum stock" required />
                </div>
                
                <div>
                    <label class="form-label">Unit Price *</label>
                    <input class="form-input" type="number" name="unit_price" step="0.01" min="0" placeholder="Enter unit price" required />
                </div>
                
                <div>
                    <label class="form-label">Supplier</label>
                    <input class="form-input" name="supplier" placeholder="Enter supplier name" />
                </div>
                
                <div>
                    <label class="form-label">Expiry Date</label>
                    <input class="form-input" type="date" name="expiry_date" />
                </div>
                
                <div class="md:col-span-2">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" name="description" rows="4" placeholder="Enter item description"></textarea>
                </div>
                
                <div class="md:col-span-2 flex gap-4 pt-4">
                    <button type="submit" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                        </svg>
                        Save Item
                    </button>
                    <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.admin>

