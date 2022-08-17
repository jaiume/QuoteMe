@extends('layouts.app')

@section('content')
<div class="text-center mb-4">
    <a href="/">
        @include('partials.logo')
    </a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register as a supplier') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone-input" class="col-md-4 col-form-label text-md-right">
                                @lang('Phone Number')
                            </label>

                            <div class="col-md-6">
                                <input
                                    id="phone-input"
                                    name="phone"
                                    type="tel"
                                    class="form-control masked @error('phone') is-invalid @enderror"
                                    placeholder="+1 868 123-45-67"
                                    value="{{ old('phone') ?? $phone }}"
                                    data-mask="+0 (000) 000-0000"
                                    autocomplete="tel"
                                >

                                @error('phone')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        id="quick-notify-check"
                                        class="custom-control-input @error('quick_notify') is-invalid @enderror"
                                        name="quick_notify"
                                        type="checkbox"
                                        value="1"
                                        @if(old('quick_notify') === "1")
                                            checked
                                        @endif
                                    >
                                    <label for="quick-notify-check" class="custom-control-label">@lang('Quick Notify')</label>

                                    @error('quick_notify')
                                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select
                                    id="categories"
                                    name="categories[]"
                                    class="form-control @error('category') is-invalid @enderror"
                                >
                                    <option name="category" value="">@lang('Category')</option>
                                    @foreach($categories as $item)
                                        @if (!$item['disabled'])
                                            @if(collect(old('category') ?? [])->contains((string)$item['value']))
                                                <option value="{{ $item['value'] }}" selected>{{ $item['label'] }}</option>
                                            @else
                                                <option value="{{ $item['value'] }}">{{ $item['label'] }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>

                                @error('category.*')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror

                                @error('category')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="area" class="col-md-4 col-form-label text-md-right">{{ __('Area') }}</label>

                            <div class="col-md-6">
                                <select
                                    id="areas"
                                    name="areas[]"
                                    class="form-control @error('area') is-invalid @enderror"
                                >
                                    <option value="">@lang('Area')</option>
                                    @foreach ($areas as $item)
                                        @if(collect(old('area') ?? [])->contains((string)$item['value']))
                                            <option value="{{ $item['value'] }}" selected @if($item['disabled']) disabled @endif>{{ $item['label'] }}</option>
                                        @else
                                            <option value="{{ $item['value'] }}" @if($item['disabled']) disabled @endif>{{ $item['label'] }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('area.*')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror

                                @error('area')
                                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
