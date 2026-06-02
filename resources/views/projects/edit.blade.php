@extends('layouts.app')

@section('title', 'Edit Project')

@section('content')
<div class="page-header">
    <h1>Edit Project</h1>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('projects.update', $project) }}">
        @csrf @method('PUT')
        @include('projects._form')
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Project</button>
        </div>
    </form>
</div>
@endsection
