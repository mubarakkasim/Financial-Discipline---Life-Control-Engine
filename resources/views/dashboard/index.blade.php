@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-weight: 800; font-size: 1.5rem;">Pulse Check</h2>
        <span style="font-size: 0.8rem; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 20px;">
            {{ now()->format('M d, Y') }}
        </span>
    </div>

    <!-- Health Score -->
    <div class="card" style="text-align: center;">
        <p style="color: var(--text-muted); font-size: 0.9rem;">Financial Health Score</p>
        <div class="health-score">{{ $healthScore }}</div>
        <p style="font-size: 0.8rem; color: {{ $healthScore > 70 ? 'var(--success)' : 'var(--warning)' }}">
            {{ $healthScore > 70 ? 'Excellent Discipline' : 'Needs Optimization' }}
        </p>
    </div>

    <!-- Goal Progress -->
    @if($goal)
    <div class="card">
        <h4 style="margin-bottom: 10px;">{{ $goal->title }}</h4>
        <div style="display: flex; justify-content: space-between; font-size: 0.8rem; color: var(--text-muted);">
            <span>₦{{ number_format($goal->current_savings) }} / ₦{{ number_format($goal->target_amount) }}</span>
            <span>{{ round(($goal->current_savings / $goal->target_amount) * 100) }}%</span>
        </div>
        <div class="progress-container">
            <div class="progress-bar" style="width: {{ ($goal->current_savings / $goal->target_amount) * 100 }}%"></div>
        </div>
        <p style="font-size: 0.75rem; color: var(--text-muted);">
            Deadline: {{ \Carbon\Carbon::parse($goal->target_date)->format('M Y') }}
        </p>
    </div>
    @endif

    <!-- Insights Section -->
    <h3 style="margin-bottom: 20px; font-size: 1.1rem; padding-left: 5px;">AI Insights</h3>
    @forelse($insights as $insight)
    <div class="card" style="padding: 16px; border-left: 4px solid {{ $insight['type'] == 'warning' ? 'var(--warning)' : ($insight['type'] == 'critical' ? 'var(--danger)' : 'var(--success)') }};">
        <p style="font-size: 0.9rem; line-height: 1.4;">{{ $insight['content'] }}</p>
    </div>
    @empty
    <div class="card" style="padding: 16px; opacity: 0.7;">
        <p style="font-size: 0.9rem;">Gathering data to provide insights...</p>
    </div>
    @endforelse

    <!-- Monthly Summary -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
        <div class="card" style="padding: 16px;">
            <p style="font-size: 0.75rem; color: var(--text-muted);">Monthly Income</p>
            <p style="font-size: 1.1rem; font-weight: 600; color: var(--success);">₦{{ number_format($monthlyIncome) }}</p>
        </div>
        <div class="card" style="padding: 16px;">
            <p style="font-size: 0.75rem; color: var(--text-muted);">Monthly Spends</p>
            <p style="font-size: 1.1rem; font-weight: 600; color: var(--danger);">₦{{ number_format($monthlyExpenses) }}</p>
        </div>
    </div>

    <!-- Today's Log -->
    <h3 style="margin-bottom: 15px; font-size: 1.1rem; padding-left: 5px;">Today's Log</h3>
    @forelse($todaysExpenses as $expense)
    <div class="card" style="padding: 12px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.03);">
        <div style="font-size: 0.85rem;">
            <span style="font-weight: 600;">{{ $expense->category->name }}</span>
            <span style="color: var(--text-muted); margin-left: 8px;">{{ $expense->note ?? '' }}</span>
        </div>
        <div style="font-weight: 700; color: var(--danger); font-size: 0.9rem;">
            -₦{{ number_format($expense->amount) }}
        </div>
    </div>
    @empty
    <p style="font-size: 0.8rem; color: var(--text-muted); text-align: center; margin-bottom: 20px;">No entries for today.</p>
    @endforelse
    
    <div style="margin-top: 10px;">
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Quick Spend Entry
        </a>
    </div>
</div>
@endsection
