<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cart') }}
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
      <x-jet-validation-errors class="mb-3" />
      <div class="cart-table table-responsive mb-30">
        <table class="table">
            <thead>
                <tr>
                    <th class="pro-thumbnail">Image</th>
                    <th class="pro-title">Product</th>
                    <th class="pro-price">Price</th>
                    <th class="pro-quantity">Quantity</th>
                    <th class="pro-subtotal">Total</th>
                    <th class="pro-remove">Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                  <tr>
                    <td class="pro-thumbnail"><a href="#"><img
                      src=@php echo \Illuminate\Support\Facades\Storage::url() @endphp
                      alt="product_pic"
                      width="480"
                      height="480"
                      class="img-fluid mt-3"
                    /></a></td>
                    <td class="pro-title"><a href="#">Black Die Grinder</a></td>
                    <td class="pro-price"><span>$25.00</span></td>
                    <td class="pro-quantity">
                        <div class="pro-qty"><input type="number" value="1"></div>
                    </td>
                    <td class="pro-subtotal"><span>$25.00</span></td>
                    <td class="pro-remove"><a href="#"><i class="far fa-trash-alt fa-lg"></i></a></td>
                  </tr>
                {{-- <tr>
                    <td class="pro-thumbnail"><a href="#"><img src="" alt="Product"></a></td>
                    <td class="pro-title"><a href="#">Orange Decker drill</a></td>
                    <td class="pro-price"><span>$25.00</span></td>
                    <td class="pro-quantity">
                        <div class="pro-qty"><input type="number" value="1"></div>
                    </td>
                    <td class="pro-subtotal"><span>$25.00</span></td>
                    <td class="pro-remove"><a href="#"><i class="fas fa-trash fa-lg"></i></a></td>
                </tr> --}}
            </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>


