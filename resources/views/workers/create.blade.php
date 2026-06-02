@extends('layouts.app')

@section('title', 'New Worker')

@section('content')
<div class="page-header">
    <h1>Add Worker</h1>
    <a href="{{ route('workers.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('workers.store') }}">
        @csrf
        <div class="form-group"><label for="name">Name *</label><input type="text" id="name" name="name" value="{{ old('name') }}" required></div>
        <div class="form-group"><label for="role">Role *</label><input type="text" id="role" name="role" value="{{ old('role') }}" required placeholder="e.g. Mason, Engineer"></div>
        <div class="form-group"><label for="phone">Phone</label><input type="text" id="phone" name="phone" value="{{ old('phone') }}"></div>
        <div class="form-actions"><button type="submit" class="btn btn-primary">Save Worker</button></div>
    </form>
</div>
@endsection
