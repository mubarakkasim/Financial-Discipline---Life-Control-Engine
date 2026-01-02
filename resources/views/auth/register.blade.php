@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 2rem;">Join the<br><span style="color: var(--primary);">Engine.</span></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Start your journey to financial discipline.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div class="card">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Account</button>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('login') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.85rem;">
                Already have an account? <span style="color: var(--primary); font-weight: 600;">Sign In</span>
            </a>
        </div>
    </form>
</div>
@endsection
