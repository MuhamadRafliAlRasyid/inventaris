<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Permintaan;

class PermintaanTable extends Component
{
    use WithPagination;

    public string $context = 'index';
    public string $search = ''; // ✅ Tambahkan ini

    protected $updatesQueryString = ['search']; // Optional: agar tetap tersimpan di URL saat pindah halaman

    public function mount($context = 'index')
    {
        $this->context = $context;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset ke halaman pertama saat search berubah
    }

    public function render()
    {
        return view('livewire.permintaan-table', [
            'permintaans' => $this->getPermintaans(),
        ]);
    }

    private function getPermintaans()
    {
        return Permintaan::with(['user', 'mengetahuiUser', 'approvalUser', 'details'])
            ->when($this->search, function ($query) {
                $query->whereHas('details', function ($q) {
                    $q->where('nama_barang', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
