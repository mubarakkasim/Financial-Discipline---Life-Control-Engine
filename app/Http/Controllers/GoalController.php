<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\FinancialGoal;

class GoalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $goal = $user->financialGoals()->first();
        return view('goals.index', compact('goal'));
    }

    public function update(Request $request, $id)
    {
        $goal = FinancialGoal::findOrFail($id);
        
        if ($request->has('deposit')) {
            $goal->current_savings += $request->deposit;
            $goal->save();
        }

        return redirect()->back()->with('success', 'Savings updated!');
    }
}
