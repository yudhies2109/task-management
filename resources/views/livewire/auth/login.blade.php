<div class="card shadow-sm">
    <div class="card-body p-4">
        <h1 class="h3 mb-4">Login</h1>

        <form wire:submit="login">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="form-control @error('email') is-invalid @enderror"
                    autocomplete="username"
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="form-control @error('password') is-invalid @enderror"
                    autocomplete="current-password"
                    required
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100"
                wire:loading.attr="disabled"
                wire:target="login"
            >
                <span wire:loading.remove wire:target="login">Login</span>
                <span wire:loading wire:target="login">Memproses...</span>
            </button>
        </form>

        <p class="mt-3 mb-0 text-center">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
</div>