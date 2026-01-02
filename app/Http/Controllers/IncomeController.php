<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeSource;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:daily,weekly,monthly,irregular',
        ]);

        IncomeSource::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'amount' => $request->amount,
            'frequency' => $request->frequency,
        ]);

        return redirect()->back()->with('success', 'Income source added.');
    }

    public function destroy(IncomeSource $income)
    {
        if ($income->user_id !== Auth::id()) {
            abort(403);
        }

        $income->delete();
        return redirect()->back()->with('success', 'Income source removed.');
    }
}
