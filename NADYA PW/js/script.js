const judulLayanan = document.getElementById("judulLayanan");

if (judulLayanan) {
    judulLayanan.addEventListener("click", function () {
        judulLayanan.textContent = "Pilih Layanan Kendaraanmu!";
    });
}

const kartuLayanan = document.querySelectorAll(".service-card");

kartuLayanan.forEach(function (kartu) {

    // Event mouseover: saat kursor diarahkan ke kartu
    kartu.addEventListener("mouseover", function () {
        kartu.style.transform = "scale(1.03)";
    });

    // Event mouseout: saat kursor meninggalkan kartu
    kartu.addEventListener("mouseout", function () {
        kartu.style.transform = "scale(1)";
    });

    // Event click: saat kartu layanan diklik
    kartu.addEventListener("click", function () {

        const namaLayanan = kartu.querySelector("h3").textContent;

        // Popup confirm untuk memastikan pilihan pengguna
        const pilihan = confirm(
            "Apakah kamu ingin memilih layanan " + namaLayanan + "?"
        );

        if (pilihan) {

            // Web Storage: menyimpan pilihan layanan
            localStorage.setItem("layananAutomate", namaLayanan);

            // Popup alert untuk memberi informasi
            alert("Kamu memilih layanan: " + namaLayanan);

            tampilkanToast("Layanan berhasil dipilih!");
        }
    });
});

const tombolBooking = document.getElementById("bookBtn");

if (tombolBooking) {
    tombolBooking.addEventListener("click", function () {

        // Popup prompt untuk meminta nama pengguna
        const nama = prompt("Masukkan nama kamu:");

        if (nama && nama.trim() !== "") {

            // Popup confirm untuk konfirmasi booking
            const lanjut = confirm(
                "Halo, " + nama + "! Apakah kamu ingin lanjut ke halaman login?"
            );

            if (lanjut) {
                alert("Silakan login untuk melanjutkan booking.");

                window.location.href = "login.html";
            }

        } else if (nama !== null) {
            alert("Nama tidak boleh kosong!");
        }
    });
}

document.addEventListener("keydown", function (event) {

    // Jika pengguna menekan tombol Escape
    if (event.key === "Escape") {
        const toast = document.getElementById("toast");

        if (toast) {
            toast.classList.remove("show");
        }
    }
});


function tampilkanToast(pesan) {

    const toast = document.getElementById("toast");

    if (!toast) {
        return;
    }

    toast.textContent = pesan;
    toast.classList.add("show");

    // Asynchronous: menyembunyikan toast setelah 3 detik
    setTimeout(function () {
        toast.classList.remove("show");
    }, 3000);
}


function prosesLayanan() {

    return new Promise(function (resolve) {

        // Simulasi proses selama 1 detik
        setTimeout(function () {
            resolve("Proses layanan selesai!");
        }, 1000);

    });
}


// Contoh penggunaan Promise
prosesLayanan().then(function (pesan) {
    console.log(pesan);
});



fetch("https://jsonplaceholder.typicode.com/users/1")
    .then(function (response) {

        // Memeriksa apakah permintaan berhasil
        if (!response.ok) {
            throw new Error("Gagal mengambil data.");
        }

        return response.json();
    })
    .then(function (data) {

        // Menampilkan nama pengguna di Console
        console.log("Contoh data dari Fetch:", data.name);
    })
    .catch(function (error) {

        // Menangani jika terjadi kesalahan
        console.log("Fetch tidak berhasil:", error.message);
    });



const layananTersimpan = localStorage.getItem("layananAutomate");

if (layananTersimpan) {
    console.log("Pilihan layanan terakhir:", layananTersimpan);
}