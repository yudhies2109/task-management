<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }
};
?>

<div class="card mt-4">
    <div class="card-body">
        <h2 class="h5">Uji Livewire</h2>

        <p>Jumlah: {{ $count }}</p>

        <button
            type="button"
            class="btn btn-primary"
            wire:click="increment"
            wire:loading.attr="disabled"
        >
            Tambah
        </button>
    </div>
</div>