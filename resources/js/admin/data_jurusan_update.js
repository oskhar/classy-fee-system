import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.inputNamaJurusan = $("#nama_jurusan");
        this.inputSingkatan = $("#singkatan");
        this.inputStatusData = $("#status_data");
        this.paramIdJurusan = this.getIdJurusan();

        this.setFormData();
        this.setListener();
    }

    setFormData() {
        const self = this; // Simpan referensi this dalam variabel self
        let url = `${self.mainURL}/api/jurusan`;
        let dataBody = { id_jurusan: self.paramIdJurusan };

        this.doAjax(
            url,
            function (response) {
                console.log(response);
                let pilihanStatusData =
                    response.data.status_data == "Aktif" ? 0 : 1;
                self.inputNamaJurusan.val(response.data.nama_jurusan);
                self.inputSingkatan.val(response.data.singkatan);
                self.inputStatusData.val(
                    $("#status_data option").eq(pilihanStatusData).val()
                );
            },
            dataBody
        );
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-jurusan").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/jurusan`;
            let method = "put";
            let dataBody = {
                id_jurusan: self.paramIdJurusan,
                nama_jurusan: self.inputNamaJurusan.val(),
                singkatan: self.inputSingkatan.val(),
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
                        title: `Jurusan ${response.data.nama_jurusan} berhasil diubah`,
                    });
                },
                dataBody,
                method
            );
        });
    }

    getIdJurusan() {
        // Ambil url keseluruhan
        let id_jurusan = this.objectURL.href.replace(
            `${this.mainURL}/admin/data-jurusan-update/`,
            ""
        );
        id_jurusan = atob(id_jurusan);
        return id_jurusan;
    }
}

$(function () {
    new Main();
});
