import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.inputNamaKelas = $("#nama_kelas");
        this.inputIdJurusan = $("#id_jurusan");
        this.inputStatusData = $("#status_data");

        this.setInputJurusan();
        this.setListener();
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
            let method = "post";
            let dataBody = {
                nama_kelas: self.inputNamaKelas.val(),
                id_jurusan: self.inputIdJurusan.val(),
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
                                let url = `${self.mainURL}/api/kelas/pulihkan`;
                                let method = "put";
                                let dataBody = {
                                    id_kelas: response.data.id_kelas,
                                };
                                self.doAjax(
                                    url,
                                    function (response) {
                                        self.showSuccessAndRedirect(
                                            response.data.success.message,
                                            `${self.mainURL}/admin/data-kelas`
                                        );
                                    },
                                    dataBody,
                                    method
                                );
                            }
                        });
                    } else {
                        self.showSuccessMessage(response.data.success.message);
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
