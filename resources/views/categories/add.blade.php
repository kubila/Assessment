<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($data) ? __('Edit Category') : __('Create Category') }}
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
        @if(isset($data))
          <form method="POST" action="{{ route('categories.update', $data->id) }}">
            @csrf @method('PUT')
        @else
          <form method="POST" action="{{ route('categories.store') }}">
            @csrf
        @endif
            <div class="form-group">
                <x-jet-label for="name" value="{{ __('Category Name') }}" />

                @if(isset($data))
                  <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    value="{{ $data->name }}" required autofocus autocomplete="name" />
                @else
                <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                  :value="old('name')" required autofocus autocomplete="name" />
                @endif
                <x-jet-input-error for="name"></x-jet-input-error>
            </div>
            <div class="mb-0">
              <x-jet-button>
                {{ isset($data) ?  __('Update') :  __('Create')  }}

              </x-jet-button>
            </div>
          </form>
    </div>
    </div>
  </div>
</x-app-layout>
