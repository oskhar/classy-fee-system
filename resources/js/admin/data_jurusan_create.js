import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.inputNamaJurusan = $("#nama_jurusan");
        this.inputSingkatan = $("#singkatan");
        this.inputStatusData = $("#status_data");

        this.setListener();
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-jurusan").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/jurusan`;
            let method = "post";
            let dataBody = {
                nama_jurusan: self.inputNamaJurusan.val(),
                singkatan: self.inputSingkatan.val(),
                status_data: self.inputStatusData.val(),
            };

            // Jalankan api untuk create data saat submit
            self.doAjax(
                url,
                function (response) {
                    if (response.data.errors) {
                        self.showInfoMessage(
                            self.objectToString(response.data.errors),
                            "pulihkan"
                        ).then((result) => {
                            if (result.isConfirmed) {
                                let url = `${self.mainURL}/api/jurusan/pulihkan`;
                                let method = "put";
                                let dataBody = {
                                    id_jurusan: response.data.id_jurusan,
                                };
                                self.doAjax(
                                    url,
                                    function (response) {
                                        self.showSuccessMessage(
                                            `Data ${response.data.nama_jurusan} berhasil dipulihkan`
                                        );
                                    },
                                    dataBody,
                                    method
                                );
                            }
                        });
                    } else {
                        self.showSuccessMessage(
                            `Data ${response.data.nama_jurusan} berhasil ditambahkan`
                        );
                    }
                },
                dataBody,
                method
            );
        });
    }
}

$(function () {
    new Main();
});
