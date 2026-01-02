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
        
        if ($goal->user_id !== Auth::id()) {
            abort(403);
        }

        if ($request->has('deposit') && $request->deposit > 0) {
            $goal->current_savings += $request->deposit;
        }

        if ($request->has('title')) $goal->title = $request->title;
        if ($request->has('target_amount')) $goal->target_amount = $request->target_amount;
        if ($request->has('target_date')) $goal->target_date = $request->target_date;

        $goal->save();

        return redirect()->back()->with('success', 'Goal updated successfully!');
    }
}
