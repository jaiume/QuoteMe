@extends('layouts.app')

@section('content')
    <section class="content d-flex flex-row align-items-center justify-content-center min-vh-100">
        <div class="request-form d-flex flex-column justify-content-center align-items-center px-4">
            <div class="request-form__logo pb-4">
                <a href="/">
                    @include('partials.logo')
                </a>
            </div>

            <form method="post" enctype="multipart/form-data" action="{{ route('customer.request.store') }}" class="request-form__form needs-validation" novalidate>
                @csrf

                <div class="form-group">
                    @if($email)
                        <input type="hidden" name="email" value="{{ $email }}">
                    @endif
                    <input
                        name="email"
                        type="email"
                        class="form-control masked @error('email') is-invalid @enderror email-check"
                        placeholder="@lang('Email Address')"
                        value="{{ old('email', $email) }}"
                        autocomplete="email"
                        required
                        @if($email)
                            disabled
                        @endif
                    >

                    @error('email')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror

                    <div class="valid-feedback" role="alert">
                        @lang('Looks like that you\'re already registered. Do you want to :sign_in again?', [
                            'sign_in' => sprintf(
                                '<a class="customer-auth-link" href="%s">%s</a>',
                                route('customer.login'),
                                __('sign in')
                            )
                        ])
                    </div>
                </div>

                <div class="form-group">
                    <input
                        name="name"
                        type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="@lang('Name')"
                        value="{{ old('name', $name) }}"
                        autocomplete="name"
                        autofocus
                        required
                    >

                    @error('name')
                    <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <select
                        id="category-select"
                        name="category[]"
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

                    @error('category')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <select
                        id="area-select"
                        name="area[]"
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

                <div class="form-group">
                    <textarea
                        name="description"
                        class="form-control @error('description') is-invalid @enderror"
                        rows="4"
                        placeholder="@lang('Description of what you are looking for')"
                        autocomplete="off"
                        required
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input
                        name="url"
                        type="text"
                        class="form-control @error('url') is-invalid @enderror"
                        placeholder="@lang('Web Link with description')"
                        autocomplete="off"
                        value="{{ old('url', '') }}"
                    >

                    @error('url')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="photo-input" class="btn btn-primary btn-block btn-upload @error('photo') btn-danger @enderror">@lang('Upload Photo')</label>
                    <input
                        id="photo-input"
                        class="@error('photo') is-invalid @enderror"
                        name="photo"
                        type="file"
                        accept="image/*"
                        value=""
                    >

                    @error('photo')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input
                            id="quick-reply-check"
                            class="custom-control-input @error('quick_reply') is-invalid @enderror"
                            name="quick_reply"
                            type="checkbox"
                            value="1"

                            @if(old('quick_reply') === "1")
                                checked
                            @endif
                        >
                        <label for="quick-reply-check" class="custom-control-label">@lang('Suppliers can text me')</label>

                        @error('quick_reply')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input
                            id="quick-contact-check"
                            class="custom-control-input @error('quick_contact') is-invalid @enderror"
                            name="quick_contact"
                            type="checkbox"
                            value="1"

                            @if(old('quick_contact') === "1")
                                checked
                            @endif
                        >
                        <label for="quick-contact-check" class="custom-control-label">@lang('Suppliers can call me')</label>

                        @error('quick_contact')
                            <div class="invalid-feedback" role="alert">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input
                        id="phone-input"
                        name="phone"
                        type="tel"
                        class="form-control masked @error('phone') is-invalid @enderror"
                        placeholder="@lang('Phone Number')"
                        value="{{ old('phone', $phone) }}"
                        data-mask="+0 (000) 000-0000"
                        autocomplete="tel"
                    >

                    @error('phone')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-danger btn-block">@lang('QuoteMe!')</button>
                </div>
            </form>
        </div>
    </section>
@endsection
