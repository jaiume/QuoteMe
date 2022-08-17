<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('page-title')
        <title>@yield('page-title') — {{ config('app.name') }}</title>
        <meta property="og:title" content="@yield('page-title') — {{ config('app.name') }}"/>
    @else
        <title>{{ config('app.name') }}</title>
        <meta property="og:title" content="{{ config('app.name') }}"/>
    @endif

    @hasSection('page-description')
        <meta name="description" content="@yield('page-description')">
        <meta property="og:description" content="@yield('page-description')"/>
    @endif

    {{-- Scripts --}}
    <script type="text/javascript" src="{{ mix('js/manifest.js') }}" defer></script>
    <script type="text/javascript" src="{{ mix('js/vendor.js') }}" async defer></script>

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    {{-- Styles --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ mix('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ mix('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ mix('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ mix('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ mix('favicon/safari-pinned-tab.svg') }}" color="#ed1c24">
    <meta name="apple-mobile-web-app-title" content="QuoteMe">
    <meta name="application-name" content="QuoteMe">
    <meta name="msapplication-TileColor" content="#ed1c24">
    <meta name="theme-color" content="#ed1c24">

<script type="text/javascript">
_linkedin_partner_id = "2855938";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script>
<script type="text/javascript">
(function(){var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})();
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=2855938&fmt=gif" />
</noscript>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-1196163-24"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-1196163-24');
  gtag('config', 'AW-1068683093');
</script>

<!-- Event snippet for Sign-up conversion page -->
<script>
  gtag('event', 'conversion', {'send_to': 'AW-1068683093/tHDXCN_a7vgBENWey_0D'});
</script>




</head>
<body>
    @include('partials.nav')

    <main>
        @yield('content')

        @include('partials.footer')
    </main>

    <script>
        window.addEventListener('load', () => {
            @if (session('success'))
                window.notyf.success("{{ session('success') }}");
            @endif

            @if (session('warning'))
                window.notyf.open({
                    type: 'warning',
                    message: '{{ session("warning") }}'
                });
            @endif

            @if (session('info'))
                window.notyf.open({
                    type: 'info',
                    message: '{{ session("info") }}'
                });
            @endif

            @if (session('error'))
                window.notyf.error("{{ session('error') }}");
            @endif

            @if (session('errors'))
                window.notyf.error("{{ __('Validation Errors') }}");
            @endif
        });
    </script>

    {{-- Scripts --}}
    <script type="text/javascript" src="{{ mix('js/app.js') }}" async defer></script>
</body>
</html>
