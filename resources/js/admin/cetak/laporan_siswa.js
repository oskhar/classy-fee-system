import { customAlphabet } from "nanoid";
import { Core } from "../Core.js";

class Main extends Core {
    constructor() {
        super();

        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");
        this.idSiswa = $("#idSiswa");
        this.doAjax(
            `${this.mainURL}/api/kelas/dari-tahun-ajar`,
            function (response) {
                console.log(response);
            },
            {
                id_tahun_ajar: "TA-001",
            }
        );
        this.fetchTahunAjar();
        this.tahunAjarSelected = false;
        this.idKelasSelected = false;

        this.setListeners();
    }

    setListeners() {
        const self = this;

        self.idTahunAjar.on("change", function () {
            self.tahunAjarSelected = $(this).val();

            if (self.tahunAjarSelected) {
                self.fetchNamaKelas(self.tahunAjarSelected);
            }
        });

        self.idKelas.on("change", function () {
            self.idKelasSelected = $(this).val();

            if (self.tahunAjarSelected && self.idKelasSelected) {
                self.fetchNamaSiswa(
                    self.tahunAjarSelected,
                    self.idKelasSelected
                );
            }
        });
    }

    fetchTahunAjar() {
        const self = this;
        const url = `${self.mainURL}/api/tahun-ajar`;

        self.doAjax(url, function (response) {
            self.optionsList("tahun ajar", self.idTahunAjar, response.data);
        });
    }

    fetchNamaKelas(requestIdTahunAjar) {
        const self = this;
        const url = `${self.mainURL}/api/kelas/dari-tahun-ajar`;

        self.doAjax(
            url,
            function (response) {
                self.optionsList("nama kelas", self.idKelas, response.data);
            },
            {
                id_tahun_ajar: requestIdTahunAjar,
            }
        );
    }

    fetchNamaSiswa(requestIdTahunAjar, requestIdKelas) {
        const self = this;
        const url = `${self.mainURL}/api/siswa/perkelas`;

        self.doAjax(
            url,
            function (response) {
                self.optionsList("nama kelas", self.idSiswa, response.data);
            },
            {
                id_tahun_ajar: requestIdTahunAjar,
                id_kelas: requestIdKelas,
            }
        );
    }

    optionsList(namaData, selectElement, data) {
        selectElement.html(
            `<option value="" selected disabled>Pilih ${namaData}</option>`
        );
        $.each(data, function (index, item) {
            if (item.nis) {
                selectElement.append(
                    $("<option>", {
                        value: item.nis,
                        text: `${item.nama_kelas} (${item.nis}) ${item.nama_siswa}`,
                    })
                );
            } else if (item.id_kelas) {
                selectElement.append(
                    $("<option>", {
                        value: item.id_kelas,
                        text: `(${item.nama_tahun_ajar}) ${item.nama_kelas}`,
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
}

$(function () {
    new Main();
});
