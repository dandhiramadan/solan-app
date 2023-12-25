<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title . ' | Solan App' ?? 'Solan App' }}</title>
    <link rel="stylesheet" href="/assets/plugins/gantt-chart/dhtmlxgantt.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/assets/plugins/chosen/chosen.css">
    @livewireStyles
    @stack('styles')
</head>

<body>
    {{ $slot }}

    <script src="/assets/plugins/chosen/jquery-3.3.1.min.js"></script>
    <script src="/assets/plugins/chosen/chosen.jquery.js"></script>
    <script src="/assets/plugins/gantt-chart/dhtmlxgantt.js"></script>
    @livewireScripts
    @stack('scripts')
</body>

</html>
