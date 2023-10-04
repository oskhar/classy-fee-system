import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.pilihanSiswa = $("#nis");
        this.setInputSiswa();
        this.setListener();
    }

    setListener() {
        const self = this;
        $("#form-tambah-rekening").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/rekening`;
            let method = "post";
            let dataBody = {
                nis: $("#nis").val(),
                setoran_awal: $("#setoran_awal").val(),
                status_data: $("#status_data").val(),
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
                                let url = `${self.mainURL}/api/rekening/pulihkan`;
                                let method = "put";
                                let dataBody = {
                                    nomor_rekening:
                                        response.data.nomor_rekening,
                                };
                                self.doAjax(
                                    url,
                                    function (response) {
                                        self.showSuccessAndRedirect(
                                            response.data.success.message,
                                            `${self.mainURL}/admin/data-rekening`
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

    setInputSiswa() {
        const self = this; // Simpan referensi this dalam variabel self

        // Assigmen data yang diperlukan untuk mengakses API
        let url = `${self.mainURL}/api/rekening/siswa-belum-terdaftar`;

        self.pilihanSiswa.html("");

        this.doAjax(url, function (response) {
            let data;
            for (let i = 0; i < response.data.length; i++) {
                data = response.data[i];
                self.pilihanSiswa.append(
                    new Option(`(${data.nis}) ${data.nama_siswa}`, data.nis)
                );
            }
        });
    }
}

$(function () {
    new Main();
});
