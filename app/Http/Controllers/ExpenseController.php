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
}
