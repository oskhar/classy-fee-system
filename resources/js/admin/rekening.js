import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.idTahunAjar = $("#idTahunAjar");
        this.idKelas = $("#idKelas");
        this.tahunAjarSelected = false;
        this.dataTableElement = $("#example1");
        this.tombolExport = $("#exportSiswaPerkelas");
        this.kelasDipilih = "";
        this.fetchTahunAjar();
        this.setListener();
    }

    setDataTableRekening(requestIdTahunAjar, requestIdKelas = "") {
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
                        const uang = this.numberToMoney(data);
                        return uang;
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
                    data: "nomor_rekening",
                    render: (data, type, row) => `
                        <a class="btn btn-outline-primary btn-action btn-sm print" data-nomor-rekening="${data}" data-toggle="tooltip" data-bs-placement="top" title="Cetak buku tabungan">
                            <i class="fas fa-print"></i>
                        </a>
                        <a class="btn btn-outline-danger btn-action btn-sm delete" data-nis="${data}" data-nama="${row.nama_siswa}" data-toggle="tooltip" data-bs-placement="top" title="hapus data">
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
                self.setDataTableRekening(self.tahunAjarSelected);
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
                const nomor_rekening = button.data("nomor-rekening");
                self.previewBukuRekening(nomor_rekening); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari Siswa Main
            }
        );
    }

    async previewBukuRekening(nomor_rekening) {
        /**
         * Menginisialisasi this milik main class
         * ke dalam bentuk lain agar tidak
         * bentrok dengan class tambahan
         */
        const self = this;

        /**
         * Melakukan assigment pada variable
         * urlAPI untuk melakukan request
         */
        const urlAPI = `${self.mainURL}/api/buku-tabungan?nomor_rekening=${nomor_rekening}`;

        /**
         * Melakukan request menggunakan jquery
         * ajax dengan gateway yang ditentukan
         */
        await self.doAjax(urlAPI, function (response) {
            /**
             * Menampilkan pop up data table
             */
            self.showInfoMessage(
                "",
                "<i class='fas fa-print'></i> Cetak data",
                "90%",
                `<div class="card card-success mt-4">
                <div class="card-header">
                    <h3 class="card-title">Preview data rekening</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>nomor rekening</th>
                                <th>debit</th>
                                <th>kredit</th>
                                <th>saldo</th>
                                <th>tanggal</th>
                            </tr>
                        </thead>
                        <tbody>${self.arrayBukuRekeningToTable(
                            response.data
                        )}</tbody>
                    </table>
                </div>
                </div>`,
                "var(--danger)",
                "<i class='fas fa-times'></i> Cancel"
            ).then((result) => {
                /**
                 * Mencetak data buku tabungan
                 * siswa sesuai permintaan
                 */
                if (result.isConfirmed) {
                    window.location.href = `${self.mainURL}/export/buku-tabungan?nomor_rekening=${nomor_rekening}`;
                }
            });
        });
        // Data yang dibutuhkan tabel
        const dataTablePreview = $("#example2");
        const dataColumnsPreview = [
            { data: "nomor_rekening" },
            { data: "debit" },
            { data: "kredit" },
            { data: "saldo" },
            {
                data: "tanggal",
                render: (data) => {
                    return self.convertTanggal(data);
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
        ];

        // Membuat tabel
        self.setDataTable(dataTablePreview, urlAPI, dataColumnsPreview, 10);
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
            await self.setDataTableRekening(self.tahunAjarSelected);
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
        window.location.href = `${this.mainURL}/export/siswa-perkelas?nama_kelas=${this.kelasDipilih}&id_kelas=${this.idKelasSelected}&id_tahun_ajar=${this.tahunAjarSelected}`;
    }

    arrayBukuRekeningToTable(arrayBukuRekening) {
        let hasil = "";
        for (let i = 0; i < arrayBukuRekening.length; i++) {
            hasil += `
            <tr>
                <td>${arrayBukuRekening[i].nomor_rekening}</td>
                <td>${this.numberToMoney(arrayBukuRekening[i].debit)}</td>
                <td>${this.numberToMoney(arrayBukuRekening[i].kredit)}</td>
                <td>${this.numberToMoney(arrayBukuRekening[i].saldo)}</td>
                <td>${arrayBukuRekening[i].tanggal}</td>
            </tr>`;
        }
        return hasil;
    }
}

$(function () {
    new Main();
});
