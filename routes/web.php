<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $templates = \App\Models\Template::where('is_active', true)->get();
    $packages = \App\Models\Package::where('is_active', true)->get();
    return view('welcome', compact('templates', 'packages'));
});

// Public static template preview (V1: static first, dynamic later)
Route::get('/preview/templates/{slug}', function (string $slug) {
    // Determine category from the slug (e.g., "birthday-01" -> "birthday")
    $category = explode('-', $slug)[0];
    $viewName = 'templates.' . $category . '.' . $slug;
    
    abort_unless(view()->exists($viewName), 404);

    return view($viewName);
})->name('templates.preview');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/invitations/{invitation}/guests', [\App\Http\Controllers\GuestController::class, 'store'])->name('guests.store');
    Route::put('/guests/{guest}', [\App\Http\Controllers\GuestController::class, 'update'])->name('guests.update');
    Route::delete('/guests/{guest}', [\App\Http\Controllers\GuestController::class, 'destroy'])->name('guests.destroy');
    Route::patch('/guests/{guest}/sent', [\App\Http\Controllers\GuestController::class, 'markAsSent'])->name('guests.sent');

    Route::post('/checkout', [\App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/{order}', [\App\Http\Controllers\CheckoutController::class, 'show'])->name('checkout.show');

    Route::prefix('master')->name('master.')->group(function() {
        Route::resource('event-types', \App\Http\Controllers\EventTypeController::class);
        Route::resource('templates', \App\Http\Controllers\TemplateController::class);
        Route::resource('packages', \App\Http\Controllers\PackageController::class);
        Route::post('users/{user}/assign-package', [\App\Http\Controllers\UserController::class, 'assignPackage'])->name('users.assign_package');
        Route::resource('users', \App\Http\Controllers\UserController::class);
    });

    Route::resource('invitations', \App\Http\Controllers\InvitationController::class);
    Route::patch('invitations/{invitation}/publish', [\App\Http\Controllers\InvitationController::class, 'publish'])->name('invitations.publish');
});

// Google Auth Routes
Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';

// Public pages routes
Route::get('/templates', function () {
    $templates = \App\Models\Template::with('eventType')->where('is_active', true)->get();
    $groupedTemplates = $templates->groupBy(function($item) {
        return $item->eventType ? $item->eventType->name : 'Lainnya';
    });
    return view('front.templates', compact('groupedTemplates'));
});

Route::get('/pricing', function () {
    $packages = \App\Models\Package::where('is_active', true)->get();
    return view('front.pricing', compact('packages'));
});

// Public Invitation Route
Route::get('/{slug}', function (string $slug) {
    $invitation = \App\Models\Invitation::with(['eventType', 'template', 'galleries', 'stories', 'rsvps', 'guestBooks'])
        ->where('slug', $slug)
        ->firstOrFail();

    // Pastikan invitation sudah di-publish, kecuali admin/owner yang login
    $user = auth()->user();
    if ($invitation->status !== 'published') {
        if (!$user || (!$user->isOwner() && !$user->isAdmin() && $user->id !== $invitation->user_id)) {
            abort(404, 'Undangan belum aktif atau tidak ditemukan.');
        }
    }

    // Gunakan custom_view_path jika ada
    if ($invitation->custom_view_path) {
        return view('templates.forcustomer.' . $invitation->custom_view_path, compact('invitation'));
    }

    // Jika tidak ada custom view, gunakan template dari database
    abort_unless($invitation->template, 404, 'Template undangan tidak ditemukan.');
    return view($invitation->template->view_path, compact('invitation'));
})->name('invitation.public');
