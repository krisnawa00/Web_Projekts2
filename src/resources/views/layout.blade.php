<!doctype html>
<html lang="lv">

    <head>
        <meta charset="utf-8">
        <title>2. Projekts - {{ $title }}</title>
        <meta name="description" content="Mans 2. Projekts">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC"
            crossorigin="anonymous"
        >
    </head>

    <body>

    <nav class="navbar navbar-expand-md bg-primary mb-3" data-bs-theme="dark">
    <div class="container">
        <span class="navbar-brand mb-0 h1">2. Projekts</span>
 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
 
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Sākumlapa</a>
                </li>
        <li class="nav-item">
                <a class="nav-link" href="/games">Spēles</a>
        </li>

        <li class="nav-item">
 <a class="nav-link" href="/genres">Žanri</a>
</li>

            @if(Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="/develepors">Develepors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Beigt darbu</a>
                    </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Autentificēties</a>
                </li>
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

        <footer class="text-bg-dark mt-3">
            <div class="container">
                <div class="row py-5">
                    <div class="col">
                        K. Immers, 2025
                    </div>
                </div>
            </div>
        </footer>
        <script src="/js/admin.js"></script>
    </body>

</html>
