function hapusData(button) {
    button.parentElement.parentElement.remove();
}

function editData(button) {
    let row = button.parentElement.parentElement;

    let layanan = prompt("Ubah layanan:", row.cells[1].innerText);

    if (layanan != null && layanan != "") {
        row.cells[1].innerText = layanan;
    }
}

function tambahData() {

    let layanan = prompt("Masukkan layanan:");
    let kendaraan = prompt("Masukkan kendaraan:");
    let tanggal = prompt("Masukkan tanggal:");

    if (layanan && kendaraan && tanggal) {

        let table = document.getElementById("dataBooking");

        let nomor = table.rows.length + 1;

        let row = table.insertRow();

        row.innerHTML = `
            <td>${nomor}</td>
            <td>${layanan}</td>
            <td>${kendaraan}</td>
            <td>${tanggal}</td>
            <td>
                <button onclick="editData(this)">Edit</button>
                <button onclick="hapusData(this)">Hapus</button>
            </td>
        `;
    }
}
function tambahKendaraan() {

    let nama = prompt("Masukkan nama kendaraan:");
    let plat = prompt("Masukkan nomor polisi:");

    if (nama && plat) {

        let table = document.getElementById("dataKendaraan");

        let nomor = table.rows.length + 1;

        let row = table.insertRow();

        row.innerHTML = `
            <td>${nomor}</td>
            <td>${nama}</td>
            <td>${plat}</td>
            <td>Aktif</td>
            <td>
                <button onclick="editKendaraan(this)">Edit</button>
                <button onclick="hapusKendaraan(this)">Hapus</button>
            </td>
        `;
    }
}


function editKendaraan(button) {

    let row = button.parentElement.parentElement;

    let nama = prompt(
        "Ubah nama kendaraan:",
        row.cells[1].innerText
    );

    if (nama) {
        row.cells[1].innerText = nama;
    }
}


function hapusKendaraan(button) {

    button.parentElement.parentElement.remove();
}