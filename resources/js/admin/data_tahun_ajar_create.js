import { message } from "laravel-mix/src/Log.js";
import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.inputTahunAjar = $("#nama_tahun_ajar");
        this.inputSemester = $("#semester");
        this.inputStatusData = $("#status_data");

        this.setListener();
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-tahun-ajar").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();
            self.showInfoMessage(
                `Submit data ${self.inputTahunAjar.val()} ?`,
                "submit"
            ).then((result) => {
                if (result.isConfirmed) {
                    // Assigmen data yang diperlukan untuk mengakses API
                    let url = `${self.mainURL}/api/tahun-ajar`;
                    let method = "post";
                    let dataBody = {
                        nama_tahun_ajar: self.inputTahunAjar.val(),
                        semester: self.inputSemester.val(),
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
                                        let url = `${self.mainURL}/api/tahun-ajar/pulihkan`;
                                        let method = "put";
                                        let dataBody = {
                                            id_tahun_ajar:
                                                response.data.id_tahun_ajar,
                                        };
                                        self.doAjax(
                                            url,
                                            function (response) {
                                                self.showSuccessAndRedirect(
                                                    response.data.success
                                                        .message,
                                                    `${self.mainURL}/admin/data-tahun-ajar`
                                                );
                                            },
                                            dataBody,
                                            method
                                        );
                                    }
                                });
                            } else {
                                self.showSuccessMessage(
                                    response.data.success.message
                                );
                            }
                        },
                        dataBody,
                        method
                    );
                }
            });
        });
    }
}

$(function () {
    new Main();
});
