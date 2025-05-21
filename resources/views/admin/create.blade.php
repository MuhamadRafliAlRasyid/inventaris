@extends('layouts.app')

@section('content')
    <h1>Tambah User</h1>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        @include('admin.form')
        <button type="submit">Simpan</button>
    </form>
@endsection
