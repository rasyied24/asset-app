<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('assets/demo1/src/images/favicon.png') }}">
    <!-- Page Title  -->
    <title>Asset App</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/demo1/src/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('assets/demo1/src/assets/css/theme.css?ver=3.1.2') }}">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            @yield('content')
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('assets/demo1/src/assets/js/bundle.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('assets/demo1/src/assets/js/scripts.js?ver=3.1.2') }}"></script>

    @yield('scripts')
</body>

</html>
