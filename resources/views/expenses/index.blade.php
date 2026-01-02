@extends('layout.app')

@section('content')
<div class="animate-fade">
    <h2 style="font-weight: 800; font-size: 1.5rem; margin-bottom: 30px;">Activity History</h2>

    @forelse($expenses as $expense)
    <div class="card" style="padding: 16px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <p style="font-size: 0.95rem; font-weight: 600;">{{ $expense->category->name }}</p>
            <p style="font-size: 0.75rem; color: var(--text-muted);">{{ \Carbon\Carbon::parse($expense->spent_at)->format('d M, h:i A') }}</p>
            @if($expense->note)
                <p style="font-size: 0.75rem; color: var(--text-muted); font-style: italic;">"{{ $expense->note }}"</p>
            @endif
        </div>
        <div style="text-align: right; display: flex; align-items: center; gap: 15px;">
            <p style="font-size: 1rem; font-weight: 800; color: var(--danger);">-₦{{ number_format($expense->amount) }}</p>
            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 0.8rem;"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
    @empty
    <div class="card" style="text-align: center; opacity: 0.6;">
        <p>No transactions yet.</p>
    </div>
    @endforelse

    <div style="margin-top: 30px;">
        <a href="{{ route('expenses.create') }}" class="btn btn-primary">Add Transaction</a>
    </div>
</div>
@endsection
