<x-app-layout>
    <div>
        {{-- Breadcrumb --}}
        <div class="mb-6">
            <x-breadcrumb :breadcrumbItems="$breadcrumbItems" :pageTitle="$pageTitle" />
        </div>

        {{-- Edit Bank Transaction Form --}}
        <form method="POST" action="{{ route('bank-transactions.update', $bankTransaction->id) }}" class="max-w-3xl m-auto">
            @csrf
            @method('PATCH')

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="list-disc pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">
                <div class="grid sm:grid-cols-2 gap-x-8 gap-y-4">

                    {{-- Bank Account --}}
                    <div class="input-area">
                        <label for="bank_account_id" class="form-label">{{ __('Bank Account') }}</label>
                        <select name="bank_account_id" id="bank_account_id" class="form-control" required>
                            <option value="">{{ __('Select Bank Account') }}</option>
                            @foreach ($bankAccounts as $account)
                                <option value="{{ $account->id }}"
                                    {{ $bankTransaction->bank_account_id == $account->id ? 'selected' : '' }}>
                                    {{ $account->company_name }} - {{ $account->account_number }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('bank_account_id')" class="mt-2" />
                    </div>

                    {{-- Type --}}
                    <div class="input-area">
                        <label for="type" class="form-label">{{ __('Transaction Type') }}</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="credit" {{ $bankTransaction->type == 'credit' ? 'selected' : '' }}>Credit</option>
                            <option value="debit" {{ $bankTransaction->type == 'debit' ? 'selected' : '' }}>Debit</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    {{-- Amount --}}
                    <div class="input-area">
                        <label for="amount" class="form-label">{{ __('Amount') }}</label>
                        <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                               value="{{ old('amount', $bankTransaction->amount) }}" required>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    {{-- Transaction Date --}}
                    <div class="input-area">
                        <label for="transaction_date" class="form-label">{{ __('Transaction Date') }}</label>
                        <input type="date" name="transaction_date" id="transaction_date" class="form-control"
                               value="{{ old('transaction_date', $bankTransaction->transaction_date->format('Y-m-d')) }}" required>
                        <x-input-error :messages="$errors->get('transaction_date')" class="mt-2" />
                    </div>

                    {{-- Reference Number --}}
                    <div class="input-area col-span-2">
                        <label for="reference_no" class="form-label">{{ __('Reference No') }}</label>
                        <input type="text" name="reference_no" id="reference_no" class="form-control"
                               value="{{ old('reference_no', $bankTransaction->reference_no) }}">
                        <x-input-error :messages="$errors->get('reference_no')" class="mt-2" />
                    </div>

                    {{-- Description --}}
                    <div class="input-area col-span-2">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $bankTransaction->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-dark mt-4 w-full">
                    {{ __('Update Transaction') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
