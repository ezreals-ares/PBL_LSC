@extends('layouts.customer')

@section('title', 'Edit Ulasan')

@section('extra-styles')
<style>
    .review-header { margin-bottom: 2rem; }
    .review-header h1 { font-size: 2rem; font-weight: 800; color: var(--text-dark); }

    /* Star rating widget */
    .star-rating-widget { display: flex; gap: 0.4rem; margin-bottom: 0.5rem; }
    .star-btn {
        font-size: 2.5rem; cursor: pointer; color: var(--border);
        transition: all 0.15s ease; line-height: 1; user-select: none;
        background: none; border: none; padding: 0; font-family: sans-serif;
    }
    .star-btn.active, .star-btn.hovered { color: #f59e0b; transform: scale(1.15); }
    .star-label { font-size: 0.85rem; font-weight: 700; color: var(--primary); min-height: 1.2em; margin-bottom: 0.75rem; }

    /* Photo upload */
    .photo-upload-area {
        border: 2px dashed var(--border); border-radius: 16px; padding: 1.5rem;
        text-align: center; cursor: pointer; transition: all 0.2s;
        position: relative; background: var(--background);
    }
    .photo-upload-area:hover { border-color: var(--primary-light); background: #f0f9ff; }
    .photo-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .photo-upload-area p { color: var(--text-light); font-size: 0.82rem; margin-top: 0.3rem; }

    /* Char counter */
    .char-counter { font-size: 0.8rem; color: var(--text-light); text-align: right; margin-top: 0.3rem; }
    .char-counter.limit { color: var(--danger); }
</style>
@endsection

@section('content')

<div class="review-header">
    <h1>Edit Ulasan</h1>
</div>

@php
    $action      = route('review.update', $order->order_id);
    $method      = 'PUT';
    $submitLabel = 'Perbarui Ulasan';
    // $review is passed from the controller
@endphp

@include('review._form')

@endsection

@section('scripts')
<script>
const ratingLabels = {1:'Sangat Buruk',2:'Buruk',3:'Cukup',4:'Baik',5:'Sangat Baik ✨'};
let currentRating = parseInt(document.getElementById('rating-value').value) || 0;

function renderStars(upTo, isHover) {
    document.querySelectorAll('.star-btn').forEach(function(btn) {
        const star = parseInt(btn.dataset.star);
        btn.classList.toggle('active', !isHover && star <= currentRating);
        btn.classList.toggle('hovered', isHover && star <= upTo);
    });
}
function setRating(val) {
    currentRating = val;
    document.getElementById('rating-value').value = val;
    document.getElementById('star-label').textContent = ratingLabels[val] || '';
    renderStars(val, false);
}
function hoverRating(val) { renderStars(val, true); }
function unhoverRating() { renderStars(currentRating, false); }
if (currentRating) renderStars(currentRating, false);

// Comment counter
(function() {
    const ta = document.getElementById('comment');
    const counter = document.getElementById('comment-counter');
    if (!ta) return;
    function update() {
        const len = ta.value.length;
        counter.textContent = len + ' / 500 karakter';
        counter.classList.toggle('limit', len > 450);
    }
    ta.addEventListener('input', update);
    update();
})();

// Photo preview
function previewPhoto(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('new-photo-img').src = e.target.result;
        document.getElementById('new-photo-preview').style.display = 'inline-block';
    };
    reader.readAsDataURL(file);
}
function clearPhoto() {
    document.getElementById('photo-input').value = '';
    document.getElementById('new-photo-preview').style.display = 'none';
}
</script>
@endsection
