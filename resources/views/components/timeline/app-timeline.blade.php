<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title . ' | Solan App' ?? 'Solan App' }}</title>
    <link rel="stylesheet" href="/assets/plugins/gantt-chart/dhtmlxgantt.css" type="text/css">
    @livewireStyles
    @stack('styles')
</head>

<body>
    {{ $slot }}

    <!-- Core JS -->
    <script src="/assets/vendor/js/core.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js?v=5.2.4"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js?v=5.2.4"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css?v=5.2.4"> --}}
    <script src="/assets/plugins/gantt-chart/dhtmlxgantt.js"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
