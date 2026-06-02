<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Construction Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('partials.session-security')
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="brand">
                <span class="brand-icon">🏗</span>
                <div>
                    <strong>CMS Kigali</strong>
                    <small>Construction Management</small>
                </div>
            </div>
            <nav>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a>
                <a href="{{ route('workers.index') }}" class="{{ request()->routeIs('workers.*') ? 'active' : '' }}">Workers</a>
                <a href="{{ route('materials.index') }}" class="{{ request()->routeIs('materials.*') ? 'active' : '' }}">Materials</a>
                <a href="{{ route('assignments.index') }}" class="{{ request()->routeIs('assignments.*') ? 'active' : '' }}">Assignments</a>
                <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">Reports</a>
            </nav>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit">Logout ({{ auth()->user()->username }})</button>
            </form>
        </aside>
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
