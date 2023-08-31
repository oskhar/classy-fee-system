import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.inputNamaKelas = $("#nama_kelas");
        this.inputIdJurusan = $("#id_jurusan");
        this.inputStatusData = $("#status_data");
        this.paramIdKelas = this.getIdKelas();

        this.setInputJurusan();
        this.setFormData();
        this.setListener();
    }

    setFormData() {
        const self = this;
        let url = `${self.mainURL}/api/kelas`;
        let dataBody = { id_kelas: self.paramIdKelas };

        this.doAjax(
            url,
            function (response) {
                self.inputNamaKelas.val(response.data.nama_kelas);

                // Pilih opsi yang memiliki value sesuai dengan id_jurusan
                self.inputIdJurusan
                    .find('option[value="' + response.data.id_jurusan + '"]')
                    .prop("selected", true);

                // Pilih opsi yang memiliki value sesuai dengan status_data
                self.inputStatusData
                    .find('option[value="' + response.data.status_data + '"]')
                    .prop("selected", true);
            },
            dataBody
        );
    }

    setInputJurusan() {
        const self = this; // Simpan referensi this dalam variabel self

        // Assigmen data yang diperlukan untuk mengakses API
        let url = `${self.mainURL}/api/jurusan/untuk-input-option`;

        this.doAjax(url, function (response) {
            let data;
            for (let i = 0; i < response.data.length; i++) {
                data = response.data[i];
                self.inputIdJurusan.append(
                    new Option(data.nama_jurusan, data.id_jurusan)
                );
            }
        });
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-kelas").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/kelas`;
            let method = "put";
            let dataBody = {
                id_kelas: self.paramIdKelas,
                nama_kelas: self.inputNamaKelas.val(),
                id_jurusan: self.inputIdJurusan.val(),
                status_data: self.inputStatusData.val(),
            };

            // Jalankan api untuk create data saat submit
            self.doAjax(
                url,
                function (response) {
                    Swal.fire({
                        toast: true,
                        position: "top-right",
                        iconColor: "white",
                        color: "white",
                        background: "var(--success)",
                        showConfirmButton: false,
                        timer: 10000,
                        timerProgressBar: true,
                        icon: "success",
                        title: `Kelas ${response.data.nama_kelas} berhasil diubah`,
                    });
                },
                dataBody,
                method
            );
        });
    }

    getIdKelas() {
        // Ambil url keseluruhan
        let id_kelas = this.objectURL.href.replace(
            `${this.mainURL}/admin/data-kelas-update/`,
            ""
        );
        id_kelas = atob(id_kelas);
        return id_kelas;
    }
}

$(function () {
    new Main();
});
