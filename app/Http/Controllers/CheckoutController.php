<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Order;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::findOrFail($request->package_id);
        
        // Buat Order Number unik
        $orderNumber = 'TR-' . strtoupper(Str::random(5)) . '-' . time();

        // Jika harganya 0 (Free), langsung aktifkan
        if ($package->price <= 0) {
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => Auth::id(),
                'package_id' => $package->id,
                'amount' => 0,
                'status' => 'paid',
                'payment_type' => 'free',
            ]);

            // Buat Subscription
            Subscription::where('user_id', Auth::id())->where('status', 'active')->update(['status' => 'expired']);
            Subscription::create([
                'user_id' => Auth::id(),
                'package_id' => $package->id,
                'start_date' => now(),
                'end_date' => now()->addDays($package->duration_days ?? 365),
                'status' => 'active',
            ]);

            return redirect()->route('dashboard')->with('success', 'Paket gratis berhasil diaktifkan!');
        }

        // Simpan Order dengan status Pending (Menunggu Transfer)
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'amount' => $package->price,
            'status' => 'pending',
            'payment_type' => 'manual',
        ]);

        return redirect()->route('checkout.show', $order->id);
    }

    public function show(Order $order)
    {
        // Pastikan hanya pemilik order yang bisa melihat
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Jika sudah lunas, langsung ke dashboard
        if ($order->status === 'paid') {
            return redirect()->route('dashboard')->with('success', 'Pembayaran sudah selesai!');
        }

        // Nomor WA Admin dari .env
        $adminPhone = env('ADMIN_WHATSAPP', '6281234567890');
        
        $message = "Halo Admin TemuRuang, saya ingin konfirmasi pembayaran.\n\n"
                 . "Order ID: *" . $order->order_number . "*\n"
                 . "Paket: *" . $order->package->name . "*\n"
                 . "Total Tagihan: *Rp " . number_format($order->amount, 0, ',', '.') . "*\n"
                 . "Email Akun: *" . $order->user->email . "*\n\n"
                 . "Berikut saya lampirkan bukti transfernya.";
                 
        $waLink = "https://wa.me/" . $adminPhone . "?text=" . urlencode($message);

        return view('checkout.show', compact('order', 'waLink'));
    }
}
