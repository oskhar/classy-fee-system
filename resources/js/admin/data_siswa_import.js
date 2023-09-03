// Import class Core dari core.js
import { Core } from "./Core.js";

// Buat kelas turunan yang menangani impor data
export class DataImport extends Core {
    constructor() {
        super(); // Memanggil konstruktor dari kelas induk (Core)
        this.form = document.getElementById("import-form"); // Mendapatkan elemen formulir
        this.importButton = document.getElementById("import-button"); // Mendapatkan tombol impor
        this.loadingMessage = document.getElementById("loading"); // Mendapatkan elemen pesan loading
        this.uploadStatus = document.getElementById("upload-status"); // Mendapatkan elemen pesan upload
    }

    initImport() {
        // Menambahkan event listener untuk menginisiasi impor data saat tombol diklik
        this.importButton.addEventListener("click", () => {
            this.importData();
        });
    }

    importData() {
        // Menampilkan pesan loading saat proses impor dimulai
        this.loadingMessage.style.display = "block";

        // Menggunakan FormData untuk mengirimkan file Excel
        const formData = new FormData(this.form);

        // Menggunakan metode post untuk mengirim data ke server
        this.doAjax(
            "/import/siswa",
            (response) => {
                // Menyembunyikan pesan loading setelah selesai
                this.loadingMessage.style.display = "none";

                // Menampilkan pesan sukses atau kesalahan berdasarkan respons dari server
                if (response.success) {
                    // Tampilkan pesan sukses dan redirect jika berhasil
                    this.showSuccessAndRedirect(
                        "Data berhasil diimpor.",
                        "/redirect-url"
                    );

                    // Tampilkan pesan upload sukses
                    this.uploadStatus.innerHTML = "File berhasil diunggah.";
                    this.uploadStatus.style.display = "block";
                } else {
                    // Tampilkan pesan kesalahan jika ada masalah saat impor
                    this.showErrorMessage(
                        "Terjadi kesalahan saat mengimpor data."
                    );
                }
            },
            formData,
            "post"
        ); // Menggunakan metode POST untuk mengirim file
    }
}

// Inisialisasi objek DataImport
const dataImport = new DataImport();
dataImport.initImport(); // Inisiasi impor data saat halaman dimuat
