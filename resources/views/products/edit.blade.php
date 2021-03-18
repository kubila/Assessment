<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
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
      <div class="card-body">
        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group">
                <x-jet-label for="productName" value="{{ __('Product Name') }}" />

                <x-jet-input class="{{ $errors->has('productName') ? 'is-invalid' : '' }}" type="text" name="productName"
                             value="{{ $product->productName }}" required autofocus autocomplete="productName" />
                <x-jet-input-error for="productName"></x-jet-input-error>
            </div>

            <div class="form-group">
              <x-jet-label for="description" value="{{ __('Description') }}" />

              <x-jet-input class="{{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description"
                value="{{ $product->description }}" required autofocus autocomplete="description" />
              <x-jet-input-error for="description"></x-jet-input-error>
            </div>

            <div class="form-group">
                <x-jet-label for="price" value="{{ __('Price') }}" />

                <x-jet-input class="{{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price"
                  value="{{ $product->price }}" required autofocus min="0.00" max="100000000.00" step="0.01" />
                <x-jet-input-error for="price"></x-jet-input-error>
            </div>

            <div class="form-group">
              <x-jet-label for="category_id" value="{{ __('Select a category') }}" />

              <select name="category_id" class="d-block w-100 mt-1 w-full border border-light rounded-md shadow-sm">
                @foreach ($cats as $item)
                    <option value="{{ isset($product->category_id) && $item->id === $product->category_id ? $product->category->id : $item->id }}" {{ isset($product->category_id) && $item->id === $product->category_id ? 'selected' : '' }}>{{ isset($product->category_id) && $item->id === $product->category_id ? $product->category->name : $item->name }}</option>

                @endforeach
            </select>
              <x-jet-input-error for="category_id"></x-jet-input-error>
            </div>

            <div class="form-group my-4">
              <img
                  src=@php echo \Illuminate\Support\Facades\Storage::url($product->image) @endphp
                  alt="product_pic"
                  width="360"
                  height="360"
                  class="img-fluid"
                />
            </div>

            <div class="form-group">
              <x-jet-label for="image" value="{{ __('Image') }}" />
              <x-jet-input class="{{ $errors->has('image') ? 'is-invalid' : '' }}" type="file" name="image" width="120" height="120"
                           autofocus />
              <x-jet-input-error for="image"></x-jet-input-error>
            </div>

            <div class="mb-0">
              <x-jet-button>
                {{ __('Update') }}
              </x-jet-button>
            </div>
          </form>
    </div>
    </div>
  </div>
</x-app-layout>
