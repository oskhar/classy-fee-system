import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.inputNamaTahunAjar = $("#nama_tahun_ajar");
        this.inputSemester = $("#semester");
        this.inputStatusData = $("#status_data");
        this.paramIdTahunAjar = this.getIdTahunAjar();

        this.setFormData();
        this.setListener();
    }

    setFormData() {
        const self = this;
        let url = `${self.mainURL}/api/tahun-ajar`;
        let dataBody = { id_tahun_ajar: self.paramIdTahunAjar };

        this.doAjax(
            url,
            function (response) {
                console.log(response);

                self.inputNamaTahunAjar.val(response.data.nama_tahun_ajar);

                // Pilih opsi yang memiliki teks yang sesuai dengan semester
                self.inputSemester
                    .find('option:contains("' + response.data.semester + '")')
                    .prop("selected", true);

                // Pilih opsi yang memiliki teks yang sesuai dengan status_data
                self.inputStatusData
                    .find(
                        'option:contains("' + response.data.status_data + '")'
                    )
                    .prop("selected", true);
            },
            dataBody
        );
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-tahun-ajar").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/tahun-ajar`;
            let method = "put";
            let dataBody = {
                id_tahun_ajar: self.paramIdTahunAjar,
                nama_tahun_ajar: self.inputNamaTahunAjar.val(),
                semester: self.inputSemester.val(),
                status_data: self.inputStatusData.val(),
            };

            // Jalankan api untuk create data saat submit
            self.doAjax(
                url,
                function (response) {
                    let message = `Tahun ajar ${response.data.nama_tahun_ajar} berhasil diubah`;
                },
                dataBody,
                method
            );
        });
    }

    getIdTahunAjar() {
        // Ambil url keseluruhan
        let id_tahun_ajar = this.objectURL.href.replace(
            `${this.mainURL}/admin/data-tahun-ajar-update/`,
            ""
        );
        id_tahun_ajar = atob(id_tahun_ajar);
        return id_tahun_ajar;
    }
}

$(function () {
    new Main();
});
