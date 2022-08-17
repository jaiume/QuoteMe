@php
/* @var \App\Models\Response $response */
@endphp

<div class="card request-card {{ $class }}">
    <div class="card-body">
        <div class="request-card__timestamp">{{ $response->created_at_relative }}</div>

        <div class="card-title">
            <strong>{{ $response->supplier->name }}</strong>
        </div>

        @if ($response->supplier->email)
            <div class="card-text request-card__text">
                <i>@lang('E-mail:')</i>
                {{ $response->supplier->email }}
            </div>
        @endif

        @if ($response->supplier->phone)
            <div class="card-text request-card__text">
                <i>@lang('Phone:')</i>
                {{ $response->supplier->phone }}
            </div>
        @endif

        <div class="card-text request-card__text mt-4">{{ $response->text }}</div>

        <div class="card-text request-card__text mt-2">
            <i>@lang('Price:')</i>
            @lang(':price TTD', ['price' => $response->price])
        </div>
    </div>
</div>
