@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('admin.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.form')
        <button type="submit">Simpan</button>
    </form>
@endsection
