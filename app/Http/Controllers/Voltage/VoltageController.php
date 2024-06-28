<?php

namespace App\Http\Controllers\Voltage;
use App\Models\Voltage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class VoltageController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voltages = Voltage::all();
        return view('admin.voltage.index', compact('voltages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voltage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'voltage' => 'required|integer',
            'type' => 'required|string|max:255',
        ]);

        Voltage::create($request->all());

        return redirect()->route('voltages.index')->with('success', 'Voltage created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $voltage = Voltage::findOrFail($id);
        return view('voltages.show', compact('voltage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $voltage = Voltage::findOrFail($id);
        return view('voltages.edit', compact('voltage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'voltage' => 'required|integer',
            'type' => 'required|string|max:255',
        ]);

        $voltage = Voltage::findOrFail($id);
        $voltage->update($request->all());

        return redirect()->route('voltages.index')->with('success', 'Voltage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $voltage = Voltage::findOrFail($id);
        $voltage->delete();

        return redirect()->route('voltages.index')->with('success', 'Voltage deleted successfully.');
    }
}