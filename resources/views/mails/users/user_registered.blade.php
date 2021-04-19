@component('mail::message')

Notification for <strong>{{ $user->name }} {{ $user->surname }} </strong> at <em><strong>{{ config('app.name') }}</strong></em>

Welcome, <strong>{{ $user->name }} {{ $user->surname }} </strong> <br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
