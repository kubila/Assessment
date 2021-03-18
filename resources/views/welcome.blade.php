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
  <nav class="navbar navbar-expand-sm navbar-light bg-light shadow-sm">
    <div class="container p-4">
      <a class="navbar-brand" href="{{ route('welcome') }}" >{{ config('app.name') }}</a>
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
  </nav>
  <div class="container my-3 pt-5 px-5">
    <div class="row justify-content-center px-4">
      <div class="col-md-12">
        <div class="mx-auto"><h5>Listing products for visitors, price appears only if you're logged in.</h5></div>
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

                      @auth
                        <p class="text-secondary mb-0">{{ $item->price }}</p>
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
