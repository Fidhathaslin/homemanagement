<x-app-layout>
    <div>
        {{-- Breadcrumb start --}}
        <div class="mb-6">
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle" />
        </div>
        {{-- Breadcrumb end --}}

        {{-- Financial Year Create Form start --}}
        <form method="POST" action="{{ route('financial-years.store') }}" class="max-w-4xl m-auto">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                   <ul>
                       @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                       @endforeach
                   </ul>
                </div>
            @endif
            
            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">
                <div class="grid sm:grid-cols-1 gap-x-8 gap-y-4">
                    
                    {{-- Financial Year Name --}}
                    <div class="input-area">
                        <label for="name" class="form-label">{{ __('Financial Year') }}</label>
                        <input name="name" type="text" id="name" class="form-control" value="{{ old('name') }}"
                               placeholder="{{ __('Enter financial year (eg:2025-2026)') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    {{-- Start Date --}}
                    <div class="input-area">
                        <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                        <input name="start_date" type="date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2"/>
                    </div>

                    {{-- End Date --}}
                    <div class="input-area">
                        <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                        <input name="end_date" type="date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2"/>

                    </div>
                </div>

                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-full">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
        {{-- Financial Year Create Form end --}}
    </div>
</x-app-layout>
