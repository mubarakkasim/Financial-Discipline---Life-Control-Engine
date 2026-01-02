<?php

namespace App\Services;

use App\Models\User;
use App\Models\Expense;
use App\Models\FinancialGoal;
use App\Models\IncomeSource;
use App\Models\Insight;
use Carbon\Carbon;

class FinancialEngine
{
    public function calculateHealthScore(User $user)
    {
        $score = 0;
        
        // 1. Savings Consistency (30 points)
        $goal = $user->financialGoals()->first();
        if ($goal) {
            $progress = ($goal->current_savings / $goal->target_amount) * 100;
            $score += min(30, ($progress / 100) * 30);
        }

        // 2. Spending Discipline (40 points)
        $monthlyIncome = $user->incomeSources()->sum('amount');
        $monthlyExpenses = $user->expenses()
            ->where('spent_at', '>=', Carbon::now()->startOfMonth())
            ->sum('amount');
            
        if ($monthlyIncome > 0) {
            $utilization = ($monthlyExpenses / $monthlyIncome);
            if ($utilization <= 0.5) $score += 40;
            elseif ($utilization <= 0.8) $score += 20;
            else $score += 5;
        }

        // 3. Goal Adherence (30 points)
        // Check if last 3 months expenses were below income
        $score += 20; // Default buffer for simplicity in MVP

        return round($score);
    }

    public function generateInsights(User $user)
    {
        $insights = [];
        $goal = $user->financialGoals()->first();
        $monthlyIncome = $user->incomeSources()->sum('amount');
        $monthlyExpenses = $user->expenses()
            ->where('spent_at', '>=', Carbon::now()->startOfMonth())
            ->sum('amount');

        // Detect spending leaks
        $topCategories = $user->expenses()
            ->selectRaw('expense_category_id, sum(amount) as total')
            ->groupBy('expense_category_id')
            ->orderByDesc('total')
            ->take(3)
            ->get();

        foreach ($topCategories as $cat) {
            if ($monthlyIncome > 0 && ($cat->total / $monthlyIncome) > 0.2) {
                $insights[] = [
                    'type' => 'warning',
                    'content' => "High spending in {$cat->category->name}. Consider reducing it by 10%.",
                    'importance' => 4
                ];
            }
        }

        // Predict month-end balance
        if ($monthlyIncome > 0) {
            $daysInMonth = Carbon::now()->daysInMonth;
            $dayOfMonth = Carbon::now()->day;
            $projectedExpenses = ($monthlyExpenses / $dayOfMonth) * $daysInMonth;
            $projectedBalance = $monthlyIncome - $projectedExpenses;

            if ($projectedBalance < 0) {
                $insights[] = [
                    'type' => 'critical',
                    'content' => "Predicting a deficit of ₦" . number_format(abs($projectedBalance)) . " by month-end. Cut non-essentials now!",
                    'importance' => 5
                ];
            } else {
                $insights[] = [
                    'type' => 'tip',
                    'content' => "You're on track to save ₦" . number_format($projectedBalance) . " this month.",
                    'importance' => 2
                ];
            }
        }

        // Goal drift
        if ($goal) {
            $totalMonths = Carbon::now()->diffInMonths($goal->target_date, false);
            if ($totalMonths > 0) {
                $requiredMonthly = ($goal->target_amount - $goal->current_savings) / $totalMonths;
                if ($requiredMonthly > ($monthlyIncome * 0.5)) {
                    $insights[] = [
                        'type' => 'pattern',
                        'content' => "Your goal is at risk. You need ₦" . number_format($requiredMonthly) . "/month, which is > 50% of your income.",
                        'importance' => 5
                    ];
                }
            }
        }

        return $insights;
    }
}
