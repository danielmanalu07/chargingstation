<?php

namespace App\Http\Controllers\Plug;

use App\Models\Plug;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PlugController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plugs = Plug::orderBy('id')->get();
        return view('admin.plug.index', compact('plugs'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plug.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $plug = Plug::create($request->all());
        return redirect()->route('plugs.index')->with('success', 'Plug created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $plug = Plug::findOrFail($id);
        return view('admin.plug.show', compact('plug'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plug = Plug::findOrFail($id);
        return view('admin.plug.edit', compact('plug'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $plug = Plug::findOrFail($id);
        $plug->update($request->all());
        return redirect()->route('plugs.index')->with('success', 'Plug updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plug = Plug::findOrFail($id);
        $plug->delete();
        return redirect()->route('plugs.index')->with('success', 'Plug deleted successfully.');
    }
}
