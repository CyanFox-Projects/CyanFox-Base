<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', setting('app_lang')) }}" @if(auth()->user())
    data-theme="{{ auth()->user()->theme }}"
      @if(
    auth()->user()->getColorScheme() == 'dark'
    ) class="dark" @endif>
@endif
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="CyanFox-Team">

    <title>{{ setting('app_name') }} | {{ $title ?? 'Page Title' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/Logo.png') }}">

    @filamentStyles
    @vite(['resources/css/app.css'])
    @livewireStyles
    @livewireScripts
</head>
<body class="antialiased flex flex-col min-h-screen">
@livewire('notifications')
@livewire('wire-elements-modal')


<x-navigation.sidebar :content="$slot"/>

<x-navigation.footer/>

<x-spotlight
    shortcut="ctrl.x"
/>

@filamentScripts
@vite('resources/js/app.js')
<script src="{{ asset('js/logger.js') }}"></script>

</body>
</html>
