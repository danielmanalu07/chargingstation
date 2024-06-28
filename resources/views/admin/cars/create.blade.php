@extends('admin.layout.baselayout')
@section('title', 'Create Car')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container">
        <h1>Create New Car</h1>
        <form action="{{ url('/admin/car') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" required>
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Voltage -->
            <div class="mb-3">
                <label for="id_voltages" class="form-label">Voltage</label>
                <select name="id_voltages[]" class="form-control select2" id="id_voltages" multiple="multiple" required>
                    <option value="">Select Voltage</option>
                    @foreach ($voltages as $voltage)
                        <option value="{{ $voltage->id }}">{{ $voltage->type }} - {{ $voltage->voltage }}V</option>
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
                    <option value="">Select Capacity</option>
                    @foreach ($capacities as $capacity)
                        <option value="{{ $capacity->id }}">{{ $capacity->amount_capacity }} ({{ $capacity->type }})
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
                <select name="id_plug" class="form-control" id="id_plug" required>
                    <option value="">Select Plug</option>
                    @foreach ($plugs as $plug)
                        <option value="{{ $plug->id }}">{{ $plug->nama }}</option>
                    @endforeach
                </select>
                @error('id_plug')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_category_cars" class="form-label">Category</label>
                <select name="id_category_cars" class="form-control" id="id_category_cars" required>
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('id_category_cars')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="custom-file mb-3">
                <label class="custom-file-label" for="image">Image</label>
                <br>
                <img class="img-account-profile mb-2 d-block" id="image-preview" width="150" style="display: none;">
                <input type="file" class="custom-file-input" id="image" name="image"
                    onchange="previewImage(event)">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"></textarea>
                @error('deskripsi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
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
                var selectedValues = $('#id_capacities').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id_capacities',
                    value: JSON.stringify(selectedValues)
                }).appendTo('form');
                $('#id_capacities').prop('disabled', true);
            });
            $('form').submit(function() {
                var selectedValues = $('#id_voltages').val();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id_voltages',
                    value: JSON.stringify(selectedValues)
                }).appendTo('form');
                $('#id_voltages').prop('disabled', true);
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
    <script>
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
