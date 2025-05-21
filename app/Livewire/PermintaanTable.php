<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Permintaan;

class PermintaanTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $permintaans = Permintaan::with(['barang', 'user'])
            ->whereHas(
                'barang',
                fn($q) =>
                $q->where('nama_barang', 'like', '%' . $this->search . '%')
            )
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.permintaan-table', compact('permintaans'));
    }
}
