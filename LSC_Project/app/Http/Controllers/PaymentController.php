<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\PaySetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Show payment instructions and upload form.
     */
    public function show(Order $order)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        // Order must not be cancelled
        if ($order->status === 'dibatalkan') {
            return redirect()
                ->route('order.show', $order->order_id)
                ->with('error', 'Pesanan ini telah dibatalkan. Pembayaran tidak tersedia.');
        }

        $order->load(['orderDetails.service', 'payment']);

        // Ambil pengaturan metode pembayaran yang aktif
        $qrisSetting = PaySetting::getQris();
        $bankSetting  = PaySetting::getBank();

        return view('payment.show', compact('order', 'qrisSetting', 'bankSetting'));
    }

    /**
     * Store the first payment proof upload (no payment record yet).
     */
    public function store(Order $order, Request $request)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        // Cannot submit payment if one already exists
        abort_if($order->payment !== null, 403, 'Pembayaran sudah pernah dikirim.');

        $request->validate([
            'payment_method' => 'required|in:qris,bank-transfer',
            'payment_proof'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Petakan 'qris' → 'e-wallet' agar sesuai enum yang ada di DB
        $dbMethod = $request->payment_method === 'qris' ? 'e-wallet' : 'bank-transfer';

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        Payment::create([
            'order_id'       => $order->order_id,
            'payment_date'   => Carbon::today()->toDateString(),
            'amount'         => $order->total_price,
            'payment_method' => $dbMethod,
            'status'         => 'unverified',
            'payment_proof'  => $path,
        ]);

        return redirect()
            ->route('payment.show', $order->order_id)
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu konfirmasi admin.');
    }

    /**
     * Re-upload payment proof (replaces existing unverified record).
     */
    public function upload(Order $order, Request $request)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        $payment = $order->payment;

        // Must have an existing unverified payment to replace
        abort_if(!$payment || $payment->status === 'verified', 403);

        $request->validate([
            'payment_method' => 'required|in:qris,bank-transfer',
            'payment_proof'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Petakan 'qris' → 'e-wallet' agar sesuai enum yang ada di DB
        $dbMethod = $request->payment_method === 'qris' ? 'e-wallet' : 'bank-transfer';

        // Delete old proof file
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $payment->update([
            'payment_method' => $dbMethod,
            'payment_proof'  => $path,
            'payment_date'   => Carbon::today()->toDateString(),
        ]);

        return redirect()
            ->route('payment.show', $order->order_id)
            ->with('success', 'Bukti pembayaran berhasil diperbarui. Menunggu konfirmasi admin.');
    }
}
