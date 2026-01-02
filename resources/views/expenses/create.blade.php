@extends('layout.app')

@section('content')
<div class="animate-fade">
    <div style="display: flex; align-items: center; margin-bottom: 30px;">
        <a href="{{ route('dashboard') }}" style="color: white; margin-right: 15px;"><i class="fas fa-arrow-left"></i></a>
        <h2 style="font-weight: 800; font-size: 1.5rem;">Log Spending</h2>
    </div>

    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf
        
        <div class="card">
            <div class="form-group">
                <label>How much did you spend?</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 15px; top: 12px; color: var(--text-muted);">₦</span>
                    <input type="number" name="amount" placeholder="0.00" style="padding-left: 35px;" required step="0.01">
                </div>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Note (Optional)</label>
                <textarea name="note" placeholder="Lunch at Bukka, Uber trip..." rows="3"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Expense</button>
    </form>
</div>
@endsection
