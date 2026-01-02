@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 2rem;">Secure<br><span style="color: var(--primary);">Recovery.</span></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Enter your email to receive a secure recovery link.</p>
    </div>

    @if (session('status'))
        <div class="card" style="padding: 12px; background: rgba(16, 185, 129, 0.1); border-color: var(--success); margin-bottom: 20px;">
            <p style="color: var(--success); font-size: 0.85rem; text-align: center;">{{ session('status') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <div class="card">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Send Recovery Link</button>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('login') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.85rem;">
                Back to <span style="color: var(--primary); font-weight: 600;">Sign In</span>
            </a>
        </div>
    </form>
</div>
@endsection
