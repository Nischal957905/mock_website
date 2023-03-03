<!DOCTYPE html>
<html lang="en">
@include('header')
<body>
    <body>
        <header>
            <nav>
                @include('nav')

            </nav>
        </header>
        <div class="sidebar-wrap">
            @if (Auth::check() && Auth::user()->isAdmin())
                @include('sidebar')
            @endif
            <div class="body-part">
                @yield('mock')
                @yield('mockeach')
                @yield('score')
                @yield('createQuestion')
                @yield('createSubject')
                @yield('selectSubject')
                @yield('mocklist')
                @yield('check')
                @yield('profile')
            </div>
        <div>
    </body>
</body>
</html>