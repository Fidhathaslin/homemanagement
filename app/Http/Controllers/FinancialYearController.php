<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\FinancialYear;

class FinancialYearController extends Controller
{

        public function index(): View
        {
            $financialYears = FinancialYear::latest()->get();

            $breadcrumbItems = [
                ['name' => 'Financial Years', 'url' => route('financial-years.index'), 'active' => true],
            ];

            return view('financial_year.index', [
                'financialYears' => $financialYears,
                'breadcrumbItems' => $breadcrumbItems,
                'pageTitle' => 'Financial Years',
            ]);
        }
   
        public function create(): View
        {
            $breadcrumbItems = [
            
                ['name' => 'Create', 'url' => route('financial-years.create'), 'active' => true],
            ];

            return view('financial_year.create', [
                'breadcrumbItems' => $breadcrumbItems,
                'pageTitle' => 'Financial Year',
            ]);
        }

        public function store(Request $request)
        {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Store data
        FinancialYear::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
        ]);

        notify()->success('Financial Years created successfully.');
            return redirect()->route('financial-years.index');
        }


        public function edit(FinancialYear $financialYear): View
{
    $breadcrumbItems = [
            
                ['name' => 'Edit', 'url' => route('financial-years.create'), 'active' => true],
            ];

    return view('financial_year.edit', [
        'financialYear' => $financialYear,
        'breadcrumbItems' => $breadcrumbItems,
        'pageTitle' => 'Edit Financial Year',
    ]);
}

public function update(Request $request, FinancialYear $financialYear)
{
    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    // Update the financial year
    $financialYear->update([
        'name' => $request->input('name'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
    ]);

    notify()->success('Financial Year updated successfully.');

    return redirect()->route('financial-years.index');
}








        public function destroy(FinancialYear $financialYear)
        {
            $financialYear->delete();

            return redirect()->route('financial-years.index')
                ->with('success', 'Financial Year deleted successfully.');
        }


}
