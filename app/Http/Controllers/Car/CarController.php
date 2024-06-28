<?php

namespace App\Http\Controllers\Car;

use App\Models\Capacity;
use App\Models\Car;
use App\Models\CategoryCar;
use App\Models\Plug;
use App\Models\Voltage;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class CarController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $cars = Car::with(['plug', 'categoryCar'])->orderBy('id')->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $voltages = Voltage::all();
        $capacities = Capacity::all();
        $plugs = Plug::all();
        $categories = CategoryCar::all();

        return view('admin.cars.create', compact('voltages', 'capacities', 'plugs', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_voltages' => 'required',
            'id_capacities' => 'required',
            'id_plug' => 'required|exists:plugs,id',
            'id_category_cars' => 'required|exists:category_cars,id',
            'image' => 'required|image|max:2048',
            'deskripsi' => 'required|string',
        ]);

        $id_capacity = json_decode($request->input('id_capacities'), true);
        $id_voltage = json_decode($request->input('id_voltages'), true);

        $carData = $request->all();
        $carData['id_capacities'] = json_encode($id_capacity);
        $carData['id_voltages'] = json_encode($id_voltage);

        if ($request->hasFile('image')) {
            $carData['image'] = $request->file('image')->store('images/cars', 'public');
        }

        Car::create($carData);
        return redirect()->route('car.index')->with('success', 'Car created successfully');
    }

    public function show($id)
    {
        $cars = Car::with(['plug', 'categoryCar'])->findOrFail($id);
        return view('admin.cars.show', compact('cars'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $voltages = Voltage::all(); // Ambil semua data voltages
        $capacities = Capacity::all(); // Jika perlu ambil data capacities juga
        $plugs = Plug::all(); // Jika perlu ambil data plugs juga
        $categories = CategoryCar::all(); // Jika perlu ambil data categories juga

        return view('admin.cars.edit', compact('car', 'voltages', 'capacities', 'plugs', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'id_voltages' => 'required',
            'id_capacities' => 'required',
            'id_plug' => 'required|exists:plugs,id',
            'id_category_cars' => 'required|exists:category_cars,id',
            'image' => 'nullable|image|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $car = Car::findOrFail($id);
        $carData = $request->all();
        if ($request->hasFile('image')) {
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $carData['image'] = $request->file('image')->store('images/cars', 'public');
        }

        $car->update($carData);
        return redirect()->route('car.index')->with('success', 'Car updated successfully');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }
        $car->delete();
        return redirect()->route('car.index')->with('success', 'Car deleted successfully');
    }
}
