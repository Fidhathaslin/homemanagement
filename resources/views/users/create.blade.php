<x-app-layout>
    <div>
        {{--Breadcrumb start--}}
        <div class="mb-6">
            {{--BreadCrumb--}}
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle" />
        </div>
        {{--Breadcrumb end--}}

        {{--Create user form start--}}
        <form method="POST" action="{{ route('users.store') }}"  class="max-w-4xl m-auto">
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
                    {{--Name input end--}}
                    <div class="input-area">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input name="name" type="text" id="name" class="form-control" value="{{old('name')}}"
                                placeholder="{{ __('Enter your name') }}"  required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                    {{--Email input start--}}
                    <div class="input-area">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input name="email" type="email" id="email" class="form-control" value="{{old('email')}}"
                               placeholder="{{ __('Enter your email') }}"  required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                    {{--Email input start--}}
                    <div class="input-area">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input name="password" type="password" id="password" class="form-control" placeholder="{{ __('Enter Password') }}" >
                        <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                    </div>
                    <div class="input-area">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input name="password_confirmation" type="password" id="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" required>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                    </div>
                    {{--Role input start--}}
                    <div class="input-area">
                        <label for="role" class="form-label">{{ __('Role') }}</label>
                        <select name="role" class="form-control">
                            <option value="" selected disabled>
                                {{ __('Select Role') }}
                            </option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{--Role input end--}}
                </div>
                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-full">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
        {{--Create user form end--}}
    </div>
</x-app-layout>
