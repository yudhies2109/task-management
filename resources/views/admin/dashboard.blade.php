<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Admin - Task Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3">Dashboard Admin</h1>

                <p>Selamat datang, {{ auth()->user()->name }}.</p>

                <div class="alert alert-success">
                    Halaman ini hanya dapat diakses oleh Admin.
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </main>
</body>
</html>