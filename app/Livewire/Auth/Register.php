<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        $this->reset([
            'name',
            'email',
            'password',
            'password_confirmation',
        ]);

        session()->flash('success', 'Registrasi berhasil. Silakan login.');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}