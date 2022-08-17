@extends('layouts.app')

@section('content')
    <section class="content d-flex flex-row align-items-center justify-content-center min-vh-100">
        <div class="w-100 request-form d-flex flex-column justify-content-center align-items-center px-4">
            <div class="request-form__logo pb-4">
                <a href="/">
                    @include('partials.logo')
                </a>
            </div>

            <div class="container">
                <div class="row">
                    <x-request-card :request="$request" :hide-buttons="true" class="col-12 col-md-6 col-lg-4 px-0" />

                    <x-response-list :request="$request" :full="false" class="col-12 col-md-6 col-lg-8" />
                </div>
            </div>
        </div>
    </section>
@endsection
