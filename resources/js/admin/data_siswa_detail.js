import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.doAjax(
            `${this.mainURL}/api/siswa`,
            function (response) {
                console.log(response.data.nama_ibu ?? "kosong");
                $("#nama_siswa #isi").text(response.data.nama_siswa ?? "-");
                $("#nis #isi").text(response.data.nis ?? "-");
                $("#nisn #isi").text(response.data.nisn ?? "-");
                $("#agama #isi").text(response.data.agama ?? "-");
                $("#tempat_lahir #isi").text(response.data.tempat_lahir ?? "-");
                $("#tanggal_lahir #isi").text(
                    response.data.tanggal_lahir ?? "-"
                );
                $("#jenis_kelamin #isi").text(
                    response.data.jenis_kelamin ?? "-"
                );
                $("#alamat #isi").text(response.data.alamat ?? "-");
                $("#nama_ayah #isi").text(response.data.nama_ayah ?? "-");
                $("#pekerjaan_ayah #isi").text(
                    response.data.pekerjaan_ayah ?? "-"
                );
                $("#penghasilan_ayah #isi").text(
                    response.data.penghasilan_ayah ?? "-"
                );
                $("#nama_ibu #isi").text(response.data.nama_ibu ?? "-");
                $("#pekerjaan_ibu #isi").text(
                    response.data.pekerjaan_ibu ?? "-"
                );
                $("#penghasilan_ibu #isi").text(
                    response.data.penghasilan_ibu ?? "-"
                );
                $("#telp_rumah #isi").text(response.data.telp_rumah ?? "-");
                $("#status_data #isi").text(response.data.status_data ?? "-");
            },
            { nis: this.getIdSiswa() }
        );
    }

    getIdSiswa() {
        // Ambil url keseluruhan
        let nis = this.objectURL.href.replace(
            `${this.mainURL}/admin/data-siswa-detail/`,
            ""
        );
        nis = atob(nis);
        return nis;
    }
}

$(function () {
    new Main();
});
