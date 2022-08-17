<footer class="footer--narrow">
    <nav class="navbar navbar-expand navbar-light bg-light justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="https://info.quoteme.co.tt/">
                    @lang('About')
                </a>
            </li>

            {{-- Authentication Links --}}
            @guest
                <li class="nav-item">
                    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'customer.request.index') === 0) ? 'active' : '' }}" href="{{ route('customer.request.index') }}">@lang('Responses')</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'login') === 0) ? 'active' : '' }}" href="{{ route('login') }}">@lang('Supplier')</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'customer.request.index') === 0) ? 'active' : '' }}" href="{{ route('customer.request.index') }}">
                        @if ((bool)app('request')->unread_responses)
                            @lang('Responses (:count new)', ['count' => app('request')->unread_responses])
                        @else
                            @lang('Responses')
                        @endif
                    </a>
                </li>

                @if(!auth()->check() || !auth()->user()->hasRole(\App\Utils\PermissionUtils::ROLE_SUPPLIER))
                    <li class="nav-item">
                        <a class="nav-link {{ (strpos(Route::currentRouteName(), 'register') === 0) ? 'active' : '' }}" href="{{ route('register') }}">@lang('Supplier')</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        >
                            @lang('Logout')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endif
            @endguest
        </ul>
    </nav>
</footer>
