@extends('layout/app')

@section('title', 'Login - Abadi Airlines')

@section('content')
<main class="form-container">
    <h1>Login</h1>
    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('success'))
        <div class="alert-message success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/sesi/login" method="POST" id="login-form">
        @csrf
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" value="{{ Session::get('email') }}" name="email" required autocomplete="username">
        </div>

        <div class="form-group" style="position: relative;">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            <span class="eye-icon" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <button name="submit" type="submit" class="form-submit-button">Login</button>
        <p class="text-center" style="margin-top: 1.5rem; color: #e0e7ff;">Belum punya akun? <a href="/sesi/signup" class="link-text">Daftar sekarang</a>.</p>
    </form>
</main>
@endsection