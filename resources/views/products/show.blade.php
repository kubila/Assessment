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
        <div class="col-lg-3">
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
            <div class="p-4 mt-4 ml-2">
              <div class="p-2"><h4 class="text-justify">{{ $data->productName }}</h4></div>
              @auth
                <div class="p-2 text-justify"><p class="text-justify">{{ $data->price }}</p></div>
              @endauth
              <div class="p-2"><p class="text-justify">{{ $data->description }}</p></div>
              @can('manage-cart')
                <div class="p-2 text-justify"><a class="btn btn-dark" href="{{ route('cart.store') }}" id="procuctSender" data-id="{{ $data->id }}" ><i class="fas fa-cart-plus fa-lg"></i><span class="ml-2">Add To Cart</span></a></div>
              @endcan
            </div>
          </div>
        </div>
      </div>
      <hr>
    </div>
  </div>
  <div class="alert alert-success alerter" id="productSuccessAlert" role="alert">
    <strong>Product added to cart successfully. </strong>
  </div>

  <div class="alert alert-danger alerter" id="productErrorAlert" role="alert" >
    <strong>Product couldn't added to cart.</strong>
  </div>

  <div class="modal fade" id="productDeleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="confirmCloseProductDelete" class="close pr-3 pt-2" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <h5 class="lead">Are you sure?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="confirmCancelProductDelete" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="confirmProductDelete" data-dismiss="modal">Delete</button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
