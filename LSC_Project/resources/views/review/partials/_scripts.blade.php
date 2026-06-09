<script>
// ── Star Rating ────────────────────────────────────────────────────
const ratingLabels = {1:'Sangat Buruk',2:'Buruk',3:'Cukup',4:'Baik',5:'Sangat Baik ✨'};
let currentRating = parseInt(document.getElementById('rating-value').value) || 0;

function renderStars(upTo, isHover) {
    document.querySelectorAll('.star-btn').forEach(function(btn) {
        const val = parseInt(btn.dataset.star);
        if (isHover) {
            btn.style.color = val <= upTo ? '#fed01b' : '#c2c6d6';
            btn.style.transform = val <= upTo ? 'scale(1.2)' : 'scale(1)';
        } else {
            btn.style.color = val <= currentRating ? '#fed01b' : '#c2c6d6';
            btn.style.transform = 'scale(1)';
        }
    });
}

function setStar(val) {
    currentRating = val;
    document.getElementById('rating-value').value = val;
    document.getElementById('star-label').textContent = ratingLabels[val] || '';
    renderStars(val, false);
}

function hoverStar(val) { renderStars(val, true); }
function unhoverStar()  { renderStars(currentRating, false); }

// Init stars if editing
if (currentRating) renderStars(currentRating, false);

// ── Comment Counter ────────────────────────────────────────────────
(function() {
    const ta      = document.getElementById('comment');
    const counter = document.getElementById('comment-counter');
    if (!ta) return;
    function update() {
        const len = ta.value.length;
        counter.textContent = len + ' / 500';
        counter.className = 'text-xs font-bold ' + (len > 450 ? 'text-danger' : 'text-on-surface-variant');
    }
    ta.addEventListener('input', update);
    update();
})();

// ── Photo Preview ──────────────────────────────────────────────────
function previewPhoto(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('new-photo-img').src = e.target.result;
        document.getElementById('new-photo-preview').classList.remove('hidden');
        document.getElementById('photo-filename').textContent = file.name;
        document.getElementById('photo-text').textContent = 'Foto dipilih!';
    };
    reader.readAsDataURL(file);
}

function clearPhoto() {
    document.getElementById('photo-input').value = '';
    document.getElementById('new-photo-preview').classList.add('hidden');
    document.getElementById('photo-text').textContent = 'Tambah foto hasil bersih';
}
</script>
