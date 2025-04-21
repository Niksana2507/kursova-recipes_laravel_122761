@extends('layouts.app')

@section('maincontent')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h3>Вход</h3>
        </div>

        <div class="login-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Имейл адрес</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Парола</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        Запомни ме
                    </label>
                </div>

                <button type="submit" class="btn btn-login">
                    Вход
                </button>

                <div class="register-link">
                    <a href="{{ route('register') }}">
                        Нямате акаунт? Регистрирайте се
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 