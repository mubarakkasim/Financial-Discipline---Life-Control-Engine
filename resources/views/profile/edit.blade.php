@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="display: flex; align-items: center; margin-bottom: 30px;">
        <a href="{{ route('dashboard') }}" style="color: white; margin-right: 15px;"><i class="fas fa-arrow-left"></i></a>
        <h2 style="font-weight: 800; font-size: 1.5rem;">Security & Profile</h2>
    </div>

    <!-- Income Sources -->
    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 20px;">Income Sources</h3>
        
        @foreach($incomeSources as $source)
        <div style="display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.05); padding: 12px; border-radius: 12px; margin-bottom: 10px;">
            <div>
                <p style="font-weight: 600; font-size: 0.9rem;">{{ $source->name }}</p>
                <p style="font-size: 0.75rem; color: var(--text-muted);">₦{{ number_format($source->amount) }} / {{ ucfirst($source->frequency) }}</p>
            </div>
            <form action="{{ route('income.destroy', $source->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer;"><i class="fas fa-trash"></i></button>
            </form>
        </div>
        @endforeach

        <div style="margin-top: 20px; border-top: 1px solid var(--glass-border); padding-top: 20px;">
            <p style="font-size: 0.85rem; margin-bottom: 15px; color: var(--text-muted);">Add New Source</p>
            <form action="{{ route('income.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" placeholder="Source Name (e.g. Freelance)" required>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                    <div class="form-group">
                        <input type="number" name="amount" placeholder="Amount (₦)" required>
                    </div>
                    <div class="form-group">
                        <select name="frequency" required>
                            <option value="monthly">Monthly</option>
                            <option value="weekly">Weekly</option>
                            <option value="daily">Daily</option>
                            <option value="irregular">Irregular</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="padding: 10px;">Add Income</button>
            </form>
        </div>
    </div>

    <!-- Profile Information -->
    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 20px;">Profile Information</h3>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name') <p style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email') <p style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Update Password -->
    <div class="card">
        <h3 style="font-size: 1.1rem; margin-bottom: 20px;">Update Password</h3>
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input id="current_password" name="current_password" type="password" autocomplete="current-password">
                @error('current_password') <p style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" name="password" type="password" autocomplete="new-password">
                @error('password') <p style="color: var(--danger); font-size: 0.75rem;">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="card" style="border-color: var(--danger);">
        <h3 style="font-size: 1.1rem; margin-bottom: 10px; color: var(--danger);">Danger Zone</h3>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 20px;">Once your account is deleted, all its resources and data will be permanently deleted.</p>
        
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <div class="form-group">
                <label>Confirm Password to Delete</label>
                <input name="password" type="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn" style="background: var(--danger); color: white;">Delete Account</button>
        </form>
    </div>

    <div style="margin-top: 20px;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn" style="border: 1px solid var(--glass-border);">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </button>
        </form>
    </div>
</div>
@endsection
