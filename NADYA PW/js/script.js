// DOM 1: Mengubah teks judul layanan
const judulLayanan = document.getElementById("judulLayanan");

judulLayanan.addEventListener("click", function () {
    judulLayanan.textContent = "Pilih Layanan Kendaraanmu!";
});


// DOM 2: Memilih kartu layanan
const kartuLayanan = document.querySelectorAll(".service-card");

kartuLayanan.forEach(function (kartu) {
    kartu.addEventListener("click", function () {
        kartu.classList.toggle("selected");

        const namaLayanan = kartu.querySelector("h3").textContent;

        tampilkanToast("Kamu memilih " + namaLayanan);
    });
});


// DOM 3: Tombol booking
const tombolBooking = document.getElementById("bookBtn");

tombolBooking.addEventListener("click", function () {
    tampilkanToast("Silakan login untuk melakukan booking!");
});


// Toast / Snackbar
function tampilkanToast(pesan) {
    const toast = document.getElementById("toast");

    toast.textContent = pesan;
    toast.classList.add("show");

    setTimeout(function () {
        toast.classList.remove("show");
    }, 3000);
}