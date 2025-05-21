<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user beserta relasi 'bagian', lalu filter agar role bukan 'admin'
        $users = User::with('bagian')
            ->where('role', '!=', 'admin') // filter user dengan role selain 'admin'
            ->get();

        return view('admin.index', compact('users'));
    }

    public function create()
    {
        $bagians = Bagian::all();
        return view('admin.create', compact('bagians'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'bagian_id' => 'nullable|exists:bagian,id',
            'role' => 'required|in:admin,user,spv',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $bagians = Bagian::all();
        return view('admin.edit', compact('user', 'bagians'));
    }



    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'bagian_id' => 'nullable|exists:bagian,id',
            'role' => 'required|in:admin,user,spv',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }
}
