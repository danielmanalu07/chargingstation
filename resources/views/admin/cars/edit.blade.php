@extends('admin.layout.baselayout')
@section('title', 'Edit Car')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container">
        <h1>Edit Car</h1>
        <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" value="{{ $car->nama }}"
                    required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Voltage -->
            <div class="mb-3">
                <label for="id_voltages" class="form-label">Voltage</label>
                <select name="id_voltages[]" class="form-control select2" id="id_voltages" multiple="multiple" required>
                    @foreach ($voltages as $voltage)
                        <option value="{{ $voltage->id }}"
                            {{ in_array($voltage->id, json_decode($car->id_voltages, true) ?? []) ? 'selected' : '' }}>
                            {{ $voltage->type }} - {{ $voltage->voltage }}V
                        </option>
                    @endforeach
                </select>
                @error('id_voltages')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Capacity -->
            <div class="mb-3">
                <label for="id_capacities" class="form-label">Capacity</label>
                <select name="id_capacities[]" class="form-control select2" id="id_capacities" multiple="multiple" required>
                    @foreach ($capacities as $capacity)
                        <option value="{{ $capacity->id }}"
                            {{ in_array($capacity->id, json_decode($car->id_capacities, true) ?? []) ? 'selected' : '' }}>
                            {{ $capacity->type }}
                        </option>
                    @endforeach
                </select>
                @error('id_capacities')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Plug -->
            <div class="mb-3">
                <label for="id_plug" class="form-label">Plug</label>
                <select name="id_plug" class="form-control select2" id="id_plug" required>
                    @foreach ($plugs as $plug)
                        <option value="{{ $plug->id }}" {{ $car->id_plug == $plug->id ? 'selected' : '' }}>
                            {{ $plug->nama }}
                        </option>
                    @endforeach
                </select>
                @error('id_plug')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-3">
                <label for="id_category_cars" class="form-label">Category</label>
                <select name="id_category_cars" class="form-control" id="id_category_cars" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $car->id_category_cars == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('id_category_cars')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <br>
                <img class="img-account-profile mb-2 d-block" id="image-preview" width="150"
                    src="{{ asset('storage/' . $car->image) }}" alt="Car Image">
                <input type="file" class="form-control-file" id="image" name="image"
                    onchange="previewImage(event)">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ $car->deskripsi }}</textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('car.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection

@push('js')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });

            $('form').submit(function() {
                var selectedVoltages = $('#id_voltages').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id_voltages',
                    value: JSON.stringify(selectedVoltages)
                }).appendTo('form');
                $('#id_voltages').prop('disabled', true);

                var selectedCapacities = $('#id_capacities').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id_capacities',
                    value: JSON.stringify(selectedCapacities)
                }).appendTo('form');
                $('#id_capacities').prop('disabled', true);
            });
        });

        function previewImage(event) {
            const [file] = event.target.files;
            if (file) {
                const preview = document.getElementById('image-preview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        }
    </script>
@endpush
