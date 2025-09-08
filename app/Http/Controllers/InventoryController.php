<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InventoryController extends Controller
{
    public function index(): View
    {
        $items = InventoryItem::latest()->paginate(10);
        return view('inventory.index', compact('items'));
    }

    public function create(): View
    {
        return view('inventory.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date|after:today',
        ]);

        InventoryItem::create($data);
        return redirect()->route('inventory.index')->with('status', 'Inventory item created successfully');
    }

    public function show(InventoryItem $inventory): View
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(InventoryItem $inventory): View
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, InventoryItem $inventory): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
        ]);

        $inventory->update($data);
        return redirect()->route('inventory.index')->with('status', 'Inventory item updated successfully');
    }

    public function destroy(InventoryItem $inventory): RedirectResponse
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('status', 'Inventory item deleted successfully');
    }
}
