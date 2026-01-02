@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 2rem;">Reset<br><span style="color: var(--primary);">Access.</span></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Set your new secure password.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
        <div class="card">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                @error('email')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
</div>
@endsection
