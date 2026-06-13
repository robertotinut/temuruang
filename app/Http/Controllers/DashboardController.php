<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Invitation;
use App\Models\Rsvp;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $stats = [];
        $activeSubscription = null;
        $packages = [];
        
        if ($user->isOwner() || $user->isAdmin()) {
            $stats['total_user'] = User::count();
            $stats['total_customer'] = User::where('role', 'Customer')->count();
            $stats['total_invitation'] = Invitation::count();
            $stats['total_rsvp'] = Rsvp::count();
        } else {
            $userInvitationIds = Invitation::where('user_id', $user->id)->pluck('id');
            $stats['total_invitation'] = $userInvitationIds->count();
            $stats['total_rsvp'] = Rsvp::whereIn('invitation_id', $userInvitationIds)->count();
            $stats['total_guest'] = Rsvp::whereIn('invitation_id', $userInvitationIds)
                                        ->where('attendance_status', 'Hadir')
                                        ->sum('guest_count');
                                        
            $activeSubscription = Subscription::where('user_id', $user->id)
                                            ->where('status', 'active')
                                            ->whereDate('end_date', '>=', today())
                                            ->with('package')
                                            ->first();
            $packages = Package::all();
        }

        return view('dashboard', compact('stats', 'activeSubscription', 'packages'));
    }
}
