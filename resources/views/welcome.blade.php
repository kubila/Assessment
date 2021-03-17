<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito';
            background: #f7fafc;
        }
    </style>
</head>
<body>
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-muted" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
  {{-- <nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="{{ route('welcome') }}" >{{ config('app.name') }}</a>
    <div class="container-fluid p-4 justify-content-end">
      @if (Route::has('login'))
          <div class="">
              @auth
                  <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a>
              @else
                  <a href="{{ route('login') }}" class="text-muted">Log in</a>

                  @if (Route::has('register'))
                      <a href="{{ route('register') }}" class="ml-4 text-muted">Register</a>
                  @endif
              @endif
          </div>
      @endif
    </div>
  </nav> --}}
  <div class="container my-5 pt-5 px-5">
    <div class="row justify-content-center px-4">
      <div class="col-md-12">
        <div class="row">
          @foreach ($data as $item)
            <div class="col-md-4 col-lg-3 col-sm-6 my-2">
              <div
                class="bg-light product border border-dark rounded-lg mx-1"
                >
                <div class="p-4">
                  <div class="d-flex justify-content-center align-items-start">
                    <a href="#" target="_blank">
                      <img
                        src=@php echo \Illuminate\Support\Facades\Storage::url($item->image) @endphp
                        alt="product_pic"
                        width="360"
                        height="360"
                        class="img-fluid"
                      />
                    </a>
                  </div>
                  <div class="d-flex justify-content-center pt-3 align-items-end">
                    <div class="px-2">
                      <a href="#" target="_blank">
                        {{ $item->productName }}
                      </a>
                      <p class="text-secondary mb-0">{{ $item->price }}</p>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center pt-2">{{ date('F d, Y', strtotime($item->created_at)) }}</div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="mt-4">
        {{ $data->links() }}
      </div>
    </div>
  </div>
</body>
</html>
