<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublicInvitationInteractionController extends Controller
{
    public function storeRsvp(Request $request, Invitation $invitation): JsonResponse
    {
        abort_unless($invitation->status === 'published', 404);

        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:100'],
            'attendance_status' => ['required', 'in:Hadir,Tidak Hadir,Masih Ragu'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:10'],
        ]);

        $rsvp = $invitation->rsvps()->create($validated);

        return response()->json([
            'message' => 'Konfirmasi kehadiran berhasil dikirim.',
            'rsvp' => $rsvp,
        ], 201);
    }

    public function storeGuestBook(Request $request, Invitation $invitation): JsonResponse
    {
        abort_unless($invitation->status === 'published', 404);

        $validated = $request->validate([
            'guest_name' => ['required', 'string', 'max:100'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $guestBook = $invitation->guestBooks()->create($validated);

        return response()->json([
            'message' => 'Ucapan dan doa berhasil dikirim.',
            'wish' => [
                'name' => $guestBook->guest_name,
                'status' => 'Ucapan & Doa',
                'message' => $guestBook->message,
            ],
        ], 201);
    }
}
