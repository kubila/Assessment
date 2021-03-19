<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Product') }}
      </h2>
  </x-slot>

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

  <div class="row">
    <div class="col-md-12">
      <hr>
      <div class="row">
        <div class="col-md-3">
          <div class="mx-3 my-3">
            <div class="p-4">
              <img
              src=@php echo \Illuminate\Support\Facades\Storage::url($data->image) @endphp
              alt="product_pic"
              width="480"
              height="480"
              class="img-fluid mt-3"
            />
            </div>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="mx-2 my-3">
            <div class="p-4 mt-4">
              <div class="p-2"><h4 class="text-justify">{{ $data->productName }}</h4></div>
              <div class="p-2 text-justify"><p class="text-justify">{{ $data->price }}</p></div>
              <div class="p-2"><p class="text-justify">{{ $data->description }}</p></div>
              <div class="p-2 text-justify"><a class="btn btn-dark" href="#" value="">Add To Cart</a></div>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
  </div>
</x-app-layout>
