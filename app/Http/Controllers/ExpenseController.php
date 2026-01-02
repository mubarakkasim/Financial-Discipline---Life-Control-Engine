<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\ExpenseCategory;

class ExpenseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $expenses = $user->expenses()->with('category')->latest()->take(50)->get();
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        $user = Auth::user();
        $categories = $user->expenseCategories;

        if ($categories->isEmpty()) {
            $defaults = ['Food', 'Transport', 'Utilities', 'Rent', 'Entertainment', 'Others'];
            foreach ($defaults as $name) {
                ExpenseCategory::create(['user_id' => $user->id, 'name' => $name]);
            }
            $categories = $user->expenseCategories()->get();
        }

        return view('expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        Expense::create([
            'user_id' => $user->id,
            'expense_category_id' => $request->category_id,
            'amount' => $request->amount,
            'note' => $request->note,
            'spent_at' => now(),
        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->user_id !== Auth::id()) {
            abort(403);
        }

        $expense->delete();
        return redirect()->back()->with('success', 'Transaction removed.');
    }
}
