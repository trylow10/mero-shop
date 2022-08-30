<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book CD GAMES SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- font awsome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- My css -->
    <link rel="stylesheet" href="./css/styles.css">
    <!--default css -->
    <link rel="stylesheet" href="./css/app.css" />

    <!-- Alpine -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.7.1/cdn.js"></script>
</head>

<body>
    <!-- NAVBAR STARTS -->
    <nav class="navbar navbar-expand-lg nav-style">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TRYLOSHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa fa-bars" style="color:black ; font-size:26px"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Home</a>
                    </li>
                </ul>
                {{-- <form method="" action="{{ route('homepage') }}" class="form-inline my-2 my-lg-0">
                    @csrf
                    <input class="mr-sm-2" name="search" type="text" value="{{ request('search') }}"
                        placeholder="Search">
                    <button class="btn my-1 my-sm-0"
                        style="background-color:#5e5df0;color:#fff;padding:8px 12px">Search</button>
                </form> --}}

                <ul class="navbar-nav ms-auto">

                    @if (Route::has('login'))
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>


                            </li>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Log In</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endif @endauth
                        @endif





                    </ul>
                    <!-- Settings Dropdown -->

                    @auth
                        <div class="hidden sm:flex sm:items-center sm:ml-6">

                            <p
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            </p>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                                                                        this.closest('form').submit();">
                                    Log Out
                                </a>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
