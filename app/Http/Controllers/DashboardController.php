<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Services\FinancialEngine;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(FinancialEngine $engine)
    {
        $user = Auth::user();
        
        if ($user->financialGoals()->count() === 0) {
            return redirect()->route('onboarding');
        }

        $goal = $user->financialGoals()->first();
        
        $healthScore = $engine->calculateHealthScore($user);
        $insights = $engine->generateInsights($user);
        
        $monthlyIncome = $user->incomeSources()->sum('amount');
        $monthlyExpenses = $user->expenses()
            ->where('spent_at', '>=', Carbon::now()->startOfMonth())
            ->sum('amount');

        $todaysExpenses = $user->expenses()
            ->with('category')
            ->whereDate('spent_at', Carbon::today())
            ->get();
            
        return view('dashboard.index', compact(
            'user', 'goal', 'healthScore', 'insights', 
            'monthlyIncome', 'monthlyExpenses', 'todaysExpenses'
        ));
    }
}
