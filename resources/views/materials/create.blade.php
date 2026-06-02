@extends('layouts.app')

@section('title', 'New Material')

@section('content')
<div class="page-header">
    <h1>Add Material</h1>
    <a href="{{ route('materials.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('materials.store') }}">
        @csrf
        <div class="form-group"><label for="name">Material Name *</label><input type="text" id="name" name="name" value="{{ old('name') }}" required></div>
        <div class="form-group"><label for="quantity">Quantity *</label><input type="number" id="quantity" name="quantity" min="0" step="0.01" value="{{ old('quantity', 0) }}" required></div>
        <div class="form-group"><label for="unit">Unit *</label><input type="text" id="unit" name="unit" value="{{ old('unit', 'units') }}" required></div>
        <div class="form-actions"><button type="submit" class="btn btn-primary">Save Material</button></div>
    </form>
</div>
@endsection
