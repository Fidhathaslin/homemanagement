<x-app-layout>
    <div>
        {{-- Breadcrumb start --}}
        <div class="mb-6">
            <x-breadcrumb :breadcrumbItems="$breadcrumbItems" :pageTitle="$pageTitle" />
        </div>
        {{-- Breadcrumb end --}}

        {{-- Edit Salary Form --}}
        <form method="POST" action="{{ route('salaries.update', $salary->id) }}" class="max-w-3xl m-auto">
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
                    
                    {{-- Month --}}
                    <div class="input-area">
                        <label for="month" class="form-label">{{ __('Month') }}</label>
                        <select name="month" id="month" class="form-control" required>
                            <option value="">{{ __('Select Month') }}</option>
                            @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                                <option value="{{ $m }}" {{ (old('month', $salary->month) == $m) ? 'selected' : '' }}>{{ $m }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('month')" class="mt-2" />
                    </div>

                    {{-- Year --}}
                    <div class="input-area">
                        <label for="year" class="form-label">{{ __('Year') }}</label>
                        <input type="number" name="year" id="year" min="2000" max="2100" class="form-control" value="{{ old('year', $salary->year) }}" required>
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>

                    {{-- Status --}}
                    <div class="input-area">
                        <label for="status" class="form-label">{{ __('Status') }}</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">{{ __('Select Status') }}</option>
                            <option value="paid" {{ (old('status', $salary->status) == 'paid') ? 'selected' : '' }}>{{ __('Paid') }}</option>
                            <option value="unpaid" {{ (old('status', $salary->status) == 'unpaid') ? 'selected' : '' }}>{{ __('Unpaid') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    {{-- Paid Date --}}
                    <div class="input-area">
                        <label for="paid_date" class="form-label">{{ __('Paid Date') }}</label>
                        <input type="date" name="paid_date" id="paid_date" class="form-control" value="{{ old('paid_date', $salary->paid_date ? $salary->paid_date->format('Y-m-d') : '') }}">
                        <x-input-error :messages="$errors->get('paid_date')" class="mt-2" />
                    </div>

                    {{-- Amount --}}
                    <div class="input-area">
                        <label for="amount" class="form-label">{{ __('Amount') }}</label>
                        <input type="number" name="amount" id="amount" step="0.01" min="0" class="form-control" value="{{ old('amount', $salary->amount) }}" required>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    {{-- Optional Notes --}}
                    <div class="input-area col-span-2">
                        <label for="notes" class="form-label">{{ __('Notes') }}</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes', $salary->notes) }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-dark mt-4 w-full">
                    {{ __('Update Salary') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
