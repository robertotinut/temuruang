<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Package;
use App\Models\Subscription;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['subscriptions' => function($q) {
            $q->where('status', 'active')->with('package');
        }])->get();
        $packages = Package::where('is_active', true)->get();
        return view('master.users.index', compact('users', 'packages'));
    }

    public function create()
    {
        return view('master.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:Owner,Admin,Customer',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'is_active' => $request->has('is_active') ? true : false,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('master.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('master.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:Owner,Admin,Customer',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('master.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('master.users.index')->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('master.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function assignPackage(Request $request, User $user)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::findOrFail($request->package_id);

        // Nonaktifkan langganan aktif yang lama
        Subscription::where('user_id', $user->id)
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        // Buat langganan baru
        Subscription::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'start_date' => now(),
            'end_date' => now()->addDays($package->duration_days),
            'status' => 'active',
        ]);

        return redirect()->route('master.users.index')->with('success', 'Paket ' . $package->name . ' berhasil diberikan kepada ' . $user->name . '.');
    }
}
