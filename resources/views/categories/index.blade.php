<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Categories List') }}
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
        <div class="my-3">
          <a href="{{ route('categories.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i><span class="ml-2">Create Category</span></a>
        </div>
        <div class="table-responsive">
          <table class="table table-sm table-hover bg-white">
            <thead>
              <tr>
                <th class="w-auto text-left align-middle thsize">No</th>
                <th class="w-auto text-left align-middle text-primary thsize">Category Name</th>
                <th class="w-auto text-secondary text-center align-middle buttons"><strong>Actions</strong></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="w-auto text-left align-middle thsize">No</th>
                <th class="w-auto text-left align-middle text-primary thsize">Category Name</th>
                <th class="w-auto text-secondary text-center align-middle buttons"><strong>Actions</strong></th>
              </tr>
            </tfoot>
            <tbody>
            @if ($data->count() > 0)
              @foreach ($data as $item)
              <tr class="trsize">

                <td class="text-left align-middle text-justify">{{ $item->id }}</td>

                <td class="text-left align-middle text-justify">
                  <a id="category_title" href="{{ route('categories.show', $item->id) }}" class="text-primary">{{$item->name }}</a>
                </td>

                <td class="text-center align-middle text-justify">
                  <div class="pb-1 pr-1 d-inline-block">
                    <a class="btn btn-secondary btn-sm " id="product_edit" href="{{ route('categories.edit', $item->id) }}">
                      <i class="fas fa-edit"></i>
                    </a>
                  </div>

                  <div class="pr-1 d-inline-block">
                    <button type="button" class="btn btn-danger btn-sm" id="product_delete" value="{{ $item->id }}" onclick="$.categoryRemove;">
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
        <div class="mt-4 d-flex justify-content-center">{{ $data->links() }}</div>
      </div>
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
          <h5 class="lead">Bu ürünü silmek istediğinize emin misiniz?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="confirmCancelProductDelete" data-dismiss="modal">Kapat</button>
          <button type="button" class="btn btn-danger" id="confirmProductDelete" data-dismiss="modal">Sil</button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
