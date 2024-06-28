<?php

namespace App\Http\Controllers\Capacity;

use App\Models\Capacity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CapacityController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $capacities = Capacity::orderBy('id')->get();
        return view('admin.capacity.index', compact('capacities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.capacity.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount_capacity' => 'required',
            'type' => 'required|string|max:255',
        ]);

        Capacity::create($request->all());
        return redirect()->route('capacities.index')->with('success', 'Capacity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Capacity $capacity)
    {
        return view('admin.capacity.show', compact('capacity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Capacity $capacity)
    {
        return view('admin.capacity.edit', compact('capacity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Capacity $capacity)
    {
        $request->validate([
            'amount_capacity' => 'required|numeric',
            'type' => 'required|string|max:255',
        ]);

        $capacity->update($request->all());
        return redirect()->route('capacities.index')->with('success', 'Capacity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Capacity $capacity)
    {
        $capacity->delete();
        return redirect()->route('capacities.index')->with('success', 'Capacity deleted successfully.');
    }
}
