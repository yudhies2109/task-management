<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Frontend Test - Task Management</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3 mb-3">Task Management</h1>

                <div class="alert alert-success">
                    Bootstrap 5 berhasil dimuat!
                </div>

                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="collapse"
                    data-bs-target="#testCollapse"
                >
                    Test JavaScript Bootstrap
                </button>

                <div class="collapse mt-3" id="testCollapse">
                    <div class="card card-body">
                        JavaScript Bootstrap berhasil berjalan!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <livewire:test-counter />
    </div>


</body>
</html>