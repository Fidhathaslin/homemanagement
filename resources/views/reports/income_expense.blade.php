<x-app-layout>
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Income & Expense Report</h2>

    <form method="GET" class="flex space-x-4 mb-6">
        <select name="month" class="border p-2 rounded">
            <option value="">Select Month</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
            @endforeach
        </select>

        <select name="year" class="border p-2 rounded">
            <option value="">Select Year</option>
            @for($y = now()->year; $y >= 2020; $y--)
                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>

        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded">
            Filter
        </button>
    </form>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-green-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Income</h3>
            <p class="text-2xl text-green-800 font-bold">QAR {{ number_format($income, 2) }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Total Expense</h3>
            <p class="text-2xl text-red-800 font-bold">QAR {{ number_format($expense, 2) }}</p>
        </div>
        <div class="bg-blue-100 p-4 rounded shadow">
            <h3 class="text-lg font-semibold">Balance</h3>
            <p class="text-2xl text-blue-800 font-bold">QAR {{ number_format($balance, 2) }}</p>
        </div>
    </div>
</div>
</x-app-layout>
