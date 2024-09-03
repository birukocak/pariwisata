function openModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
}

function calculateTotal() {
    var packagePrice = parseInt(document.getElementById('package').value) || 0;
    var quantity = parseInt(document.getElementById('quantity').value) || 0;
    var total = packagePrice * quantity;

    document.getElementById('total').value = total;
}

document.getElementById('package').addEventListener('change', calculateTotal);
document.getElementById('quantity').addEventListener('input', calculateTotal);



function confirmBooking() {
    if (confirm("Apakah Anda yakin ingin memesan tiket ini?")) {
        document.getElementById("bookingForm").submit();
    }
}

