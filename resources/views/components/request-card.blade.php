@php
/* @var \App\Models\Request $request */

$now = \Illuminate\Support\Carbon::now();

$hasPhoto = $request->hasMedia('photo');

$url = '';
if ($hasPhoto) {
    $photo = $hasPhoto ? $request->getFirstMedia('photo') : null;
    if ($photo->hasGeneratedConversion('card')) {
        $url = $photo->getFullUrl('card');
    } else {
        $url = $photo->getFullUrl();
    }
}
@endphp

<div class="{{ $class }} card request-card" data-id="{{ $request->id }}">
    @if ($url)
        <img
            class="card-img-top"
            src="{{ $url }}"
            width="300"
            height="200"
            alt="@lang('Card photo')"
        >
    @else
        <img
            class="card-img-top"
            src="/img/photo-placeholder.png"
            width="300"
            height="200"
            alt="@lang('Card photo')"
        >
    @endif

    <div class="card-body">
        <div class="request-card__timestamp">{{ $request->created_at_relative }}</div>

        <div class="card-text request-card__text">{{ $request->text }}</div>

        <div class="request-card__values pt-2">
            @if ($request->category)
                <div class="request-card__values--row">
                    <div class="request-card__values--title">@lang('Category')</div>
                    <div class="request-card__values--value">{{ $request->category->name }}</div>
                </div>
            @endif

            @if ($request->area)
                <div class="request-card__values--row">
                    <div class="request-card__values--title">@lang('Area')</div>
                    <div class="request-card__values--value">{{ $request->area->name }}</div>
                </div>
            @endif

            @if ($request->url)
                <div class="request-card__values--row">
                    <div class="request-card__values--title">@lang('URL')</div>
                    <div class="request-card__values--value">
                        <a href="{{ $request->url }}" target="_blank" rel="noopener">
                            {{ \Illuminate\Support\Str::limit($request->url, 20) }}
                        </a>
                    </div>
                </div>
            @endif

            <div class="request-card__values--row">
                <div class="request-card__values--title"></div>
                <div class="request-card__values--value">
                    <div class="custom-control custom-checkbox">
                        <input
                            id="quick-reply-check"
                            class="custom-control-input"
                            type="checkbox"
                            disabled

                            @if($request->quick_reply)
                            checked
                            @endif
                        >
                        <label for="quick-reply-check" class="custom-control-label">@lang('Text Me')</label>
                    </div>
                </div>
            </div>

            <div class="request-card__values--row">
                <div class="request-card__values--title"></div>
                <div class="request-card__values--value">
                    <div class="custom-control custom-checkbox">
                        <input
                            id="quick-contact-check"
                            class="custom-control-input"
                            type="checkbox"
                            disabled

                            @if($request->quick_contact)
                                checked
                            @endif
                        >
                        <label for="quick-contact-check" class="custom-control-label">@lang('Call Me')</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!$hideButtons)
        <div class="card-footer">
            @if ($request->isNotCancelled())
                <a
                    href="{{ route('customer.request.update', ['id' => $request->id]) }}"
                    class="btn btn-sm btn-outline-danger mr-2"
                    onclick="event.preventDefault();"
                    data-micromodal-trigger="{{ 'confirmation-modal-' . $request->id }}"
                >
                    <i class="fas fa-times"></i>
                    @lang('Cancel')
                </a>
                <form action="{{ route('customer.request.update', ['id' => $request->id]) }}" method="POST" class="d-none update-form">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="cancelled" value="1">
                </form>

                @php
                    $formSelector = sprintf('.request-card[data-id=\"%s\"] form.update-form', $request->id);
                @endphp
                <x-confirmation-modal
                    :name="'confirmation-modal-' . $request->id"
                    :formSelector="$formSelector"
                    :title="__('Please confirm the action')"
                    :description="__('Are you sure you want to cancel the request? This action can\'t be undone.')"
                ></x-confirmation-modal>
            @else
                <div class="text-muted btn btn-sm pointer-events-none">@lang('Cancelled')</div>
            @endif

            @if ($request->hasResponses(true))
                <a class="btn btn-sm btn-primary" href="{{ route('customer.request.show', ['id' => $request->id]) }}">
                    <i class="fas fa-eye"></i>
                    @lang('View (:amount :responses)', ['amount' => $request->responseCount(true), 'responses' => \Illuminate\Support\Str::plural(__('response'), $request->responseCount(true))])
                </a>
            @else
                <a class="btn btn-sm btn-outline-primary" href="{{ route('customer.request.show', ['id' => $request->id]) }}">
                    <i class="fas fa-eye"></i>
                    @lang('View')
                </a>
            @endif
        </div>
    @else
        @if ($request->isCancelled())
            <div class="card-footer">
                <div class="text-muted btn btn-sm pointer-events-none">@lang('Cancelled')</div>
            </div>
        @endif
    @endif
</div>
