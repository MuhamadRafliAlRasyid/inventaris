<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Barang;

class BarangTable extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        $barang = Barang::where('nama_barang', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'asc')
            ->paginate(10);

        return view('livewire.barang-table', [
            'barang' => $barang,
        ]);
    }
}
