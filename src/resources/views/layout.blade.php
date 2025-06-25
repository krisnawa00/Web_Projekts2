<!doctype html>
<html lang="lv">

<head>
    <meta charset="utf-8" />
    <title>2. Projekts - {{ $title }}</title>
    <meta name="description" content="Mans 2. Projekts" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC"
        crossorigin="anonymous"
    />
</head>

<body>

<nav class="navbar navbar-expand-md bg-primary mb-3" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand mb-0 h1" href="/">2. Projekts</a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/">Sākumlapa</a></li>
                <li class="nav-item"><a class="nav-link" href="/games">Spēles</a></li>
                <li class="nav-item"><a class="nav-link" href="/genres">Žanri</a></li>

                @if(Auth::check())
                    <li class="nav-item"><a class="nav-link" href="/develepors">Develepors</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout">Beigt darbu</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Autentificēties</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<main class="container">
    <div class="row">
        <div class="col">
            @yield('content')
        </div>
    </div>
</main>

<footer class="text-bg-dark mt-3 py-3">
    <div class="container">
        <div class="row">
            <div class="col">
                Kristers Rudzītis, 2025
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle with Popper included -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoE5G3z0XNQ1P9TJT9SVXYV0CRklLcqeBq0OW4JKmBsyvfl"
    crossorigin="anonymous"
></script>

<script src="/js/admin.js"></script>

</body>

</html>
