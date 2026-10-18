<div class="card shadow-sm">
    <div class="card-body p-4">
        <h1 class="h3 mb-4">Daftar Akun</h1>

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit="register">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    class="form-control @error('name') is-invalid @enderror"
                    autocomplete="name"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="form-control @error('email') is-invalid @enderror"
                    autocomplete="email"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="form-control @error('password') is-invalid @enderror"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    wire:model="password_confirmation"
                    class="form-control"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                wire:loading.attr="disabled"
                wire:target="register"
            >
                <span wire:loading.remove wire:target="register">
                    Daftar
                </span>
                <span wire:loading wire:target="register">
                    Memproses...
                </span>
            </button>
        </form>
    </div>
</div>