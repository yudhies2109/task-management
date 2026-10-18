<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard - Task Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3">Dashboard</h1>

                <p>Selamat datang, {{ auth()->user()->name }}.</p>

                <p class="mb-0">
                    Role: {{ auth()->user()->role }}
                </p>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf

                    <button type="submit" class="btn btn-outline-danger">
                    Logout
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>