@if($requests->isNotEmpty())
    <div class="w-100 row justify-content-center request-list">
        @foreach ($requests as $key => $request)
            <x-request-card :request="$request" class="col-12 col-md-6 col-lg-4 px-0 mx-3 mb-3" />
        @endforeach
    </div>
@else
    <div class="request-list request-list--empty">
        @lang('No requests found')
    </div>
@endif
