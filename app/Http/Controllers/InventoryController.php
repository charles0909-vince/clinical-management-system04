<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::latest()->paginate(10);
        return view('inventory.index', compact('inventory'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:medication,supply,equipment',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string',
            'price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string',
            'reorder_level' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date'
        ]);

        Inventory::create($validated);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item created successfully.');
    }

    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:medication,supply,equipment',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string',
            'price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string',
            'reorder_level' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date'
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item deleted successfully.');
    }

    public function lowStock()
    {
        $lowStock = Inventory::whereRaw('quantity <= reorder_level')->get();
        return view('inventory.low-stock', compact('lowStock'));
    }

    public function expiringSoon()
    {
        $expiringSoon = Inventory::whereNotNull('expiry_date')
            ->whereDate('expiry_date', '<=', now()->addMonths(3))
            ->get();
        return view('inventory.expiring-soon', compact('expiringSoon'));
    }
}