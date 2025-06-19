<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BankTransactionController;
use App\Http\Controllers\FinancialYearController;
use App\Http\Controllers\BankController;


Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware'    => 'auth'
], function() {

    // Dashboard Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::group([
        'as'        => 'profile.',
        'prefix'    => 'profile'
    ], function() {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    //User Routes
    Route::group([
        'as' => 'users.',
        'prefix' => 'users',
        'middleware' => 'can:users-view'
    ], function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('can:users-create');
        Route::post('/store', [UserController::class, 'store'])->name('store')->middleware('can:users-create');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit')->middleware('can:users-edit');
        Route::patch('/update/{user}', [UserController::class, 'update'])->name('update')->middleware('can:users-edit');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('delete')->middleware('can:users-delete');
    });


  

    //Settings routes
    Route::group([
        'as'            => 'settings.',
        'prefix'        => 'settings',
        // 'middleware'    => 'can:settings-view'
    ], function() {
        Route::get('/', function () {
            $pageTitle = 'Settings'; 
            $breadcrumbItems = [
                [
                    'name' => 'Settings',
                    'url' => route('settings.index'),
                    'active' => true,
                ]
            ];
        
            return view('settings.index', [
                'pageTitle'         => $pageTitle,
                'breadcrumbItems'   => $breadcrumbItems,
            ]); 
        })->name('index');

        // Roles & Permissions
        Route::group([
            'as'        => 'roles.', 
            'prefix'    => 'roles',
            'middleware'=> 'can:roles-view'
        ], function() {
        
            // Roles Routes
            Route::get('/', [RolesAndPermissionController::class, 'index'])->name('index');
            Route::get('/create', [RolesAndPermissionController::class, 'create'])->name('create')->middleware('can:roles-create');
            Route::post('/store', [RolesAndPermissionController::class, 'store'])->name('store')->middleware('can:roles-create');
            Route::get('/edit/{role}', [RolesAndPermissionController::class, 'edit'])->name('edit');
            Route::put('/update/{role}', [RolesAndPermissionController::class, 'update'])->name('update');
            Route::delete('/delete/{role}', [RolesAndPermissionController::class, 'destroy'])->name('destroy');
        
                // Permissions Routes
            Route::group([
                'as' => 'permissions.', 
                'prefix' => 'permissions',
                'middleware' => 'can:permissions-view'
                ], function() {
                Route::get('/', [RolesAndPermissionController::class, 'permissionIndex'])->name('index');
            });
        });
    });
      // Financial Year Routes
    Route::group([
        'as' => 'financial-years.',
        'prefix' => 'financial-years',
        // 'middleware' => 'can:financial-years-view'
    ], function () {
        Route::get('/', [FinancialYearController::class, 'index'])->name('index');
        Route::get('/create', [FinancialYearController::class, 'create'])->name('create');
        Route::post('/store', [FinancialYearController::class, 'store'])->name('store');
          Route::get('/edit/{financialYear}', [FinancialYearController::class, 'edit'])->name('edit');
         Route::patch('/update/{financialYear}', [FinancialYearController::class, 'update'])->name('update');
        Route::delete('/delete/{financialYear}', [FinancialYearController::class, 'destroy'])->name('destroy');
    });
      Route::group([
        'as' => 'bank-accounts.',
        'prefix' => 'bank-accounts',
        // 'middleware' => 'can:bank-accounts-view' 
    ], function () {
        Route::get('/', [BankAccountController::class, 'index'])->name('index');
        Route::get('/create', [BankAccountController::class, 'create'])->name('create');
        Route::post('/store', [BankAccountController::class, 'store'])->name('store');
         Route::get('/edit/{bankAccount}', [BankAccountController::class, 'edit'])->name('edit');
         Route::patch('/update/{bankAccount}', [BankAccountController::class, 'update'])->name('update');
        Route::delete('/delete/{bankAccount}', [BankAccountController::class, 'destroy'])->name('destroy');
    });

       Route::group([
        'as' => 'bank-transactions.',
        'prefix' => 'bank-transactions',
        // 'middleware' => 'can:bank-transactions-view' 
    ], function () {
        Route::get('/', [BankTransactionController::class, 'index'])->name('index');
        Route::get('/create', [BankTransactionController::class, 'create'])->name('create');
        Route::post('/store', [BankTransactionController::class, 'store'])->name('store');
         Route::get('/edit/{bankTransaction}', [BankTransactionController::class, 'edit'])->name('edit');
         Route::patch('/update/{bankTransaction}', [BankTransactionController::class, 'update'])->name('update');
        Route::delete('/delete/{bankTransaction}', [BankTransactionController::class, 'destroy'])->name('destroy');
    });

});

require __DIR__.'/auth.php';
