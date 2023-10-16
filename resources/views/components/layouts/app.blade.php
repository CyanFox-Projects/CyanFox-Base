<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ auth()->user()->theme }}"
      @if(auth()->user()->theme == 'dark') class="dark" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ env('APP_NAME') }} | {{ $title ?? 'Page Title' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.png') }}">

    @filamentStyles
    @vite(['resources/css/app.css'])
    @livewireStyles
    @livewireScripts

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="antialiased">
@livewire('notifications')

<x-navigation.sidebar></x-navigation.sidebar>

{{ $slot }}


<!-- Scripts -->
@filamentScripts
@vite('resources/js/app.js')
</body>
</html>
