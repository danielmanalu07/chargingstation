<!-- ======= Header ======= -->
{{-- <header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#">Brand</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/cs') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/mycharge') }}">My Charging</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::guard('user')->user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" id="logout" href="/user/logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> --}}
<header id="header">
    <div class="container">

        {{-- <div id="logo" class="pull-left">
            <a href="#hero"><img src="" alt="" title="" /></img></a>
            <!-- Uncomment below if you prefer to use a text logo -->
            <!--<h1><a href="#hero">Regna</a></h1>-->
        </div> --}}
        <a class="navbar-brand mx-auto text-white " href="{{ url('/user/dashboard') }}">Charging</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        <nav id="nav-menu-container">
            <ul class="nav-menu">
                <li class="menu"><a href="{{ url('/user/dashboard') }}">Home</a></li>
                <li class="menu"><a href="{{ url('/user/cs') }}">Charging Session</a></li>
                <li class="menu"> <a href="{{ url('/user/mycharge') }}  ">My Charging</a></li>
                
                <li class="menu-has-children"><a href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::guard('user')->user()->name }}
                    </a>
                    <ul class="dropdown-menu" >
                        <li><a id="logout" href="/user/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->
@push('js')
<script>
    $(document).ready(function() {
            $('#logout').on('click', function() {
                localStorage.clear();
            });
        });
</script>
@endpush