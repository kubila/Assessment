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

      @if (count(Cart::content()))
      <div class="cart-table table-responsive mb-30">
        <table class="table">
            <thead>
                <tr>
                    <th class="pro-title">Product</th>
                    <th class="pro-price">Price</th>
                    <th class="pro-quantity">Quantity</th>
                    <th class="pro-subtotal">Total</th>
                    <th class="pro-remove">Remove</th>
                </tr>
            </thead>
            <tbody>
              {{-- {{ dd(Cart::content()) }} --}}
              @foreach (Cart::content() as $item)
                    <td class="pro-title"><a href="{{ route('products.show', $item->id) }}">{{ $item->name }}</a></td>
                    <td class="pro-price"><span>{{ $item->price }}</span></td>
                    <td class="pro-quantity">
                        <div class="pro-qty"><input type="number" value="{{ $item->qty }}" disabled></div>
                    </td>
                    <td class="pro-subtotal"><span>{{ $item->subtotal }}</span></td>
                    <td class="pro-remove"><a href="#"><i class="far fa-trash-alt fa-lg"></i></a></td>
                  </tr>
                @endforeach
            </tbody>
        </table>
      </div>
      @else
        <div class="text-center"><h4 class="lead">No item in the cart yet.</h4></div>
      @endif
    </div>
  </div>
</x-app-layout>


