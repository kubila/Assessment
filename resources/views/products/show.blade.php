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

    </div>
  </div>
</x-app-layout>
