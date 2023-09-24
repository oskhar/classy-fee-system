import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");
        this.dataTableElement = $("#example1");
        this.tombolExport = $("#exportSiswaPerkelas");
        this.kelasDipilih = "";
        this.setListener();
        this.fetchTahunAjar();
    }

    setDataTableRekening(requestIdTahunAjar, requestIdKelas) {
        /**
         * Merefresh data pada datatable
         * jika data table sudah terisi
         */
        const urlAPI = `${this.mainURL}/api/rekening?id_tahun_ajar=${requestIdTahunAjar}&id_kelas=${requestIdKelas}`;
        if (this.dataTable) {
            this.dataTable.ajax.url(urlAPI).load();
        } else {
            const dataColumns = [
                { data: "nomor_rekening" },
                { data: "nis" },
                { data: "nama_siswa" },
                {
                    data: "saldo",
                    render: (data) => {
                        const uang = data
                            .toString()
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        return `Rp ${uang}.-`;
                    },
                },
                {
                    data: "status_data",
                    render: (data) => {
                        const className =
                            data === "Aktif" ? "text-success" : "text-danger";
                        return `<strong class='${className} px-3'>${data}</strong>`;
                    },
                },
                {
                    data: "nis",
                    render: (data, type, row) => `
                        <a class="btn btn-outline-primary btn-sm" href="${
                            this.mainURL
                        }/admin/data-siswa-detail/${btoa(
                        data
                    )}" data-toggle="tooltip" data-bs-placement="top" title="Cetak buku tabungan">
                            <i class="fas fa-print"></i>
                        </a>
                    `,
                },
            ];

            // Membuat tabel
            this.dataTable = this.setDataTable(
                this.dataTableElement,
                urlAPI,
                dataColumns,
                20
            );
        }
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self

        self.idTahunAjar.on("change", function () {
            self.tahunAjarSelected = $(this).val();

            if (self.tahunAjarSelected) {
                self.fetchNamaKelas(self.tahunAjarSelected);
                if (self.dataTable) {
                    $("#example1 tbody").html("");
                }
            }
        });

        self.idKelas.on("change", function () {
            self.idKelasSelected = $(this).val();
            self.kelasDipilih = $(this).find(":selected").text();

            if (self.tahunAjarSelected && self.idKelasSelected) {
                self.setDataTableRekening(
                    self.tahunAjarSelected,
                    self.idKelasSelected
                );
            }
        });

        self.tombolExport.on("click", function () {
            self.exportSiswaPerkelasExcel();
        });

        // Event listener untuk tombol delete
        self.dataTableElement.on(
            "click",
            ".btn-action.print",
            function (event) {
                const button = $(this);
                const nomor_rekening = button.data("nomor_rekening");
                self.previewBukuRekening(nomor_rekening); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari Siswa Main
            }
        );
    }

    previewBukuRekening(nomor_rekening) {
        const urlAPI = `${this.mainURL}`;
        this.doAjax();
    }

    performSoftDelete(nis, nama_siswa) {
        this.showWarningMessage(`Hapus Siswa ${nama_siswa} ?`, "Hapus").then(
            (result) => {
                // Assigmen data yang dibutuhkan untuk mengakses API
                let urlAPI = `${this.mainURL}/api/rekening`;
                let method = "delete";
                let dataBody = { nis: nis };

                // Jalankan api untuk delete data jika tombol hapus diclick
                if (result.isDenied) {
                    this.doAjax(
                        urlAPI,
                        (response) => {
                            this.refreshDataTable();
                            this.showSuccessMessage(
                                response.data.success.message
                            );
                        },
                        dataBody,
                        method
                    );
                }
            }
        );
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
        self.tombolExport.show();

        self.doAjax(
            url,
            function (response) {
                let data = response.data;
                self.optionsList("nama kelas", self.idKelas, data);
            },
            {
                id_tahun_ajar: requestIdTahunAjar,
            }
        );
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

    refreshDataTable() {
        this.dataTable.ajax.reload();
    }

    exportSiswaPerkelasExcel() {
        window.location.href = `${this.mainURL}/export/siswa-perkelas?nama_kelas=${this.kelasDipilih}&id_kelas=${this.idKelasSelected}&id_tahun_ajar=${this.tahunAjarSelected}`;
    }
}

$(function () {
    new Main();
});
