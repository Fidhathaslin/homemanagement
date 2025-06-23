<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankTransaction;
class ReportController extends Controller
{
    public function incomeExpense(Request $request)
    {
        $query = BankTransaction::query();

        // Optional filter by month and year
        if ($request->filled('month') && $request->filled('year')) {
            $query->whereMonth('created_at', $request->month)
                  ->whereYear('created_at', $request->year);
        }

        $income = (clone $query)->where('type', 'credit')->sum('amount');
        $expense = (clone $query)->where('type', 'debit')->sum('amount');
        $balance = $income - $expense;

        return view('reports.income_expense', compact('income', 'expense', 'balance'));
    }
}
