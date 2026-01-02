@extends('layout.app')

@section('content')
<div class="animate-fade">
    <h2 style="font-weight: 800; font-size: 1.5rem; margin-bottom: 30px;">Goal Tracker</h2>

    @if($goal)
    <div class="card" style="padding: 30px; text-align: center;">
        <i class="fas fa-bullseye" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
        <h3 style="margin-bottom: 15px;">{{ $goal->title }}</h3>
        
        <div class="health-score" style="font-size: 2.5rem;">
            ₦{{ number_format($goal->current_savings) }}
        </div>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px;">
            Target: ₦{{ number_format($goal->target_amount) }}
        </p>

        <div class="progress-container" style="height: 20px; border-radius: 10px;">
            <div class="progress-bar" style="width: {{ ($goal->current_savings / $goal->target_amount) * 100 }}%"></div>
        </div>
        
        <div style="display: flex; justify-content: space-between; margin-top: 10px; font-size: 0.85rem;">
            <span>{{ round(($goal->current_savings / $goal->target_amount) * 100) }}% complete</span>
            <span>Target: {{ \Carbon\Carbon::parse($goal->target_date)->format('M d, Y') }}</span>
        </div>
    </div>

    <div class="card">
        <h4 style="margin-bottom: 20px;">Add to Savings</h4>
        <form action="{{ route('goals.update', $goal->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <input type="number" name="deposit" placeholder="Amount to save (₦)" required>
            </div>
            <button type="submit" class="btn btn-primary">Deposit to Vault</button>
        </form>
    </div>
    @else
    <div class="card" style="text-align: center;">
        <p>No goal set yet.</p>
        <a href="{{ route('onboarding') }}" class="btn btn-primary" style="margin-top: 20px;">Setup Goal</a>
    </div>
    @endif
</div>
@endsection
