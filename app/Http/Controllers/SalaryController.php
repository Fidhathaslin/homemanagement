<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\User;
use App\Models\BankTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class SalaryController extends Controller
{
    public function index(): View
    {
        $salaries = Salary::latest()->get();

        $breadcrumbItems = [
            ['name' => 'Salaries', 'url' => route('salaries.index'), 'active' => true],
        ];

        return view('salaries.index', [
            'salaries' => $salaries,
            'breadcrumbItems' => $breadcrumbItems,
            'pageTitle' => 'Salaries',
        ]);
    }

      public function create(): View
    {
         $staff = User::role('staff')->get();
        $bankTransactions = BankTransaction::where('type', 'credit')->get(); 
        $breadcrumbItems = [
            ['name' => 'Salary', 'url' => route('salaries.index'), 'active' => true],
        ];

        return view('salaries.create', [
            'staff' => $staff,
             'bankTransactions' => $bankTransactions,
            'breadcrumbItems' => $breadcrumbItems,
            'pageTitle' => 'Create Salary',
        ]);
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:0',
        'month' => 'required|string|max:20',
        'year' => 'required|integer|min:2000|max:2100',
        'paid_date' => 'nullable|date',
       
    ]);

    // Always create salary as unpaid on creation
    $validated['status'] = 'unpaid';
    $validated['bank_transaction_id'] = null;
    $validated['paid_date'] = null;

    Salary::create($validated);

    notify()->success('Salary created successfully as unpaid.');
    return redirect()->route('salaries.index');
}

      public function edit(Salary $salary): View
    {
        $breadcrumbItems = [
            ['name' => 'Salaries', 'url' => route('salaries.index')],
            ['name' => 'Edit', 'active' => true],
        ];

        return view('salaries.edit', [
            'salary' => $salary,
            'breadcrumbItems' => $breadcrumbItems,
            'pageTitle' => 'Edit Salary',
        ]);
    }

    public function update(Request $request, Salary $salary): RedirectResponse
    {
        $validated = $request->validate([
            'month' => 'required|string|max:20',
            'year' => 'required|integer|min:2000|max:2100',
            'status' => 'required|string|in:paid,unpaid',
            'paid_date' => 'nullable|date',
            'amount' => 'required|numeric|min:0',
          
        ]);

        $salary->update($validated);

        notify()->success('Salary record updated successfully.');

        return redirect()->route('salaries.index');
    }

    public function destroy(Salary $salary): RedirectResponse
    {
        $salary->delete();

        notify()->success('Salary record deleted successfully.');

        return redirect()->route('salaries.index');
    }
}
