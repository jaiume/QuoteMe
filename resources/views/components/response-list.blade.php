<div class="{{ $class }} px-0 mt-4 mt-md-0 card">
    @if ($request->hasResponses())
        <div class="card-body p-0">
            <table class="table table-borderless table-hover table-responsive-sm d-none d-md-table">
                <thead>
                <tr>
                    <th scope="col">@lang('#')</th>
                    <th scope="col">@lang('Time')</th>
                    <th scope="col">@lang('From')</th>
                    <th scope="col">@lang('Price')</th>
                    <th scope="col">@lang('Text')</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($request->responses as $key => $response)
                        @php /* @var \App\Models\Response $response */ @endphp
                        <tr data-href="{{ route('customer.response.show', ['request_id' => $request->id, 'response_id' => $response->id]) }}">
                            @if ($response->viewed_at)
                                <td>{{ $key + 1 }}</td>
                                <td class="text-nowrap">{{ $response->created_at_relative }}</td>
                                <td>{{ $response->supplier->name }}</td>
                                <td class="text-nowrap">@lang(':price TTD', ['price' => $response->price])</td>
                                <td>{{ \Illuminate\Support\Str::limit($response->text, 16) }}</td>
                            @else
                                <th scope="row">{{ $key + 1 }}</th>
                                <th scope="row" class="text-nowrap">{{ $response->created_at_relative }}</th>
                                <th scope="row">{{ $response->supplier->name }}</th>
                                <th scope="row" class="text-nowrap">@lang(':price TTD', ['price' => $response->price])</th>
                                <th scope="row">{{ \Illuminate\Support\Str::limit($response->text, 20) }}</th>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-block d-md-none">
            @foreach ($request->responses as $key => $response)
                @php /* @var \App\Models\Response $response */ @endphp
                <div class="response-card @if(!$response->viewed_at) response-card--unread @endif card-body p-0">
                    <div class="response-card__content px-2 py-2">
                        <div>
                            <div class="response-card__content_from">{{ $response->supplier->name }}</div>
                            <div>@lang('Price: :price TTD', ['price' => $response->price])</div>
                            <div>{{ \Illuminate\Support\Str::limit($response->text, 20) }}</div>
                        </div>

                        <div class="response-card__content_timestamp text-muted">
                            {{ $response->created_at_relative }}
                        </div>
                    </div>
                </div>
                <a href="{{ route('customer.response.show', ['request_id' => $request->id, 'response_id' => $response->id]) }}" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></a>
            @endforeach
        </div>
    @else
        <div class="text-center py-2">
            @lang('You have no responses yet')
        </div>
    @endif
</div>
