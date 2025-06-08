@extends('layout/app')

@section('title', 'Daftar Akun - Abadi Airlines')

@section('content')
<main class="form-container">
    <h1>Daftar Akun</h1>
    @if ($errors->any())
        <div class="alert-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/sesi/create" method="POST" id="signup-form">
        @csrf
        <div style="width:350px;"class="form-group">
            <label for="name">Nama:</label>
            <input type="text" id="name" value="{{ Session::get('name') }}" name="name" required autocomplete="name">
        </div>

        <div style="width:350px;" class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" value="{{ Session::get('email') }}" name="email" required autocomplete="email">
        </div>

        <div style="width:350px;" class="form-group" style="position: relative;">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="new-password">
            <span class="eye-icon" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <div style="width:350px;" class="form-group" style="position: relative;">
            <label for="confirm-password">Konfirmasi Password:</label>
            <input type="password" id="confirm-password" name="password_confirmation" required autocomplete="new-password">
            <span class="eye-icon" onclick="togglePassword('confirm-password')">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <button type="submit" class="form-submit-button">Daftar</button>
        <p class="text-center" style="margin-top: 1.5rem; color: #e0e7ff;">Sudah punya akun? <a href="/sesi" class="link-text">Login</a>.</p>
    </form>
</main>

<script>
    document.getElementById('signup-form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (password !== confirmPassword) {
            alert('Password dan Konfirmasi Password harus sama!');
            event.preventDefault();
        }
    });
</script>
@endsection