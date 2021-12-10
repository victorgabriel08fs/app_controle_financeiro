<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">


        <main class="index-main">
            <h1>Controle Financeiro</h1>
            <p>Organize suas receitas e despesas de forma simples e rápida</p>
            <div>
                <a href="{{route('login')}}" class="btn btn-secondary mb-3">Entre</a>
                <a href="{{route('register')}}" class="btn btn-secondary mb-3">Faça seu cadastro</a>
            </div>
        </main>
    </div>
    <footer>
        <p>{{ config('app.name', 'Laravel') }} é um sistema desenvolvimento por Victor Gabriel, únicamento para
            aprendizado.
            <br>
            Acesse o <a target="_blank" href="https://github.com/victorgabriel08fs"><i class="fab fa-github"></i></a>
            para este e outros projetos
        </p>
    </footer>
</body>

</html>
