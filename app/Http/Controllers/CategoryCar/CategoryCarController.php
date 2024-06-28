<?php

namespace App\Http\Controllers\CategoryCar;

use App\Models\CategoryCar;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class CategoryCarController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CategoryCar::orderBy('id','desc')->get();
        return view('CategoryCar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CategoryCar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = [
            'name' => 'required',
        ];

        $message = ['name.required' => 'Name is required'];
        $this->validate($request, $validate, $message);

        $cc = new CategoryCar();
        $cc->name = $request->name;

        $cc->save();

        return redirect('/admin/categorycar')->with('success', 'Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cc = CategoryCar::find($id);
        return view('CategoryCar.edit', compact('cc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = [
            'name' => 'required',
        ];

        $message = ['name.required' => 'Name is required'];
        $this->validate($request, $validate, $message);

        $cc = CategoryCar::find($id);
        $cc->name = $request['name'];

        $cc->update();
        return redirect('/admin/categorycar')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cc = CategoryCar::find($id);
        $cc->delete();
        return redirect('/admin/categorycar')->with('success', 'Data Deleted Successfully');
    }
}
