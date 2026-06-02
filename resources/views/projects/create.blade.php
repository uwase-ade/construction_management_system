@extends('layouts.app')

@section('title', 'New Project')

@section('content')
<div class="page-header">
    <h1>Create Project</h1>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        @include('projects._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Project</button>
        </div>
    </form>
</div>
@endsection
