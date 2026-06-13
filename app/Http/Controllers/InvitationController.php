<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\EventType;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvitationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isOwner() || $user->isAdmin()) {
            $invitations = Invitation::with(['user', 'eventType', 'template'])->latest()->get();
        } else {
            $invitations = Invitation::with(['eventType', 'template'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        $eventTypes = EventType::where('is_active', true)->get();
        $templates = Template::where('is_active', true)->get();
        
        $user = Auth::user();
        if ($user->isOwner() || $user->isAdmin()) {
            $customers = \App\Models\User::where('role', 'Customer')->get();
            
            // Get custom files
            $customFiles = [];
            $customerPath = resource_path('views/templates/forcustomer');
            if (\Illuminate\Support\Facades\File::exists($customerPath)) {
                $files = \Illuminate\Support\Facades\File::files($customerPath);
                foreach ($files as $file) {
                    if ($file->getExtension() === 'php' && strpos($file->getFilename(), '.blade.php') !== false) {
                        $customFiles[] = str_replace('.blade.php', '', $file->getFilename());
                    }
                }
            }

            return view('invitations.create_admin', compact('eventTypes', 'templates', 'customers', 'customFiles'));
        }

        // Customer uses the simple gallery view
        return view('invitations.create', compact('eventTypes', 'templates'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdminAccess();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'event_type_id' => 'required|exists:event_types,id',
            'template_id' => 'nullable|exists:templates,id',
            'custom_view_path' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only([
            'title', 'event_type_id', 'template_id', 'custom_view_path',
            'event_date', 'event_time', 'location',
            'address', 'google_maps_url', 'description',
        ]);

        // Assign to the selected customer
        $data['user_id'] = $request->user_id;
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(6);
        $data['status'] = 'draft';

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('invitations', 'public');
        }

        Invitation::create($data);

        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dibuat dan ditugaskan ke customer.');
    }

    public function show(Invitation $invitation)
    {
        $this->authorizeAccess($invitation);
        
        // Customer can only view if published
        $user = Auth::user();
        if (!$user->isOwner() && !$user->isAdmin() && $invitation->status !== 'published') {
            abort(403, 'Undangan belum aktif. Silakan hubungi admin.');
        }

        $invitation->load(['eventType', 'template', 'galleries', 'stories', 'rsvps', 'guestBooks', 'guests']);
        return view('invitations.show', compact('invitation'));
    }

    public function edit(Invitation $invitation)
    {
        $this->authorizeAdminAccess();
        
        $eventTypes = EventType::where('is_active', true)->get();
        $templates = Template::where('is_active', true)->get();
        $customers = \App\Models\User::where('role', 'Customer')->get();
        
        // Get custom files
        $customFiles = [];
        $customerPath = resource_path('views/templates/forcustomer');
        if (\Illuminate\Support\Facades\File::exists($customerPath)) {
            $files = \Illuminate\Support\Facades\File::files($customerPath);
            foreach ($files as $file) {
                if ($file->getExtension() === 'php' && strpos($file->getFilename(), '.blade.php') !== false) {
                    $customFiles[] = str_replace('.blade.php', '', $file->getFilename());
                }
            }
        }

        return view('invitations.edit', compact('invitation', 'eventTypes', 'templates', 'customers', 'customFiles'));
    }

    public function update(Request $request, Invitation $invitation)
    {
        $this->authorizeAdminAccess();

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'event_type_id' => 'required|exists:event_types,id',
            'template_id' => 'nullable|exists:templates,id',
            'custom_view_path' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->only([
            'user_id', 'title', 'event_type_id', 'template_id', 'custom_view_path',
            'event_date', 'event_time', 'location',
            'address', 'google_maps_url', 'description',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($invitation->cover_image) {
                Storage::disk('public')->delete($invitation->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('invitations', 'public');
        }

        $invitation->update($data);

        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil diperbarui.');
    }

    public function destroy(Invitation $invitation)
    {
        $this->authorizeAdminAccess();

        if ($invitation->cover_image) {
            Storage::disk('public')->delete($invitation->cover_image);
        }

        $invitation->delete();

        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dihapus.');
    }

    public function publish(Invitation $invitation)
    {
        $this->authorizeAdminAccess();

        $invitation->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('invitations.index')->with('success', 'Undangan berhasil dipublikasikan.');
    }

    private function authorizeAccess(Invitation $invitation)
    {
        $user = Auth::user();
        if (!$user->isOwner() && !$user->isAdmin() && $invitation->user_id !== $user->id) {
            abort(403, 'Unauthorized');
        }
    }

    private function authorizeAdminAccess()
    {
        $user = Auth::user();
        if (!$user->isOwner() && !$user->isAdmin()) {
            abort(403, 'Akses khusus Admin.');
        }
    }
}
