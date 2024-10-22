import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");

        this.setListeners();
        this.fetchTahunAjar();
        this.fetchNamaKelas();
    }

    setListeners() {
        const self = this;

        $("#form-tambah-siswa").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/siswa`;
            let method = "post";
            let dataBody = {
                nama_siswa: $("#nama").val(), // Ubah sesuai dengan ID input yang sesuai
                nis: $("#nis").val(),
                nisn: $("#nisn").val(),
                agama: $("#agama").val(),
                tempat_lahir: $("#tempat_lahir").val(),
                tanggal_lahir: $("#tanggal_lahir").val(),
                jenis_kelamin: $("#jenis_kelamin").val(),
                alamat: $("#alamat").val(), // Gunakan metode yang sudah Anda definisikan untuk mendapatkan alamat
                nama_ayah: $("#nama_ayah").val(),
                pekerjaan_ayah: $("#pekerjaan_ayah").val(),
                penghasilan_ayah: $("#penghasilan_ayah").val(),
                nama_ibu: $("#nama_ibu").val(),
                pekerjaan_ibu: $("#pekerjaan_ibu").val(),
                penghasilan_ibu: $("#penghasilan_ibu").val(),
                telp_rumah: $("#telp_rumah").val(), // Ubah sesuai dengan ID input yang sesuai
                id_tahun_ajar: $("#idTahunAjar").val(),
                id_kelas: $("#idKelas").val(),
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
                                let url = `${self.mainURL}/api/siswa/pulihkan`;
                                let method = "put";
                                let dataBody = {
                                    id_siswa: response.data.id_siswa,
                                };
                                self.doAjax(
                                    url,
                                    function (response) {
                                        self.showSuccessAndRedirect(
                                            response.data.success.message,
                                            `${self.mainURL}/admin/data-siswa`
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

    populateSelect(selectElement, data) {
        selectElement.html('<option value="" selected disabled>Pilih</option>');
        $.each(data, function (index, item) {
            selectElement.append(
                $("<option>", {
                    value: item.id,
                    text: item.name,
                })
            );
        });
        selectElement.show();
    }
}

$(function () {
    // Inisialisasi masker inputmask
    $("[data-inputmask]").inputmask();

    new Main();
});
