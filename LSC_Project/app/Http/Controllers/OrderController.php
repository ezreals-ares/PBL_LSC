<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show the order creation form.
     * Admins are redirected to their dashboard instead.
     */
    public function create()
    {
        // Admins should not use the customer booking form
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        }

        $services = Service::orderBy('service_name')->get();

        return view('order.create', compact('services'));
    }

    /**
     * Store a new order.
     */
    public function store(Request $request)
    {
        // Admins should not create customer orders
        if (auth()->user()->role === 'admin') {
            return redirect('/admin');
        }

        $request->validate([
            'services'         => 'required|array|min:1',
            'services.*'       => 'exists:services,service_id',
            'quantities'       => 'required|array',
            'quantities.*'     => 'integer|min:1|max:99',
            'pickup_method'    => 'required|in:pickup,antar langsung',
            'jenis_sepatu'     => 'nullable|string|max:100',
            'material_sepatu'  => 'nullable|string|max:100',
            'catatan'          => 'nullable|string|max:500',
        ]);

        // Fetch only the selected services from DB
        $selectedIds = $request->input('services');
        $services = Service::whereIn('service_id', $selectedIds)->get()->keyBy('service_id');

        // Calculate totals
        $totalPrice    = 0;
        $maxDays       = 0;
        $orderDetails  = [];

        foreach ($selectedIds as $serviceId) {
            if (!isset($services[$serviceId])) {
                continue;
            }

            $service  = $services[$serviceId];
            $quantity = (int) $request->input("quantities.{$serviceId}", 1);
            $subtotal = $service->price * $quantity;

            $totalPrice += $subtotal;

            if ($service->estimated_days > $maxDays) {
                $maxDays = $service->estimated_days;
            }

            $orderDetails[] = [
                'service_id' => $serviceId,
                'quantity'   => $quantity,
                'subtotal'   => $subtotal,
            ];
        }

        $estimatedFinish = Carbon::today()->addDays($maxDays)->toDateString();

        // Create the order inside a transaction for data integrity
        $order = DB::transaction(function () use ($request, $totalPrice, $estimatedFinish, $orderDetails) {
            $order = Order::create([
                'user_id'          => auth()->id(),
                'order_date'       => Carbon::today()->toDateString(),
                'pickup_method'    => $request->pickup_method,
                'status'           => 'pending',
                'estimated_finish' => $estimatedFinish,
                'total_price'      => $totalPrice,
                'jenis_sepatu'     => $request->jenis_sepatu,
                'material_sepatu'  => $request->material_sepatu,
                'catatan'          => $request->catatan,
            ]);

            foreach ($orderDetails as $detail) {
                OrderDetail::create([
                    'order_id'   => $order->order_id,
                    'service_id' => $detail['service_id'],
                    'quantity'   => $detail['quantity'],
                    'subtotal'   => $detail['subtotal'],
                ]);
            }

            return $order;
        });

        return redirect()
            ->route('order.show', $order->order_id)
            ->with('success', 'Pesanan berhasil dibuat! Mohon tunggu konfirmasi dari admin.');
    }

    /**
     * Show order detail and tracking.
     */
    public function show(Order $order)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['orderDetails.service', 'payment', 'review']);

        return view('order.show', compact('order'));
    }

    /**
     * Show all orders for the authenticated customer.
     */
    public function history()
    {
        $orders = auth()->user()
            ->orders()
            ->with(['orderDetails.service', 'payment'])
            ->latest('order_date')
            ->get();

        return view('order.history', compact('orders'));
    }

    /**
     * Cancel a pending order.
     */
    public function cancel(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan karena sudah diproses.');
        }

        $order->update(['status' => 'dibatalkan']);

        return redirect()
            ->route('order.history')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
