import { Core } from "./Core.js";

export class Main extends Core {
    constructor() {
        super();
        this.form = $("#import-form");
        this.loadingMessage = $("#loading");
        this.setListeners();
    }

    setListeners() {
        const self = this;

        self.form.submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Menampilkan pesan loading saat proses impor dimulai
            self.loadingMessage.show();

            // Menggunakan FormData untuk mengirimkan file Excel
            var formData = new FormData();
            formData.append("excel_file", $("#excel-file")[0].files[0]);
            formData.append("jenis_login", "admin");
            // Menggunakan metode post untuk mengirim data ke server
            $.ajax({
                url: `${self.mainURL}/api/import/siswa`,
                type: "post",
                data: formData,
                dataType: "json",
                success: (response) => {
                    // Menghilangkan pesan loading setelah proses impor selesai
                    self.loadingMessage.hide();

                    console.log(response);
                    // Menampilkan pesan sukses atau kesalahan berdasarkan respons dari server
                    if (response.success) {
                        // Tampilkan pesan sukses dan redirect jika berhasil
                        self.showSuccessAndRedirect(
                            response.success.message,
                            `${self.mainURL}/admin/data-siswa`
                        );
                    } else {
                        // Tampilkan pesan kesalahan jika ada masalah saat impor
                        self.showErrorMessage(
                            "Terjadi kesalahan saat mengimpor data."
                        );
                    }
                },
                error: (xhr) => {
                    // Menampilkan pesan error AJAX
                    let errors;
                    console.log(xhr);
                    if (xhr.responseJSON.errors) {
                        errors = self.objectToString(xhr.responseJSON.errors);
                    } else {
                        errors = self.objectToString(xhr.responseJSON);
                    }
                    self.showErrorMessage(errors).then(() => {
                        if (xhr.status == 401) {
                            window.location.href = "/";
                        }
                    });
                },
                // Tambahan untuk mengirimkan file dengan benar
                processData: false,
                contentType: false,
            });
        });

        // Menambahkan event listener untuk mendengarkan perubahan pada input file
        const inputFile = $("#excel-file");
        const fileLabel = $("#file-label");

        inputFile.on("change", function () {
            // Mengambil nama file yang dipilih oleh pengguna
            const selectedFileName = this.files[0]?.name || "Pilih file";

            // Mengganti teks label dengan nama file yang dipilih
            fileLabel.text(selectedFileName);
        });
    }
}

$(function () {
    new Main();
});
