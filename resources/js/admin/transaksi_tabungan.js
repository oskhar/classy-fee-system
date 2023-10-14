import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.dataTableElement = $("#example1");
        this.kelasDipilih = "";
        this.setDataTableRekening();
        this.setListener();
    }

    setDataTableRekening() {
        /**
         * Merefresh data pada datatable
         * jika data table sudah terisi
         */
        const urlAPI = `${this.mainURL}/api/transaksi-tabungan`;
        if (this.dataTable) {
            this.dataTable.ajax.url(urlAPI).load();
        } else {
            const dataColumns = [
                { data: "hak_akses" },
                { data: "nomor_rekening" },
                { data: "jenis_transaksi" },
                { data: "tanggal_transaksi" },
                {
                    data: "nominal",
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
