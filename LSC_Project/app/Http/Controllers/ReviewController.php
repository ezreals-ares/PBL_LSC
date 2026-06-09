<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Show the create review form.
     */
    public function create(Order $order)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        // Only allow reviews for completed orders
        if ($order->status !== 'selesai') {
            return redirect()
                ->route('order.show', $order->order_id)
                ->with('error', 'Ulasan hanya dapat diberikan untuk pesanan yang sudah selesai.');
        }

        // If review already exists, redirect to edit
        if ($order->review) {
            return redirect()->route('review.edit', $order->order_id);
        }

        $order->load('orderDetails.service');

        return view('review.create', compact('order'));
    }

    /**
     * Store a new review.
     */
    public function store(Order $order, Request $request)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        // Double-check order status
        abort_if($order->status !== 'selesai', 403);

        // Prevent duplicate review
        abort_if($order->review !== null, 403, 'Ulasan sudah pernah dikirim.');

        $request->validate([
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'required|string|min:1|max:500',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'rating.required'  => 'Silakan pilih rating bintang terlebih dahulu.',
            'rating.between'   => 'Rating harus antara 1 hingga 5 bintang.',
            'comment.required' => 'Kolom ulasan tidak boleh kosong.',
            'comment.min'      => 'Ulasan harus diisi minimal 1 karakter.',
            'comment.max'      => 'Ulasan tidak boleh lebih dari 500 karakter.',
            'photo.image'      => 'File yang diunggah harus berupa gambar.',
            'photo.mimes'      => 'Format foto harus jpg, jpeg, png, atau webp.',
            'photo.max'        => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('review_photos', 'public');
        }

        Review::create([
            'order_id' => $order->order_id,
            'user_id'  => auth()->id(),
            'rating'   => $request->rating,
            'comment'  => $request->comment,
            'photo'    => $photoPath,
        ]);

        return redirect()
            ->route('order.show', $order->order_id)
            ->with('success', 'Terima kasih! Ulasan Anda telah berhasil dikirim.');
    }

    /**
     * Show the edit review form.
     */
    public function edit(Order $order)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        $review = $order->review;
        abort_if(!$review, 404);

        $order->load('orderDetails.service');

        return view('review.edit', compact('order', 'review'));
    }

    /**
     * Update an existing review.
     */
    public function update(Order $order, Request $request)
    {
        // Prevent accessing other users' orders
        abort_if($order->user_id !== auth()->id(), 403);

        $review = $order->review;
        abort_if(!$review, 404);

        $request->validate([
            'rating'  => 'required|integer|between:1,5',
            'comment' => 'required|string|min:1|max:500',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'rating.required'  => 'Silakan pilih rating bintang terlebih dahulu.',
            'rating.between'   => 'Rating harus antara 1 hingga 5 bintang.',
            'comment.required' => 'Kolom ulasan tidak boleh kosong.',
            'comment.min'      => 'Ulasan harus diisi minimal 1 karakter.',
            'comment.max'      => 'Ulasan tidak boleh lebih dari 500 karakter.',
            'photo.image'      => 'File yang diunggah harus berupa gambar.',
            'photo.mimes'      => 'Format foto harus jpg, jpeg, png, atau webp.',
            'photo.max'        => 'Ukuran foto tidak boleh lebih dari 2MB.',
        ]);

        $photoPath = $review->photo;

        // Replace photo if a new one is uploaded
        if ($request->hasFile('photo')) {
            if ($review->photo) {
                Storage::disk('public')->delete($review->photo);
            }
            $photoPath = $request->file('photo')->store('review_photos', 'public');
        }

        $review->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
            'photo'   => $photoPath,
        ]);

        return redirect()
            ->route('order.show', $order->order_id)
            ->with('success', 'Ulasan berhasil diperbarui.');
    }

    /**
     * Delete an existing review.
     */
    public function destroy(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $review = $order->review;
        abort_if(!$review, 404);

        if ($review->photo) {
            Storage::disk('public')->delete($review->photo);
        }

        $review->delete();

        return redirect()
            ->route('order.show', $order->order_id)
            ->with('success', 'Ulasan berhasil dihapus.');
    }
}
