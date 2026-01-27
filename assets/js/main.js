// ===============================
// MAIN JAVASCRIPT TOKO BUNGA
// ===============================

// Konfirmasi hapus (dipakai admin)
function confirmDelete(message = "Yakin ingin menghapus data ini?") {
    return confirm(message);
}

// Format rupiah (opsional)
function formatRupiah(angka) {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        minimumFractionDigits: 0
    }).format(angka);
}

// Update total harga di halaman checkout
document.addEventListener("DOMContentLoaded", function () {
    const qtyInput = document.querySelector("#quantity");
    const priceInput = document.querySelector("#price");
    const totalEl = document.querySelector("#total_price");

    if (qtyInput && priceInput && totalEl) {
        function updateTotal() {
            const qty = parseInt(qtyInput.value) || 0;
            const price = parseInt(priceInput.value) || 0;
            totalEl.innerText = formatRupiah(qty * price);
        }

        qtyInput.addEventListener("input", updateTotal);
        updateTotal();
    }
});
