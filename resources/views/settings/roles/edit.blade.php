<x-app-layout>
    <div class="mb-6">
        <x-breadcrumb :pageTitle="$pageTitle" :breadcrumbItems="$breadcrumbItems" />
    </div>
    <div class="space-y-8">
        <div class="space-y-5">
            <div class="card">
                <header class="card-header noborder">
                    
                </header>
                <div class="card-body px-6 pb-6">
                    <form action="{{ route('settings.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Role Name -->
                        <div class="mb-6">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Role Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Guard Name -->
                        <div class="mb-6">
                            <label for="guard_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Guard Name</label>
                            <input type="text" id="guard_name" name="guard_name" value="{{ old('guard_name', $role->guard_name) }}" class="block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('guard_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Permissions -->
                        <div class="mb-6">
                            <label for="permission" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Permissions</label>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="permission-{{ $loop->index }}" name="permissions[]" {{ in_array($permission->name, old('permissions', $role_permissions)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission-{{ $loop->index }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('permissions')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 dark:focus:ring-blue-800">Update Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
