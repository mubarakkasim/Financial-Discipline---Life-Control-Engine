@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 2rem;">Secure<br><span style="color: var(--primary);">Area.</span></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Please confirm your password to proceed.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        
        <div class="card">
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" autofocus>
                @error('password')
                    <p style="color: var(--danger); font-size: 0.75rem; margin-top: 5px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
</div>
@endsection
