<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\BankAccount;
use Illuminate\Http\RedirectResponse;
class BankAccountController extends Controller
{
      public function index(): View
        {
            $bankAccounts = BankAccount::latest()->get();

            $breadcrumbItems = [
                ['name' => 'Bnak Accounts', 'url' => route('bank-accounts.index'), 'active' => true],
            ];

            return view('bank_accounts.index', [
                 'bankAccounts' => $bankAccounts,
                'breadcrumbItems' => $breadcrumbItems,
                'pageTitle' => 'Bank Account',
            ]);
        }
   
        public function create(): View
        {
            $breadcrumbItems = [
            
                ['name' => 'Create', 'url' => route('bank-accounts.create'), 'active' => true],
            ];

            return view('bank_accounts.create', [
                'breadcrumbItems' => $breadcrumbItems,
                'pageTitle' => 'Bank Account',
            ]);
        }

        public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'company_name'       =>'required|string|max:255',
            'bank_name'        => 'required|string|max:255',
            'account_number'   => 'required|string|max:100',
            'passbook_number'  => 'nullable|string|max:100',
            'branch_name'      => 'nullable|string|max:255',
            'iban'             => 'nullable|string|max:34',
            'currency'         => 'required|string|max:10',
            'account_type'     => 'nullable|string|max:50',
            'passbook_issue_date' => 'nullable|date',
          
        ]);

        // Create the bank account record
        BankAccount::create($validated);

        // Redirect back or to bank accounts index with success message
         notify()->success('Bank Account created successfully.');
       return redirect()->route('bank-accounts.index');
    }

        public function edit(BankAccount $bankAccount): View
        {
            $breadcrumbItems = [
            
                ['name' => 'Edit', 'url' => route('bank-accounts.create'), 'active' => true],
            ];

            return view('bank_accounts.edit', [
                'bankAccount' => $bankAccount,
                'breadcrumbItems' => $breadcrumbItems,
                'pageTitle' => 'Edit Bank Account',
            ]);
           
        }

         public function update(Request $request, BankAccount $bankAccount): RedirectResponse
         {
             $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'passbook_number' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255',
            'iban' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:255',
            'account_type' => 'nullable|string|max:255',
            'passbook_issue_date' => 'nullable|date',
            ]);

            $bankAccount->update($validated);

            return redirect()->route('bank-accounts.index')->with('success', 'Bank account updated successfully.');
        }








    public function destroy(BankAccount $bankAccount)
{
    $bankAccount->delete();

    return redirect()->route('bank-accounts.index')
        ->with('success', 'Bank account deleted successfully.');
}

}
