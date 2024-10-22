<?php
namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'item_name'); 
        $sortDirection = $request->input('sort_direction', 'asc');

        $items = Inventory::when($search, function ($query, $search) {
                return $query->where('item_name', 'like', '%' . $search . '%')
                             ->orWhere('quantity', 'like', '%' . $search . '%')
                             ->orWhere('price', 'like', '%' . $search . '%');
            })
            ->orderBy($sortBy, $sortDirection)
            ->paginate(5);

        return view('inventory.index', compact('items', 'search', 'sortBy', 'sortDirection'));
    }


    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventory.index')
                         ->with('success', 'Item added successfully.');
    }

    public function edit(Inventory $inventory)
    {
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'item_name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $inventory->update($request->all());

        return redirect()->route('inventory.index')
                         ->with('success', 'Item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index')
                         ->with('success', 'Item deleted successfully.');
    }
}
