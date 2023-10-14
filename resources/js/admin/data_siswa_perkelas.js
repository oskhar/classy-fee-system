import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");
        this.dataTableElement = $("#example1");
        this.tombolExport = $("#exportSiswaPerkelas");
        this.kelasDipilih = "";
        this.fetchTahunAjar();
        this.setListener();
    }

    setDataTableSiswa(requestIdTahunAjar, requestIdKelas = "") {
        /**
         * Merefresh data pada datatable
         * jika data table sudah terisi
         */
        const urlAPI = `${this.mainURL}/api/siswa/perkelas?id_tahun_ajar=${requestIdTahunAjar}&id_kelas=${requestIdKelas}`;
        if (this.dataTable) {
            this.dataTable.ajax.url(urlAPI).load();
        } else {
            const dataColumns = [
                { data: "nis" },
                { data: "nisn" },
                { data: "nama_siswa" },
                { data: "nama_kelas" },
                { data: "nama_tahun_ajar" },
                { data: "semester" },
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
                    )}" data-toggle="tooltip" data-bs-placement="top" title="lihat detai data">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-outline-warning btn-sm" href="${
                            this.mainURL
                        }/admin/data-siswa-update/${btoa(
                        data
                    )}" data-toggle="tooltip" data-bs-placement="top" title="ubah data">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-outline-danger btn-action btn-sm delete" data-nis="${data}" data-nama="${
                        row.nama_siswa
                    }" data-toggle="tooltip" data-bs-placement="top" title="hapus data">
                            <i class="fas fa-trash"></i>
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

        self.idTahunAjar.on("change", async function () {
            self.tahunAjarSelected = $(this).val();

            if (self.tahunAjarSelected) {
                self.fetchNamaKelas(self.tahunAjarSelected);
                if (self.dataTable) {
                    $("#example1 tbody").html("");
                }
                self.setDataTableSiswa(self.tahunAjarSelected);
            }
        });

        self.idKelas.on("change", function () {
            self.idKelasSelected = $(this).val();
            self.kelasDipilih = $(this).find(":selected").text();

            if (self.tahunAjarSelected && self.idKelasSelected) {
                self.setDataTableSiswa(
                    self.tahunAjarSelected,
                    self.idKelasSelected
                );
            }
        });

        self.tombolExport.on("click", function () {
            self.exportSiswaPerkelasExcel();
        });
    }

    performSoftDelete(nis, nama_siswa) {
        this.showWarningMessage(`Hapus Siswa ${nama_siswa} ?`, "Hapus").then(
            (result) => {
                // Assigmen data yang dibutuhkan untuk mengakses API
                let urlAPI = `${this.mainURL}/api/siswa`;
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

    async fetchTahunAjar() {
        const self = this;
        const url = `${self.mainURL}/api/tahun-ajar`;

        self.doAjax(url, async function (response) {
            await self.optionsList(
                "tahun ajar",
                self.idTahunAjar,
                response.data
            );
            self.tahunAjarSelected = self.idTahunAjar.find(":selected").val();
            await self.setDataTableSiswa(self.tahunAjarSelected);
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

    refreshDataTable() {
        this.dataTable.ajax.reload();
    }

    exportSiswaPerkelasExcel() {
        /**
         * Menyediakan tempat utama untuk
         * mengumpulkan parameter yang
         * dibutuhkan untuk export
         */
        let paramStack = "";
        let jumlahParam = 0;
        const objectParam = {
            nama_kelas: this.kelasDipilih,
            id_kelas: this.idKelasSelected,
            id_tahun_ajar: this.tahunAjarSelected,
        };

        Object.keys(objectParam).forEach((key) => {
            paramStack +=
                (jumlahParam == 0 ? "?" : "&") + `${key}=${objectParam[key]}`;
            jumlahParam++;
        });

        console.log(paramStack);

        /**
         * Menambahkan parameter jika
         * ditemukan value dari key-nya
         */

        window.location.href =
            `${this.mainURL}/export/siswa-perkelas` + paramStack;
    }
}

$(function () {
    new Main();
});
