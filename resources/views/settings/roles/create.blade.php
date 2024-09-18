<x-app-layout>
    <div class="mb-6">
        <x-breadcrumb :pageTitle="$pageTitle" :breadcrumbItems="$breadcrumbItems" />
    </div>
    {{-- Role Permission Card --}}
                <div class="space-y-8">
                        <div class="space-y-5">
                            <div class="card">
                                <header class="card-header noborder">
                                    
                                </header>
                                <div class="card-body px-6 pb-6">
                                    <form method="POST" action="{{ route('settings.roles.store') }}">
                                        @csrf 
                                         {{--Name input end--}}
                    <div class="input-area">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('Name') }}</label>
                        <input name="name" type="text" id="name" class="form-control"
                               placeholder="{{ __('Enter your role name') }}" value="{{ old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                                   
                    <div class=" py-5 mt-8">
                   <div class="grid gap-7">
                    @foreach ($permissionModules as $key => $permissionModule)
                            <div class="card border border-slate-200">
                                <div>
                                    <h4 class="p-0 text-lg uppercase">{{ __($key) }}</h4>
                                </div>
                                <!-- Card Body Start -->
                                <div class="p-4">
                                    <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Permissions</label>
                                    <ul>
                                        @foreach ($permissionModules as $module => $permissions)
                                            <li class="permissionCardList">
                                                <h3 class="font-bold text-gray-800">{{ ucfirst($module) }}</h3> <!-- Module Name -->
                                                <div class="w-full mt-2">
                                                <div class="grid grid-cols-3 gap-4 ">
                                                    @foreach ($permissions as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                   value="{{ $permission->name }}"
                                                                   id="permission-{{ $permission->id }}"
                                                                   name="permissions[]"
                                                                   {{ in_array($permission->name, old('permissions', $role_permissions ?? [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @error('permissions')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                <!-- Card Body End -->
                            </div>
                        @endforeach
                    </div>
                    <button class="btn inline-flex justify-center btn-dark dark:bg-slate-700 dark:text-slate-300 m-1 mt-4 !px-3 !py-2">
                        <span class="flex items-center">
                            <iconify-icon class="ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                            <span>@lang('Save')</span>
                        </span>
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
