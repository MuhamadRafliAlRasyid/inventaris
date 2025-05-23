<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bagian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        // Ambil user beserta relasi 'bagian', lalu filter agar role bukan 'admin'
        $users = User::with('bagian')
            ->where('role', '!=', 'admin')
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
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        $filename = $this->handleFileUpload($request);
        if ($filename) {
            $user->profile_photo_path = $filename;
            $user->save();
        }

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
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $filename = $this->handleFileUpload($request, $user);
        if ($filename) {
            $validated['profile_photo_path'] = $filename;
        }

        $user->update($validated);

        return redirect()->route('admin.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Hapus file foto sebelum menghapus user
        if ($user->profile_photo_path && file_exists(public_path('img/profile_photo/' . $user->profile_photo_path))) {
            unlink(public_path('img/profile_photo/' . $user->profile_photo_path));
        }

        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Handle upload foto profile.
     *
     * @param Request $request
     * @param User|null $user
     * @return string|null
     */
    private function handleFileUpload(Request $request, User $user = null)
    {
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/profile_photo'), $filename);

            // Hapus file lama jika ada
            if ($user && $user->profile_photo_path) {
                $oldPath = public_path('img/profile_photo/' . $user->profile_photo_path);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            return $filename;
        }

        return $user ? $user->profile_photo_path : null;
    }
}
