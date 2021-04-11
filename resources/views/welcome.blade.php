<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Assessment Project</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script defer src="{{ asset('fa/js/all.min.js') }}"></script>

    <style>
        body {
            font-family: 'Nunito';
            background: #f7fafc;
        }
    </style>
</head>
<body>
  <div style="min-height: 100vh; position: relative;">
  <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand mr-4" href="/">
            <x-jet-application-mark width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              @auth
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="navigation-link">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')" class="navigation-link">
                  {{ __('Products') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.index')" class="navigation-link">
                  {{ __('Categories') }}
                </x-jet-nav-link>
              @else
                <x-jet-nav-link href="{{ route('welcome') }}" :active="request()->routeIs('welcome')" class="navigation-link">
                    {{ __('Home') }}
                </x-jet-nav-link>
                <x-jet-nav-link href="{{ route('showCategories') }}" :active="request()->routeIs('showCategories')" class="navigation-link">
                  {{ __('Categories') }}
                </x-jet-nav-link>
              @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-baseline">
              @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/dashboard') }}" class=" navigation-link text-muted">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="navigation-link text-muted">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="navigation-link ml-4 text-muted">Register</a>
                        @endif
                    @endauth
                  </div>
                @endif
            </ul>
        </div>
    </div>
</nav>
  <div class="container my-3 pt-5 px-5" style="padding-bottom: 10rem;">

    @if (session('error'))
      <div class="container">
          <div class="alert alert-danger text-center">{{ session('error') }}</div>
      </div>
    @endif

    @if (session('success'))
      <div class="container">
          <div class="alert alert-success text-center">{{ session('success') }}</div>
      </div>
    @endif

    <div class="row justify-content-center px-4">
      <div class="col-md-12">
        <div class="mx-auto"><h5>Listing products for visitors, price appears only when you're logged in.</h5></div>
        <div class="row">
          @foreach ($data as $item)
            <div class="col-md-4 col-lg-3 col-sm-6 my-2">
              <div
                class="bg-light card product rounded-lg mx-1"
                >
                <div class="p-4">
                  <div class="d-flex justify-content-center align-items-start">
                    <a href="{{ route('showProduct', $item->id) }}">
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

                      <a href="{{route('showProduct', $item->id) }}" class="text-justify">
                        {{ $item->productName }}
                      </a>
                      @auth
                        <div class="">
                          <p class="text-muted mb-0">{{ $item->price }}</p>
                        </div>
                      @endauth
                    </div>
                  </div>
                  {{-- <div class="d-flex justify-content-center pt-2">{{ date('F d, Y', strtotime($item->created_at)) }}</div> --}}
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
  <footer  id="footer">
    <div class="d-flex justify-content-between">
      <div class="mt-3 ml-2">
        <p>All rights reserved <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </div>
      <div class="mt-3 ml-2">

        <p class="lead">&copy; {{ now()->year()->format('Y-m-d') }}  @ {{ config('app.name') }}  </p>
      </div>
      <div class="mt-3 ml-2">
        <a href="#" onclick="window.scrollTo({top: 0, left:0, behavior: 'smooth'});"><svg class="svg-icon" viewBox="0 0 20 20">
          <path d="M13.889,11.611c-0.17,0.17-0.443,0.17-0.612,0l-3.189-3.187l-3.363,3.36c-0.171,0.171-0.441,0.171-0.612,0c-0.172-0.169-0.172-0.443,0-0.611l3.667-3.669c0.17-0.17,0.445-0.172,0.614,0l3.496,3.493C14.058,11.167,14.061,11.443,13.889,11.611 M18.25,10c0,4.558-3.693,8.25-8.25,8.25c-4.557,0-8.25-3.692-8.25-8.25c0-4.557,3.693-8.25,8.25-8.25C14.557,1.75,18.25,5.443,18.25,10 M17.383,10c0-4.07-3.312-7.382-7.383-7.382S2.618,5.93,2.618,10S5.93,17.381,10,17.381S17.383,14.07,17.383,10"></path>
        </svg></a>
      </div>
    </div>
  </footer>
</div>
</body>
</html>
