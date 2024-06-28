@extends('user.layout.baselayout')
@section('title')
    Charging Session
@endsection
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

    <body class="d-flex flex-column min-vh-100">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('error') }}
            </div>
        @endif
        <form action="{{ route('cs.create') }}" method="POST" id="multiStepForm">
            @csrf
            <div class="form-step form-step-active">
                <div class="form-group">
                    <label for="car" class="form-label">Choose Your Car</label>
                    <select name="car" class="form-control select2" id="car">
                        <option value="">Select your Car</option>
                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}" data-image="{{ asset('storage/' . $car->image) }}"
                                data-name="{{ $car->nama }}"
                                data-voltage="@foreach ($car->voltages as $voltage){{ $voltage->voltage }}V ({{ $voltage->type }})@if (!$loop->last), @endif @endforeach"
                                data-capacity="@foreach ($car->capacities as $capacity){{ $capacity->amount_capacity }} ({{ $capacity->type }})@if (!$loop->last), @endif @endforeach"
                                data-plug="{{ $car->plug->nama }}" data-category="{{ $car->categoryCar->name }}"
                                data-description="{{ $car->deskripsi }}">
                                {{ $car->nama }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select your car</div>
                </div>
                <div id="car-details-container" style="display: none;" class="m-2">
                    <div class="card">
                        <div class="card-body">
                            <div id="car-details" class="mt-4">
                                <h5 id="car-name" class="card-title"></h5>
                                <p class="card-text"><img id="car-image" src="" width="150" alt="Car Image"></p>
                                <p id="car-voltage" class="card-text"></p>
                                <p id="car-capacity" class="card-text"></p>
                                <p id="car-plug" class="card-text"></p>
                                <p id="car-category" class="card-text"></p>
                                <p id="car-description" class="card-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <label for="plug">Choose Your Plug Type</label>
                    <select name="plug" class="form-control select2" id="plug">
                        <option value="">Select your Plug Type</option>
                        @foreach ($plugs as $plug)
                            <option value="{{ $plug->id }}">{{ $plug->nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select your plug type</div>
                </div>
                <button type="button" class="btn btn-primary mt-3 next-step">Next</button>
            </div>
            <div class="form-step">
                <div class="form-group">
                    <label for="input_baterai">Remaining Battery</label>
                    <input type="number" class="form-control" id="input_baterai" name="input_baterai"
                        placeholder="Enter your battery level">
                    <div class="invalid-feedback">Please enter your battery level.</div>
                </div>
                <div class="form-group">
                    <label for="input_harga">Price Charging</label>
                    <input type="text" class="form-control" id="input_harga" name="input_harga"
                        placeholder="Enter your Price Charging">
                    <div class="invalid-feedback">Please enter your price charging.</div>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>

            <div class="form-step">
                <div class="form-group">
                    <label for="voltage">Choose Your Volt Charging Type</label> <br>
                    <select name="voltage" class="form-control" id="voltage">
                        <option value="">Select your Volt Charging Type</option>
                        @foreach ($volts as $volt)
                            <option value="{{ $volt->id }}">{{ $volt->voltage }}V ({{ $volt->type }})</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select your Volt Charging type</div>
                </div>
                <div class="form-group">
                    <label for="capacity">Choose Your Capacity Car</label> <br>
                    <select name="capacity" class="form-control" id="capacity">
                        <option value="">Select your Capacity Car</option>
                        @foreach ($capty as $captys)
                            <option value="{{ $captys->id }}">{{ $captys->amount_capacity }} kWh ({{ $captys->type }})
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Please select your Capacity Car</div>
                </div>
                <div class="form-group">
                    <label for="note">Note (optional): </label>
                    <textarea name="note" id="note" cols="30" rows="10" placeholder="Enter Your Note"
                        class="form-control"></textarea>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="submit" class="btn btn-success" id="submit">Submit</button>
            </div>
        </form>
    </body>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            function formatCarOption(car) {
                if (!car.id) {
                    return car.text;
                }
                var carImage = $(car.element).data('image');
                var $carOption = $('<span><img src="' + carImage +
                    '" class="img-flag" style="width: 20px; height: 20px; margin-right: 10px; padding-bottom:2px;" />' +
                    car.text +
                    '</span>');
                return $carOption;
            }

            function updateCarDetails(car) {
                if (car.val()) {
                    $('#car-details-container').show();
                    $('#car-name').text(car.data('name'));
                    $('#car-image').attr('src', car.data('image'));
                    $('#car-voltage').text('Voltage: ' + car.data('voltage'));
                    $('#car-capacity').text('Capacity: ' + car.data('capacity'));
                    $('#car-plug').text('Plug: ' + car.data('plug'));
                    $('#car-category').text('Category: ' + car.data('category'));
                    $('#car-description').text('Description: ' + car.data('description'));
                } else {
                    $('#car-details-container').hide();
                    $('#voltage').empty().append('<option value="">Select your Volt Charging Type</option>');
                }
            }

            $('.select2').select2({
                allowClear: false,
            });

            $('#car').on('change', function() {
                var selectedCar = $(this).find(':selected');
                updateCarDetails(selectedCar);
                localStorage.setItem('car', selectedCar.val());
            });

            $('#plug').on('change', function() {
                localStorage.setItem('plug', $(this).val());
            });

            $('#voltage').on('change', function() {
                localStorage.setItem('voltage', $(this).val());
            });

            $('#capacity').on('change', function() {
                localStorage.setItem('capacity', $(this).val());
            });

            $('#input_baterai').on('input', function() {
                localStorage.setItem('input_baterai', $(this).val());
            });

            $('#input_harga').on('input', function() {
                localStorage.setItem('input_harga', $(this).val());
            });

            $('#note').on('input', function() {
                localStorage.setItem('note', $(this).val());
            });

            function loadFromLocalStorage() {
                var storedCar = localStorage.getItem('car');
                if (storedCar) {
                    $('#car').val(storedCar).trigger('change');
                }

                var storedPlug = localStorage.getItem('plug');
                if (storedPlug) {
                    $('#plug').val(storedPlug).trigger('change');
                }

                var storedVoltage = localStorage.getItem('voltage');
                if (storedVoltage) {
                    $('#voltage').val(storedVoltage).trigger('change');
                }

                var storedCapacity = localStorage.getItem('capacity');
                if (storedCapacity) {
                    $('#capacity').val(storedCapacity).trigger('change');
                }

                var storedBattery = localStorage.getItem('input_baterai');
                if (storedBattery) {
                    $('#input_baterai').val(storedBattery);
                }

                var storedPrice = localStorage.getItem('input_harga');
                if (storedPrice) {
                    $('#input_harga').val(storedPrice);
                }

                var storedNote = localStorage.getItem('note');
                if (storedNote) {
                    $('#note').val(storedNote);
                }
            }

            loadFromLocalStorage();

            function validateStep($step) {
                var isValid = true;
                $step.find('select, input').each(function() {
                    if ($(this).attr('name') !== 'note' && $(this).val() === '') {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
                return isValid;
            }

            function setStep(stepIndex) {
                localStorage.setItem('currentStep', stepIndex);
                $('.form-step').removeClass('form-step-active');
                $('.form-step').eq(stepIndex).addClass('form-step-active');
            }

            $('.next-step').on('click', function() {
                var $currentStep = $(this).closest('.form-step');
                if (validateStep($currentStep)) {
                    var $nextStep = $currentStep.next('.form-step');
                    var nextStepIndex = $('.form-step').index($nextStep);
                    setStep(nextStepIndex);
                }
            });

            $('.prev-step').on('click', function() {
                var $currentStep = $(this).closest('.form-step');
                var $prevStep = $currentStep.prev('.form-step');
                var prevStepIndex = $('.form-step').index($prevStep);
                setStep(prevStepIndex);
            });

            $('#multiStepForm').on('submit', function(e) {
                var $currentStep = $('.form-step-active');
                if (!validateStep($currentStep)) {
                    e.preventDefault();
                }
            });

            var currentStep = localStorage.getItem('currentStep');
            if (currentStep) {
                setStep(currentStep);
            }

            $('#submit').on('click', function() {
                localStorage.clear();
            });
        });
    </script>
@endpush
