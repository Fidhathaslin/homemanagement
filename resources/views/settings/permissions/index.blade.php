<x-app-layout>
    <div>
        <div class="mb-6">
            <x-breadcrumb :pageTitle="$pageTitle" :breadcrumbItems="$breadcrumbItems" />
        </div>
        <div class="card">
          
            <div class="space-y-8">
                <div class="space-y-5">
                    <div class="card">
                        <div class="card-body px-6 pb-6">
                            <div class="overflow-x-auto -mx-6 dashcode-data-table">
                                <span class=" col-span-8  hidden"></span>
                                <span class="  col-span-4 hidden"></span>
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden ">
                                                 <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                                   <thead class=" bg-slate-200 dark:bg-slate-700">
                                                    <tr>
                                                       <th scope="col" class="table-th ">
                                                           {{ __('Sl No') }}
                                                      </th>
                                                       <th scope="col" class="table-th ">
                                                         {{ __('Name') }}
                                                       </th>
                                                       <th scope="col" class="table-th ">
                                                         {{ __('Guard Name') }}
                                                       </th>
                                        
                                                    </tr>
                                                    </thead>
                                                    <tbody
                                                        class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                        @forelse ($permissions as $permission)
                                                     <tr class="border border-slate-100 dark:border-slate-900 relative">
                                                         <td class="table-td sticky left-0">{{ $loop->iteration }}</td>
                                                            <td class="table-td">
                                                                <span>{{ $permission->name }}</span>
                                                            </td>
                                                         <td class="table-td">
                                                               <span> {{ $permission->guard_name }}</span>
                                                            </td>
                                                            </tr>
                                                @empty
                                        <tr class="border border-slate-100 dark:border-slate-900 relative">
                                            <td class="table-cell text-center" colspan="5">
                                                <h2 class="text-xl text-slate-700 mb-8 -mt-4">
                                                    {{ __('No results found.') }}</h2>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#data-table, .data-table').DataTable({
                dom: "<'grid grid-cols-12 gap-5 px-6 mt-6'<'#dataTable_buttons.col-span-4'><'col-span-8 flex justify-end'f><'#pagination.flex items-center'>><'min-w-full't><'grid grid-cols-12 gap-5 px-6 mt-6 items-center'<'col-span-4'l><'col-span-8 flex justify-end'p><'#pagination.flex items-center'>>",
                paging: true,
                ordering: true,
                info: false,
                searching: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        previous: `<iconify-icon icon="ic:round-keyboard-arrow-left"></iconify-icon>`,
                        next: `<iconify-icon icon="ic:round-keyboard-arrow-right"></iconify-icon>`,
                    },
                    search: "Search:",
                },
                initComplete: function(settings, json) {
                        $('#dataTable_buttons').append(`
                        
                        <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2.5"
                            href="{{ route('settings.roles.permissions.index') }}">
                            <iconify-icon icon="mdi:refresh" class="text-xl "></iconify-icon>
                        </a>
                        `);
                    }
                
            });
        });
    </script>
@endpush
</x-app-layout>
