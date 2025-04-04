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

        <nav class="navbar bg-primary mb-3" data-bs-theme="dark">
            <header class="container">
                <a class="navbar-brand" href="#">2. Projekts - {{ $title }}</a>
            </header>
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

    </body>

</html>
