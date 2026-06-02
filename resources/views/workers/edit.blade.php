@extends('layouts.app')

@section('title', 'Edit Worker')

@section('content')
<div class="page-header">
    <h1>Edit Worker</h1>
    <a href="{{ route('workers.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('workers.update', $worker) }}">
        @csrf @method('PUT')
        <div class="form-group"><label for="name">Name *</label><input type="text" id="name" name="name" value="{{ old('name', $worker->name) }}" required></div>
        <div class="form-group"><label for="role">Role *</label><input type="text" id="role" name="role" value="{{ old('role', $worker->role) }}" required></div>
        <div class="form-group"><label for="phone">Phone</label><input type="text" id="phone" name="phone" value="{{ old('phone', $worker->phone) }}"></div>
        <div class="form-actions"><button type="submit" class="btn btn-primary">Update Worker</button></div>
    </form>
</div>
@endsection
