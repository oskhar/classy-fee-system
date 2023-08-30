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
        const self = this; // Simpan referensi this dalam variabel self
        let url = `${self.mainURL}/api/tahun-ajar`;
        let dataBody = { id_tahun_ajar: self.paramIdTahunAjar };

        this.doAjax(
            url,
            function (response) {
                console.log(response);
                let pilihanSemester =
                    response.data.semester == "Ganjil" ? 0 : 1;
                let pilihanStatusData =
                    response.data.status_data == "Aktif" ? 0 : 1;
                self.inputNamaTahunAjar.val(response.data.nama_tahun_ajar);
                self.inputSemester.val(
                    $("#semester option").eq(pilihanSemester).val()
                );
                self.inputStatusData.val(
                    $("#status_data option").eq(pilihanStatusData).val()
                );
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
                        title: `Tahun ajar ${response.data.nama_tahun_ajar} berhasil diubah`,
                    });
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
