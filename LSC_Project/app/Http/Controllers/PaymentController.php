<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
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

        // Order must be at least 'diproses' before payment is needed
        // (status: pending → diproses → selesai; no 'dikonfirmasi' step in actual DB)
        if ($order->status === 'pending') {
            return redirect()
                ->route('order.show', $order->order_id)
                ->with('error', 'Pesanan belum dikonfirmasi admin. Pembayaran belum tersedia.');
        }

        $order->load(['orderDetails.service', 'payment']);

        return view('payment.show', compact('order'));
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
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        Payment::create([
            'order_id'       => $order->order_id,
            'payment_date'   => Carbon::today()->toDateString(),
            'amount'         => $order->total_price,
            'payment_method' => 'bank-transfer',
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
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Delete old proof file
        if ($payment->payment_proof) {
            Storage::disk('public')->delete($payment->payment_proof);
        }

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $payment->update([
            'payment_proof' => $path,
            'payment_date'  => Carbon::today()->toDateString(),
        ]);

        return redirect()
            ->route('payment.show', $order->order_id)
            ->with('success', 'Bukti pembayaran berhasil diperbarui. Menunggu konfirmasi admin.');
    }
}
