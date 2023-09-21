<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>@yield('title')</title>
</head>
<body>
    {{-- @include('nav') --}}
    @livewire('navigation-menu')
    
    {{-- <div class="px-72 py-24"> --}}
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>
</body>
</html>