<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report — {{ $project->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>body{padding:2rem}.print-header{text-align:center;margin-bottom:2rem;border-bottom:2px solid #c45c26;padding-bottom:1rem}</style>
</head>
<body onload="window.print()">
    <div class="print-header">
        <h1>Construction Management System</h1>
        <p>Kigali Construction Company — Project Report</p>
        <p><small>Generated: {{ now()->format('d M Y H:i') }}</small></p>
    </div>
    @include('reports._body')
</body>
</html>
