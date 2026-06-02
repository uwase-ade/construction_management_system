@extends('layouts.app')

@section('title', 'Report — ' . $project->name)

@section('content')
<div class="page-header">
    <h1>Project Report: {{ $project->name }}</h1>
    <div class="inline-actions no-print">
        <a href="{{ route('reports.print', $project) }}" class="btn btn-primary" target="_blank">Print Report</a>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

@include('reports._body')
@endsection
