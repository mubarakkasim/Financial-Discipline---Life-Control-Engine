@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="text-align: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 2rem;">Verify<br><span style="color: var(--primary);">Identity.</span></h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 10px;">Check your email for a verification link.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="card" style="padding: 12px; background: rgba(16, 185, 129, 0.1); border-color: var(--success); margin-bottom: 20px;">
            <p style="color: var(--success); font-size: 0.85rem; text-align: center;">A new verification link has been sent to your email.</p>
        </div>
    @endif

    <div class="card">
        <p style="font-size: 0.9rem; line-height: 1.6; color: var(--text-main);">
            Before starting your financial journey, please verify your email address by clicking on the link we just emailed to you.
        </p>
    </div>

    <div style="display: flex; gap: 15px; flex-direction: column;">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">Resend Link</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn" style="border: 1px solid var(--glass-border);">Log Out</button>
        </form>
    </div>
</div>
@endsection
