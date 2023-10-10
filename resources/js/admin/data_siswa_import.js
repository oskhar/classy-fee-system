import { Core } from "./Core.js";

export class Main extends Core {
    constructor() {
        super();
        this.form = $("#import-form");
        this.loadingMessage = $("#loading");
        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");
        this.progressBar = $(".progress-bar");
        this.fetchTahunAjar();
        this.fetchNamaKelas();
        this.setListeners();
    }

    setListeners() {
        const self = this;

        self.form.submit(async function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Menampilkan pesan loading saat proses impor dimulai
            self.loadingMessage.show();

            // Menggunakan FormData untuk mengirimkan file Excel
            var formData = new FormData();
            await formData.append("excel_file", $("#excel-file")[0].files[0]);
            await self.progressBar.css("width", "15%");
            await formData.append("jenis_login", "admin");
            await self.progressBar.css("width", "30%");
            await formData.append("id_tahun_ajar", self.idTahunAjar.val());
            await self.progressBar.css("width", "45%");
            await formData.append("id_kelas", self.idKelas.val());
            await self.progressBar.css("width", "60%");
            // Menggunakan metode post untuk mengirim data ke server
            $.ajax({
                url: `${self.mainURL}/api/import/siswa`,
                type: "post",
                data: formData,
                dataType: "json",
                success: async (response) => {
                    await self.progressBar.css("width", "100%");
                    // Menghilangkan pesan loading setelah proses impor selesai
                    await self.loadingMessage.hide();
                    await self.progressBar.css("width", "0%");

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

    fetchTahunAjar() {
        const self = this;
        const url = `${self.mainURL}/api/tahun-ajar`;

        self.doAjax(url, function (response) {
            self.optionsList("tahun ajar", self.idTahunAjar, response.data);
        });
    }

    fetchNamaKelas() {
        const self = this;
        const url = `${self.mainURL}/api/kelas`;

        self.doAjax(url, function (response) {
            self.optionsList("nama kelas", self.idKelas, response.data);
        });
    }

    optionsList(namaData, selectElement, data) {
        selectElement.html(
            `<option value="" selected disabled>Pilih ${namaData}</option>`
        );
        $.each(data, function (index, item) {
            if (item.id_kelas) {
                selectElement.append(
                    $("<option>", {
                        value: item.id_kelas,
                        text: item.nama_kelas,
                    })
                );
            } else if (item.id_tahun_ajar) {
                selectElement.append(
                    $("<option>", {
                        value: item.id_tahun_ajar,
                        text: item.nama_tahun_ajar + " " + item.semester,
                    })
                );
            }
        });
    }
}

$(function () {
    new Main();
});
