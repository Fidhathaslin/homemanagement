<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\BankTransaction;
use App\Models\BankAccount;
use App\Models\Salary;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class BankTransactionController extends Controller
{


    public function index(): View
    {
    $transactions = BankTransaction::with(['bankAccount', 'salary.user'])->latest()->get();


        $breadcrumbItems = [
            ['name' => 'Bank Transactions', 'url' => route('bank-transactions.index'), 'active' => true],
        ];

        return view('bank-transactions.index', [
            'transactions' => $transactions,
            'breadcrumbItems' => $breadcrumbItems,
            'pageTitle' => 'Bank Transactions',
        ]);
    }


    public function create()
    {
    $bankAccounts = BankAccount::all();
      $staff = User::role('staff')->get();
   $breadcrumbItems = [
     ['name' => 'Bank Transactions', 'url' => route('bank-transactions.create'), 'active' => true],
        ];
    return view('bank-transactions.create', [
        'bankAccounts' => $bankAccounts,
        'staff' => $staff, 
        'breadcrumbItems' => $breadcrumbItems,
        'pageTitle' => 'Bank Transaction',
    ]); 
    }
public function store(Request $request)
{
    $validated = $request->validate([
        'bank_account_id' => 'required|exists:bank_accounts,id',
        'type' => 'required|in:debit,credit',
        'amount' => 'required|numeric',
        'reference_no' => 'required|string',
        'transaction_date' => 'required|date',
        'user_id' => 'nullable|exists:users,id',
        // no need to accept description from input
    ]);

    $date = \Carbon\Carbon::parse($validated['transaction_date']);
    $userName = null;

    if (!empty($validated['user_id'])) {
        $user = \App\Models\User::find($validated['user_id']);
        $userName = $user ? $user->name : null;
    }

    // Build description based on type and other data
    if ($validated['type'] === 'debit') {
        $desc = "Debit transaction";
        if ($userName) {
            $desc .= " - Salary payment for {$userName}";
        }
        $desc .= " on " . $date->format('d M Y');
    } else { // credit
        $desc = "Credit transaction";
        if ($userName) {
            $desc .= " - Received from {$userName}";
        }
        $desc .= " on " . $date->format('d M Y');
    }

    // Add amount info if you want
    $desc .= ", Amount: " . number_format($validated['amount'], 2);

    $validated['description'] = $desc;

    $transaction = \App\Models\BankTransaction::create($validated);

    return redirect()->route('bank-transactions.index')
                     ->with('success', 'Bank transaction created successfully with auto description.');
}

   public function edit(BankTransaction $bankTransaction)
    {
    $bankAccounts = BankAccount::all();

    $breadcrumbItems = [
        ['name' => 'Bank Transactions', 'url' => route('bank-transactions.index')],
        ['name' => 'Edit', 'active' => true],
    ];

    return view('bank-transactions.edit', [
        'bankTransaction' => $bankTransaction,
        'bankAccounts' => $bankAccounts,
        'breadcrumbItems' => $breadcrumbItems,
        'pageTitle' => 'Edit Bank Transaction',
    ]);
    }
    

    public function update(Request $request, BankTransaction $bankTransaction)
    {
    $validated = $request->validate([
        'bank_account_id' => 'required|exists:bank_accounts,id',
        'type' => 'required|in:credit,debit',
        'amount' => 'required|numeric|min:0.01',
        'description' => 'nullable|string|max:255',
        'reference_no' => 'nullable|string|max:100',
        'transaction_date' => 'required|date',
    ]);

    $bankTransaction->update($validated);

    notify()->success('Bank Transaction edited successfully.');
       return redirect()->route('bank-transactions.index');    }


       public function destroy(BankTransaction $bankTransaction)
    {
    $bankTransaction->delete();

    return redirect()->route('bank-transactions.index')
        ->with('success', 'Transaction deleted successfully.');
    }

}
