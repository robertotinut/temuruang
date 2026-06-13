<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function store(Request $request, Invitation $invitation)
    {
        $this->authorizeAccess($invitation);

        $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $invitation->guests()->create([
            'name' => $request->name,
            'group' => $request->group,
            'phone' => $request->phone,
            'is_sent' => false,
        ]);

        return back()->with('success', 'Tamu berhasil ditambahkan.');
    }

    public function update(Request $request, Guest $guest)
    {
        $this->authorizeAccess($guest->invitation);

        $request->validate([
            'name' => 'required|string|max:255',
            'group' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $guest->update([
            'name' => $request->name,
            'group' => $request->group,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Data tamu berhasil diperbarui.');
    }

    public function destroy(Guest $guest)
    {
        $this->authorizeAccess($guest->invitation);
        
        $guest->delete();

        return back()->with('success', 'Tamu berhasil dihapus.');
    }

    public function markAsSent(Guest $guest)
    {
        $this->authorizeAccess($guest->invitation);
        
        $guest->update(['is_sent' => true]);

        return back()->with('success', 'Status tamu ditandai sebagai terkirim.');
    }

    private function authorizeAccess(Invitation $invitation)
    {
        $user = Auth::user();
        if (!$user->isOwner() && !$user->isAdmin() && $invitation->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }
}
