<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BankAccount;
use App\Models\Transaction; 
use Carbon\Carbon;

class DashboardController extends Controller
{
   public function index()
    {
        // Greeting based on time
        $currentHour = Carbon::now()->format('G');
        if ($currentHour >= 5 && $currentHour < 12) {
            $greeting = 'Good morning';
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }


        return view('dashboard', compact(
            'greeting',
          
           
        ));
    }
}
