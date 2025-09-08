<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $staff = User::latest()->paginate(10);
        return view('staff.index', compact('staff'));
    }

    public function create(): View
    {
        return view('staff.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,doctor,nurse,receptionist',
            'phone' => 'nullable|string|max:50',
            'specialization' => 'nullable|string|max:255',
        ]);

        $data['password'] = Hash::make($data['password']);
        User::create($data);

        return redirect()->route('staff.index')->with('status', 'Staff member created successfully');
    }

    public function show(User $staff): View
    {
        return view('staff.show', compact('staff'));
    }

    public function edit(User $staff): View
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, User $staff): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,doctor,nurse,receptionist',
            'phone' => 'nullable|string|max:50',
            'specialization' => 'nullable|string|max:255',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $staff->update($data);
        return redirect()->route('staff.index')->with('status', 'Staff member updated successfully');
    }

    public function destroy(User $staff): RedirectResponse
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('status', 'Staff member deleted successfully');
    }
}
