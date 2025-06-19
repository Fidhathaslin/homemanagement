<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\BankTransaction;
use App\Models\BankAccount;
use Illuminate\Http\RedirectResponse;

class BankTransactionController extends Controller
{


    public function index(): View
    {
        $transactions = BankTransaction::with('bankAccount')->latest()->get();

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
   $breadcrumbItems = [
     ['name' => 'Bank Transactions', 'url' => route('bank-transactions.create'), 'active' => true],
        ];
    return view('bank-transactions.create', [
        'bankAccounts' => $bankAccounts,
        'breadcrumbItems' => $breadcrumbItems,
        'pageTitle' => 'Bank Transaction',
    ]); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_account_id' => 'required|exists:bank_accounts,id',
            'type' => 'required|in:credit,debit',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:255',
            'reference_no' => 'nullable|string|max:100',
            'transaction_date' => 'required|date',
        ]);

        BankTransaction::create($validated);
          notify()->success('Bank Transaction created successfully.');
       return redirect()->route('bank-transactions.index');

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
