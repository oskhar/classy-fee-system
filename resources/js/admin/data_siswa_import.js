import { Core } from "./Core.js";

export class Main extends Core {
    constructor() {
        super();
        this.form = $("#import-form");
        this.loadingMessage = $("#loading");
        // this.setListeners();
    }

    setListeners() {
        const self = this;

        self.form.submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();
            console.log("test");
            // Menampilkan pesan loading saat proses impor dimulai
            self.loadingMessage.css("display", "block");

            // Menggunakan FormData untuk mengirimkan file Excel
            const formData = new FormData(self.form[0]);

            // Menggunakan metode post untuk mengirim data ke server
            self.doAjax(
                `${self.mainURL}/api/import/siswa`,
                (response) => {
                    // Menghilangkan pesan loading setelah proses impor selesai
                    self.loadingMessage.css("display", "none");

                    console.log(response);
                    // Menampilkan pesan sukses atau kesalahan berdasarkan respons dari server
                    if (response.success) {
                        // Tampilkan pesan sukses dan redirect jika berhasil
                        self.showSuccessAndRedirect(
                            response.success.message,
                            `${self.mainURL}/data-siswa`
                        );
                    } else {
                        // Tampilkan pesan kesalahan jika ada masalah saat impor
                        self.showErrorMessage(
                            "Terjadi kesalahan saat mengimpor data."
                        );
                    }
                },
                formData,
                "post"
            ); // Menggunakan metode POST untuk mengirim file
        });

        // Menambahkan event listener untuk mendengarkan perubahan pada input file
        const inputFile = $("#excel_file");
        const fileLabel = $("#file-label");

        inputFile.on("change", function () {
            // Mengambil nama file yang dipilih oleh pengguna
            const selectedFileName = self.files[0]?.name || "Pilih file";

            // Mengganti teks label dengan nama file yang dipilih
            fileLabel.text(selectedFileName);
        });
    }
}

$(function () {
    new Main();
});
