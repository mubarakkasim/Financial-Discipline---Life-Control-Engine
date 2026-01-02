@extends('layout.app')

@section('content')
<div class="animate-fade">
    <h2 style="font-weight: 800; font-size: 2rem; margin-bottom: 30px;">Let's design your<br><span style="color: var(--primary);">Financial Future.</span></h2>

    <form action="{{ route('onboarding.store') }}" method="POST">
        @csrf
        
        <div class="card">
            <h3 style="margin-bottom: 20px;">1. Primary Goal</h3>
            <div class="form-group">
                <label>What are you saving for?</label>
                <input type="text" name="goal_title" placeholder="e.g. Save ₦500,000 for December 2026" required>
            </div>
            <div class="form-group">
                <label>Target Amount (₦)</label>
                <input type="number" name="target_amount" placeholder="500000" required>
            </div>
            <div class="form-group">
                <label>Target Date</label>
                <input type="date" name="target_date" required>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 20px;">2. Income Setup</h3>
            <div class="form-group">
                <label>Primary Income Source</label>
                <input type="text" name="income_source_name" placeholder="Salary, Side Hustle..." required>
            </div>
            <div class="form-group">
                <label>Amount (₦)</label>
                <input type="number" name="income_amount" placeholder="200000" required>
            </div>
            <div class="form-group">
                <label>Frequency</label>
                <select name="income_frequency" required>
                    <option value="monthly">Monthly</option>
                    <option value="weekly">Weekly</option>
                    <option value="daily">Daily</option>
                    <option value="irregular">Irregular</option>
                </select>
            </div>
        </div>

        <div class="card" style="background: transparent; border: none; padding: 0;">
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 20px;">
                * We will automatically setup common spending categories like Food, Transport, and Utilities for you.
            </p>
            <button type="submit" class="btn btn-primary">Initialize Engine</button>
        </div>
    </form>
</div>
@endsection
