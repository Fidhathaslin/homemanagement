<x-app-layout>
    <div>
        {{-- Breadcrumb start --}}
        <div class="mb-6">
           <x-breadcrumb :breadcrumbItems="$breadcrumbItems" :pageTitle="$pageTitle" />

        </div>
        {{-- Breadcrumb end --}}

        {{-- Bank Account Edit Form start --}}
        <form method="POST" action="{{ route('bank-accounts.update', $bankAccount->id) }}" class="max-w-4xl m-auto">
            @csrf
            @method('PATCH')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-disc pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">
                <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4">

                    {{-- Company Name --}}
                    <div class="input-area">
                        <label for="company_name" class="form-label">{{ __('Company Name') }}</label>
                        <input type="text" name="company_name" id="company_name" class="form-control"
                               value="{{ old('company_name', $bankAccount->company_name) }}" required>
                        <x-input-error :messages="$errors->get('company_name')" class="mt-2"/>
                    </div>

                    {{-- Bank Name --}}
                    <div class="input-area">
                        <label for="bank_name" class="form-label">{{ __('Bank Name') }}</label>
                        <input type="text" name="bank_name" id="bank_name" class="form-control"
                               value="{{ old('bank_name', $bankAccount->bank_name) }}" required>
                        <x-input-error :messages="$errors->get('bank_name')" class="mt-2"/>
                    </div>

                    {{-- Account Number --}}
                    <div class="input-area">
                        <label for="account_number" class="form-label">{{ __('Account Number') }}</label>
                        <input type="text" name="account_number" id="account_number" class="form-control"
                               value="{{ old('account_number', $bankAccount->account_number) }}" required>
                        <x-input-error :messages="$errors->get('account_number')" class="mt-2"/>
                    </div>

                    {{-- Passbook Number --}}
                    <div class="input-area">
                        <label for="passbook_number" class="form-label">{{ __('Passbook Number') }}</label>
                        <input type="text" name="passbook_number" id="passbook_number" class="form-control"
                               value="{{ old('passbook_number', $bankAccount->passbook_number) }}">
                        <x-input-error :messages="$errors->get('passbook_number')" class="mt-2"/>
                    </div>

                    {{-- Branch Name --}}
                    <div class="input-area">
                        <label for="branch_name" class="form-label">{{ __('Branch Name') }}</label>
                        <input type="text" name="branch_name" id="branch_name" class="form-control"
                               value="{{ old('branch_name', $bankAccount->branch_name) }}">
                        <x-input-error :messages="$errors->get('branch_name')" class="mt-2"/>
                    </div>

                    {{-- IBAN --}}
                    <div class="input-area">
                        <label for="iban" class="form-label">{{ __('IBAN') }}</label>
                        <input type="text" name="iban" id="iban" class="form-control"
                               value="{{ old('iban', $bankAccount->iban) }}">
                        <x-input-error :messages="$errors->get('iban')" class="mt-2"/>
                    </div>

                    {{-- Currency --}}
                    <div class="input-area">
                        <label for="currency" class="form-label">{{ __('Currency') }}</label>
                        <input type="text" name="currency" id="currency" class="form-control"
                               value="{{ old('currency', $bankAccount->currency ?? 'QAR') }}">
                        <x-input-error :messages="$errors->get('currency')" class="mt-2"/>
                    </div>

                    {{-- Account Type --}}
                    <div class="input-area">
                        <label for="account_type" class="form-label">{{ __('Account Type') }}</label>
                        <input type="text" name="account_type" id="account_type" class="form-control"
                               value="{{ old('account_type', $bankAccount->account_type) }}">
                        <x-input-error :messages="$errors->get('account_type')" class="mt-2"/>
                    </div>

                    {{-- Passbook Issue Date --}}
                    <div class="input-area">
                        <label for="passbook_issue_date" class="form-label">{{ __('Passbook Issue Date') }}</label>
                        <input type="date" name="passbook_issue_date" id="passbook_issue_date" class="form-control"
                               value="{{ old('passbook_issue_date', $bankAccount->passbook_issue_date ? \Carbon\Carbon::parse($bankAccount->passbook_issue_date)->format('Y-m-d') : '') }}">
                        <x-input-error :messages="$errors->get('passbook_issue_date')" class="mt-2"/>
                    </div>

                </div>

                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-full">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
        {{-- Bank Account Edit Form end --}}
    </div>
</x-app-layout>
