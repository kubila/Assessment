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
        @can('manage-categories')
          <div class="my-3">
            <a href="{{ route('categories.create') }}" class="btn btn-dark"><i class="fas fa-plus-square"></i><span class="ml-2">Add Category</span></a>
            <hr>
          </div>
        @endcan
        <div class="table-responsive">
          <table class="table table-sm table-hover bg-white">
            <thead>
              <tr>
                <th class="w-auto text-left align-middle">No</th>
                <th class="w-auto text-left align-middle text-primary">Category Name</th>
                @can('manage-categories')
                  <th class="w-auto text-dark text-center align-middle buttons"><strong>Actions</strong></th>
                @endcan
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="w-auto text-left align-middle">No</th>
                <th class="w-auto text-left align-middle text-primary">Category Name</th>
                @can('manage-categories')
                  <th class="w-auto text-dark text-center align-middle buttons"><strong>Actions</strong></th>
                @endcan
              </tr>
            </tfoot>
            <tbody>
            @if ($data->count() > 0)
              @foreach ($data as $item)
                <tr class="">

                  <td class="text-left align-middle text-justify">{{ $item->id }}</td>

                  @auth
                    <td class="text-left align-middle text-justify">
                      <a id="category_title" href="{{ route('categories.show', $item->id) }}" class="text-primary">{{$item->name }}</a>
                    </td>
                  @else
                    <td class="text-left align-middle text-justify">
                      <a id="category_title" href="{{ route('showCategoryProducts', $item->id) }}" class="text-primary">{{$item->name }}</a>
                    </td>
                  @endauth

                  @can('manage-categories')

                    <td class="text-center align-middle text-justify">
                      <div class="pb-1 pr-1 d-inline-block">
                        <a class="btn btn-secondary btn-sm " id="category_edit" href="{{ route('categories.edit', $item->id) }}">
                          <i class="fas fa-edit"></i>
                        </a>
                      </div>

                      <div class="pr-1 d-inline-block">
                        <button type="button" class="btn btn-danger btn-sm" id="category_delete" value="{{ $item->id }}">
                          <i class="fas fa-times-circle"></i>
                        </button>
                      </div>
                    </td>
                  @endcan
                </tr>
              @endforeach
            @else
              <div class="mx-auto">No records to display.</div>
            @endif
            </tbody>
          </table>
          <hr>
        </div> <!-- table-responsive -->

        <div class="mt-4 d-flex justify-content-center">{{ $data->links() }}</div>
      </div>
  </div>

  <div class="modal fade" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" id="confirmCloseCategoryDelete" class="close pr-3 pt-2" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <h5 class="lead">Are you sure?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="confirmCancelCategoryDelete" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="confirmCategoryDelete" data-dismiss="modal">Delete</button>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
