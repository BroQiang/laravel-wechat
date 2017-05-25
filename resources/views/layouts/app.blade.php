<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
@include('layouts.head')
<body>
    <div id="app">
        
        @include('layouts.navbar')

        @yield('content')
    </div>
	
	@include('layouts.footer')

    <!-- Scripts -->
    @include('layouts.scripts')
	
	@yield('scripts')

</body>
</html>
