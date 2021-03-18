<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Products List') }}
      </h2>
  </x-slot>

  <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <!-- Remove the id="dataTable" to remove the jQuery datatables from the table -->
          <table class="table table-sm table-hover bg-light " id="myDataTable">
            <thead>
              <tr>
                <th class="w-auto text-left align-middle thsize">Order No</th>
                <th class="w-auto text-left align-middle text-primary thsize">Product Name</th>
                <th class="w-auto text-left align-middle thsize">Image</th>
                <th class="w-auto text-left align-middle thsize">Description</th>
                <th class="w-auto text-left align-middle thsize">Price</th>
                <th class="w-auto text-primary text-left align-middle thsize">Category</th>
                <th class="w-auto text-secondary text-center align-middle buttons"><strong>Actions</strong></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="w-auto text-left align-middle thsize">Order No</th>
                <th class="w-auto text-left align-middle text-primary thsize">Product Name</th>
                <th class="w-auto text-left align-middle thsize">Image</th>
                <th class="w-auto text-left align-middle thsize">Description</th>
                <th class="w-auto text-left align-middle thsize">Price</th>
                <th class="w-auto text-primary text-left align-middle thsize">Category</th>
                <th class="w-auto text-secondary text-center align-middle buttons"><strong>Actions</strong></th>
              </tr>
            </tfoot>
            <tbody>
            @if ($data->count() > 0)
              @foreach ($data as $item)
              <tr class="trsize">
                <td class="text-left align-middle text-justify">{{ $item->id }}</td>

                <td class="text-left align-middle text-justify">
                  <a id="product_title" href="{{ route('products.show', $item->productName) }}" class="text-primary">{{$item->productName }}</a>
                </td>

                <td class="text-left align-middle text-justify"><img
                  src=@php echo \Illuminate\Support\Facades\Storage::url($item->image) @endphp
                  alt="product_pic"
                  width="90"
                  height="90"
                  class="img-fluid"
                /></td>

                <td class="text-left align-middle text-justify tdsize">{{ $item->description }}</td>

                <td class="text-left align-middle text-justify">{{ $item->price }}</td>

                <td class="text-left align-middle text-justify">
                  @if (isset($item->category))
                    <a id="product_category" href="{{ route('categories.show', $item->category->name) }}" class="text-primary">{{ $item->category->name }}</a>
                  @else
                    <button class="border-0 text-secondary"><h6 class="m-0">Deleted</h6></button>
                  @endif
                </td>

                <td class="text-center align-middle text-justify">
                  <div class="pb-1 pr-1 d-inline-block">
                    <a class="btn btn-secondary btn-sm " id="product_edit" href="{{ route('products.edit', $item->productName) }}">
                      <i class="fas fa-edit"></i>
                    </a>
                  </div>

                  <div class="pr-1 d-inline-block">
                    <button type="button" class="btn btn-danger btn-sm" id="product_delete" value="{{ $item->id }}" onclick="$.productRemove;">
                      <i class="fas fa-times-circle"></i>
                    </button>
                  </div>
                </td>

              </tr>

              @endforeach

            @endif

            </tbody>
          </table>
        </div> <!-- table-responsive -->
      </div>
  </div>
</x-app-layout>
