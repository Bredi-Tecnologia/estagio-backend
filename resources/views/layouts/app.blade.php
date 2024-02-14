<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>estagio-bredi</title>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<header class="d-flex justify-content-center">
    <h1 class="card-title mt-5">Controle de estoque</h1>
</header>

<main>
    @yield('content')
</main>

<footer class="d-flex justify-content-center">
    <p>&copy; {{ date('Y') }} Arthur Nunes</p>
</footer>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

