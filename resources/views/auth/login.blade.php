<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Construction Management System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @include('partials.session-security')
    @include('partials.prevent-back-after-logout')
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <h1>🏗 Construction CMS</h1>
            <p class="subtitle">Integrated Situation — Kigali Construction Company<br>Sign in to manage projects, workers & materials</p>

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%">Sign In</button>
            </form>
            <p style="margin-top:1.5rem;font-size:0.8rem;color:#64748b;text-align:center">
                Demo: <strong>admin</strong> / <strong>password123</strong>
            </p>
        </div>
    </div>
</body>
</html>
