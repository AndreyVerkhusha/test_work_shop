<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Тестовое')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          crossorigin="anonymous"/>
    <style>
        .container-width {
            width: 1200px;
            max-width: 100%;
        }

        .alert-success {
            padding: 10px;
            text-align: center;
        }

        .btn-icon {
            width: fit-content !important;
            height: auto !important;
        }

        form {
            margin-bottom: 0;
        }

        th {
            width: 180px;
        }
    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-1">
        <div class="container container-width">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Переключатель навигации">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('products')) active @endif" href="/products">Товары</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('orders')) active @endif" href="/orders">Заказы</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="container py-4">
    @yield('content')
</main>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
