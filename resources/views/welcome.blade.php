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
  <div class="container my-3 pt-5 px-5">

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
</body>
</html>
