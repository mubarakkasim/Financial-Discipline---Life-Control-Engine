@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 2rem;">Welcome<br><span style="color: var(--primary);">Back.</span></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Security is our top priority. Please sign in.</p>
    </div>

    @if (session('status'))
        <div class="card" style="padding: 12px; background: rgba(16, 185, 129, 0.1); border-color: var(--success); margin-bottom: 20px;">
            <p style="color: var(--success); font-size: 0.85rem; text-align: center;">{{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="card">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="password">Password</label>
                    <a href="{{ route('password.request') }}" style="color: var(--primary); font-size: 0.75rem; text-decoration: none;">Forgot?</a>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; align-items: center; margin-top: 10px;">
                <input id="remember_me" type="checkbox" name="remember" style="width: auto; margin-right: 10px;">
                <label for="remember_me" style="margin-bottom: 0; font-size: 0.85rem; cursor: pointer;">Keep me logged in</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Sign In</button>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('register') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.85rem;">
                Don't have an account? <span style="color: var(--primary); font-weight: 600;">Sign Up</span>
            </a>
        </div>
    </form>
</div>
@endsection
