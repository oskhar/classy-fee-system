import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");
        this.pilihanNomorRekening = $("#nomor_rekening");
        this.fetchTahunAjar();
        this.setListener();
    }

    setListener() {
        const self = this;

        self.idTahunAjar.on("change", function () {
            self.tahunAjarSelected = $(this).val();

            if (self.tahunAjarSelected) {
                self.fetchNamaKelas(self.tahunAjarSelected);
                if (self.dataTable) {
                    $("#example1 tbody").html("");
                }
                self.setInputNomorRekening(self.tahunAjarSelected);
            }
        });

        self.idKelas.on("change", function () {
            self.idKelasSelected = $(this).val();
            self.kelasDipilih = $(this).find(":selected").text();

            if (self.tahunAjarSelected) {
                self.setInputNomorRekening(
                    self.tahunAjarSelected,
                    self.idKelasSelected
                );
            }
        });

        $("#form-transaksi-tabungan").submit(function (event) {
            // thisMencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/transaksi-tabungan`;
            let method = "post";
            let dataBody = {
                id_administrator: self.mainIdAdministrator,
                nomor_rekening: $("#nomor_rekening").val(),
                jenis_transaksi: $("#jenis_transaksi").val(),
                nominal: $("#nominal").val(),
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
        $(".select2").select2({
            theme: "bootstrap4",
        });
    }

    setInputNomorRekening(idTahunAjar, idKelas = "") {
        const self = this; // Simpan referensi this dalam variabel self

        // Assigmen data yang diperlukan untuk mengakses API
        let url = `${self.mainURL}/api/rekening?id_tahun_ajar=${idTahunAjar}&id_kelas=${idKelas}`;

        self.pilihanNomorRekening.html("");

        this.doAjax(url, function (response) {
            let data;
            for (let i = 0; i < response.data.length; i++) {
                data = response.data[i];
                self.pilihanNomorRekening.append(
                    new Option(data.nomor_rekening, data.nomor_rekening)
                );
            }
        });
    }

    fetchTahunAjar() {
        const self = this;
        const url = `${self.mainURL}/api/tahun-ajar`;

        self.doAjax(url, async function (response) {
            self.optionsList("tahun ajar", self.idTahunAjar, response.data);
            self.tahunAjarSelected = await self.idTahunAjar
                .find(":selected")
                .val();
            await self.setInputNomorRekening(self.tahunAjarSelected);
            self.fetchNamaKelas(self.tahunAjarSelected);
        });
    }

    fetchNamaKelas(requestIdTahunAjar) {
        const self = this;
        const url = `${self.mainURL}/api/kelas/dari-tahun-ajar`;

        self.doAjax(
            url,
            async function (response) {
                let data = response.data;
                await self.idKelas.html(
                    `<option value="" selected>Semua Kelas</option>`
                );
                self.optionsList("nama kelas", self.idKelas, data);
            },
            {
                id_tahun_ajar: requestIdTahunAjar,
            }
        );
    }

    optionsList(namaData, selectElement, data) {
        let firstOpsiTahunAjar = true;
        $.each(data, function (index, item) {
            if (item.id_kelas) {
                selectElement.append(
                    $("<option>", {
                        value: item.id_kelas,
                        text: item.nama_kelas,
                    })
                );
            } else if (item.id_tahun_ajar) {
                if (firstOpsiTahunAjar) {
                    firstOpsiTahunAjar = false;
                    selectElement.append(
                        $("<option>", {
                            value: item.id_tahun_ajar,
                            text: item.nama_tahun_ajar + " " + item.semester,
                            selected: true,
                        })
                    );
                } else {
                    selectElement.append(
                        $("<option>", {
                            value: item.id_tahun_ajar,
                            text: item.nama_tahun_ajar + " " + item.semester,
                        })
                    );
                }
            }
        });
    }
}

$(function () {
    new Main();
});
