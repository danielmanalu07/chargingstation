<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electric charging</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assetsu/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Favicons -->
    <link href="{{asset('assetsu/img/c.jpg')}}" rel="icon">
    <link href="{{asset('assetsu/img/c.jpg')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
        rel="stylesheet">

    <!-- Bootstrap CSS File -->

    <!-- Libraries CSS Files -->
    <link href="{{asset('assetsu/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assetsu/lib/animate/animate.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{asset('assetsu/css/style2.css')}}" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-step {
            display: none;
        }

        .form-step-active {
            display: block;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            border-radius: 10px 10px 0 0;
        }

        .btn-primary,
        .btn-secondary,
        .btn-success {
            width: 100px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-primary:hover,
        .btn-secondary:hover,
        .btn-success:hover {
            transform: scale(1.05);
        }

        .footer {
            background-color: rgba(84,90,93,255);
            color: rgb(0, 0, 0);
            padding: 1rem;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: none;
            color: #dc3545;
        }

        .is-invalid+.invalid-feedback {
            display: block;
        }
    </style>
    @stack('css')
</head>

<body>
    @include('user.layout.header')

    <section id="hero">
        <div class="hero-container">
            <h1>Welcome to Smart pv-grid fast charging station </h1>
            <a href="{{ url('/user/cs') }}" class="btn-get-started">Get Started</a>
        </div>
    </section>

    <footer class="bg-secondary text-white text-center py-3 mt-auto">
        <p class="mb-0">&copy; 2024 Your Company. All rights reserved.</p>
    </footer>

    @stack('js')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('assetsu/js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script src="{{ asset('assetsu/js/main.js')}}"></script>


</body>

</html>