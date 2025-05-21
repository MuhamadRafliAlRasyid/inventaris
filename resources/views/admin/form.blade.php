<div>
    <label for="name">Nama</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div>
    <label for="password">
        Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '' }}
    </label>
    <input type="password" id="password" name="password">
</div>

<div>
    <label for="bagian_id">Bagian</label>
    <select name="bagian_id" id="bagian_id">
        <option value="">- Pilih Bagian -</option>
        @foreach ($bagians as $bagian)
            <option value="{{ $bagian->id }}"
                {{ old('bagian_id', $user->bagian_id ?? '') == $bagian->id ? 'selected' : '' }}>
                {{ $bagian->nama }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label for="role">Role</label>
    <select name="role" id="role" required>
        @foreach (['admin', 'user', 'spv'] as $role)
            <option value="{{ $role }}" {{ old('role', $user->role ?? '') == $role ? 'selected' : '' }}>
                {{ ucfirst($role) }}
            </option>
        @endforeach
    </select>
</div>
