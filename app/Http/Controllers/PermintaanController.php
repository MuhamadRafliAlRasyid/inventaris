<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function indexUser()
    {
        $permintaans = Permintaan::where('id_user', Auth::id())->get();
        return view('permintaan.index', compact('permintaans'));
    }

    // Tampilkan form pengajuan untuk user
    public function create()
    {
        $barangs = Barang::all();
        return view('permintaan.create', compact('barangs'));
    }

    // Simpan pengajuan user
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Permintaan::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'id_user' => Auth::id(),
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('barangs.index')->with('success', 'Permintaan berhasil diajukan.');
    }
    // Menampilkan form edit untuk user (hanya permintaannya sendiri)
    public function editUser($id)
    {
        $permintaan = Permintaan::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $barangs = Barang::all();
        return view('permintaan.edit-user', compact('permintaan', 'barangs'));
    }

    // Menyimpan hasil edit dari user
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $permintaan = Permintaan::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Optional: Hanya bisa diedit kalau belum disetujui oleh SPV/Admin
        if ($permintaan->mengetahui || $permintaan->approval) {
            return back()->with('error', 'Permintaan sudah disetujui dan tidak bisa diedit.');
        }

        $permintaan->update($request->only('barang_id', 'jumlah', 'keterangan'));

        return redirect()->route('dashboard')->with('success', 'Permintaan berhasil diperbarui.');
    }
    public function destroyUser($id)
    {
        $permintaan = Permintaan::where('id', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        if ($permintaan->mengetahui || $permintaan->approval) {
            return back()->with('error', 'Permintaan sudah disetujui dan tidak bisa dihapus.');
        }

        $permintaan->delete();
        return back()->with('success', 'Permintaan berhasil dihapus.');
    }


    // Daftar permintaan untuk SPV
    public function indexSpv()
    {
        $permintaans = Permintaan::whereNull('mengetahui')->get();
        return view('permintaan.spv-index', compact('permintaans'));
    }

    // Aksi SPV menyetujui
    public function setujuiSpv($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update(['mengetahui' => Auth::id()]);
        return redirect()->back()->with('success', 'Permintaan disetujui sebagai SPV.');
    }

    // Daftar permintaan untuk Admin
    public function indexAdmin()
    {
        $permintaans = Permintaan::whereNotNull('mengetahui')
            ->whereNull('approval')
            ->get();
        return view('permintaan.admin-index', compact('permintaans'));
    }

    // Aksi Admin menyetujui
    public function setujuiAdmin($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $permintaan->update(['approval' => Auth::id()]);
        return redirect()->back()->with('success', 'Permintaan disetujui oleh Admin.');
    }
}
