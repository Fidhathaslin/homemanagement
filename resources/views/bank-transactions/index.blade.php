<x-app-layout>
    <div class="mb-6">
        {{-- Breadcrumb start --}}
        <x-breadcrumb :breadcrumbItems="$breadcrumbItems" :pageTitle="$pageTitle" />
    </div>

    <div class="card">
        <div class="space-y-8">
            <div class="space-y-5">
                <div class="card">
                    <div class="card-body px-6 pb-6">
                        <div class="overflow-x-auto -mx-6 dashcode-data-table">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden">
                                    <table
                                        class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                        <thead class="bg-slate-200 dark:bg-slate-700">
                                            <tr>
                                                <th scope="col" class="table-th">#</th>
                                                <th scope="col" class="table-th">Bank Account</th>
                                                <th scope="col" class="table-th">Type</th>
                                                <th scope="col" class="table-th">Amount</th>
                                                <th scope="col" class="table-th">Transaction Date</th>
                                                <th scope="col" class="table-th">Reference No</th>
                                                <th scope="col" class="table-th">Description</th>
                                                <th scope="col" class="table-th">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td class="table-td">{{ $loop->iteration }}</td>
                                                    <td class="table-td">
                                                        {{ $transaction->bankAccount->company_name ?? '-' }} <br>
                                                        <small class="text-muted">{{ $transaction->bankAccount->account_number ?? '' }}</small>
                                                    </td>
                                                    <td class="table-td">
                                                            {{ ucfirst($transaction->type) }}
                                                       
                                                    </td>
                                                    <td class="table-td">{{ number_format($transaction->amount, 2) }}</td>
                                                    <td class="table-td">{{ $transaction->transaction_date->format('Y-m-d') }}</td>
                                                    <td class="table-td">{{ $transaction->reference_no ?? '-' }}</td>
                                                    <td class="table-td">{{ $transaction->description ?? '-' }}</td>
                                                    <td class="table-td">
                                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                                            <a href="{{ route('bank-transactions.edit', $transaction->id) }}" class="action-btn" title="Edit">
                                                                <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                            </a>

                                                            <form id="deleteForm{{ $transaction->id }}" action="{{ route('bank-transactions.destroy', $transaction->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="action-btn cursor-pointer" title="Delete"
                                                                   onclick="sweetAlertDelete(event, 'deleteForm{{ $transaction->id }}')">
                                                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                                </a>
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
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready(function() {
                $('.data-table').DataTable({
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
                            <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2 !px-3"
                                href="{{ route('bank-transactions.create') }}">
                                <iconify-icon icon="ic:round-plus" class="text-lg mr-1"></iconify-icon>
                                {{ __('New Transaction') }}
                            </a>
                            <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2.5"
                                href="{{ route('bank-transactions.index') }}">
                                <iconify-icon icon="mdi:refresh" class="text-xl"></iconify-icon>
                            </a>
                        `);
                    }
                });
            });
        </script>

        <script>
            function sweetAlertDelete(event, formId) {
                event.preventDefault();
                let form = document.getElementById(formId);
                Swal.fire({
                    title: '@lang('Are you sure ?')',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: '@lang('Delete')',
                    denyButtonText: '@lang('Cancel')',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            }
        </script>
    @endpush
</x-app-layout>
