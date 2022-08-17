@extends('layouts.app')

@php
/* @var \Illuminate\Support\Collection $requests */
@endphp

@section('content')
    <section class="content d-flex flex-row align-items-center justify-content-center min-vh-100">
        <div class="w-100 request-form d-flex flex-column justify-content-center align-items-center px-4">
            <div class="request-form__logo pb-4">
                <a href="/">
                    @include('partials.logo')
                </a>
            </div>

            <x-request-list :requests="$requests"></x-request-list>
        </div>
    </section>
@endsection
