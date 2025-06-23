<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\FinancialYear;
use Carbon\Carbon; 

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

      $request->session()->regenerate();

    $now = Carbon::now();

    

    $currentFY = FinancialYear::where('start_date', '<=', $now)
        ->where('end_date', '>=', $now)
        ->orderBy('created_at', 'desc')
        ->first();

    if (!$currentFY) {
        // If no financial year found, logout and show error
        Auth::logout();
        return redirect()->back()->withErrors([
            'email' => 'No active financial year found for today (' . $now->format('d M Y') . '). Please contact admin.',
        ]);
    }

    // Assign current FY to the user (or optionally session if needed)
    Auth::user()->update([
        'financial_year_id' => $currentFY->id,
    ]);


        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
