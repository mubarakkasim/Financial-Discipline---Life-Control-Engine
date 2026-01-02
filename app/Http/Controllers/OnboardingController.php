<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\FinancialGoal;
use App\Models\IncomeSource;
use App\Models\ExpenseCategory;

class OnboardingController extends Controller
{
    public function index()
    {
        return view('onboarding.index');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        // 1. Create Goal
        FinancialGoal::create([
            'user_id' => $user->id,
            'title' => $request->goal_title,
            'target_amount' => $request->target_amount,
            'target_date' => $request->target_date,
        ]);

        // 2. Create Income Source
        IncomeSource::create([
            'user_id' => $user->id,
            'name' => $request->income_source_name,
            'amount' => $request->income_amount,
            'frequency' => $request->income_frequency,
        ]);

        // 3. Create Default Spending Categories
        $categories = ['Food', 'Transport', 'Utilities', 'Rent', 'Entertainment', 'Others'];
        foreach ($categories as $cat) {
            ExpenseCategory::create([
                'user_id' => $user->id,
                'name' => $cat
            ]);
        }

        return redirect()->route('dashboard');
    }
}
