<x-app-layout>
    <div class="mb-6">
        <x-breadcrumb :pageTitle="$pageTitle" :breadcrumbItems="$breadcrumbItems" />
    </div>
    <div class="space-y-8">
        <div class="space-y-5">
            <div class="card">
                <div class="card-body px-6 pb-6">
                    <div class="overflow-x-auto -mx-6 dashcode-data-table">
                        <span class=" col-span-8  hidden"></span>
                        <span class="  col-span-4 hidden"></span>
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                                <table
                                    class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                    <thead class=" bg-slate-200 dark:bg-slate-700">
                                        <tr>
                                            <th scope="col" class=" table-th ">
                                                Id
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Name
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Guard
                                            </th>
                                            <th scope="col" class=" table-th ">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        @foreach ($roles as $item)
                                            <tr>
                                                <td class="table-td">{{ $loop->iteration }}</td>
                                                <td class="table-td ">{{ $item['name'] }}</td>
                                                <td class="table-td ">{{ $item['guard_name'] }}</td>
                                                <td class="table-td ">
                                                    <div class="flex space-x-3 rtl:space-x-reverse">
                                                        <a class="action-btn"
                                                            href="{{ route('settings.roles.edit', $item) }}">
                                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                        </a>
                                                        <button
                                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $item['id'] }}').submit();"
                                                            class="action-btn">
                                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                        </button>
                                                        <form id="delete-form-{{ $item['id'] }}"
                                                            action="{{ route('settings.roles.destroy', $item['id']) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                        @can('users-create')
                            <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2 !px-3"
                                href="{{ route('settings.roles.create') }}">
                                <iconify-icon icon="ic:round-plus" class="text-lg mr-1">
                                </iconify-icon>
                                {{ __('New') }}
                            </a>
                        @endcan
                        <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2.5"
                            href="{{ route('settings.roles.index') }}">
                            <iconify-icon icon="mdi:refresh" class="text-xl "></iconify-icon>
                        </a>
                        `);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
