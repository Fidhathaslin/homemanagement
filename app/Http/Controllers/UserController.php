<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $breadcrumbsItems = [
            ['name' => 'Settings', 'url' => route('settings.index'), 'active' => false],
            ['name' => 'Users', 'url' => route('users.index'), 'active' => true],
        ];
    
        return view('users.index', [
            'users'             => User::latest()->with('roles')->get(['id','name','email','created_at']),
            'breadcrumbItems'   => $breadcrumbsItems,
            'pageTitle'         => 'Users'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $breadcrumbsItems = [
            ['name' => 'Users', 'url' => route('users.index'), 'active' => false],
            ['name' => 'Create', 'url' => route('users.create'), 'active' => true],
        ];

        return view('users.create', [
            'roles' => Role::all(),
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Create User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,name',
        ]);

        
        $role = Role::where('name', $validated['role'])->first();
        if (!$role) {
            return redirect()->route('users.index')->withErrors('Invalid role.');
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ])->assignRole($role);

        notify()->success('User created successfully.');

        return redirect()->route('users.index');
    }


    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $breadcrumbsItems = [
            ['name' => 'Users', 'url' => route('users.index'), 'active' => false],
            ['name' => 'Show', 'url' => '#', 'active' => true],
        ];

        return view('users.show', [
            'user' => $user,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Show User',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User
     * @return View
     */
    public function edit(User $user): View
    {
        $breadcrumbsItems = [
            ['name' => 'Users', 'url' => route('users.index'), 'active' => false],
            ['name' => 'Edit', 'url' => '#', 'active' => true],
        ];

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all(),
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Edit User',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest 
     * @param User 
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->only(['name', 'email']) + [
            'password' => $request->filled('password') ? bcrypt($request->password) : $user->password,
        ]);
        $user->syncRoles([$request->role]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User 
     * @return RedirectResponse
     */
   

public function destroy(User $user): RedirectResponse
{
    if (Auth::id() === $user->id) {

        notify()->error('You cannot delete your own account.');

        return redirect()->back();

    } elseif ($user->hasRole('super-admin')) {

        notify()->error('You cannot delete the super-admin user.');

        return redirect()->back();

    } else {
        $user->delete();

        notify()->success('User deleted successfully.');

        return redirect()->route('users.index');

    }
}

    
}
