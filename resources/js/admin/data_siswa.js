import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.setDataTableSiswa();
        this.setListener();
        this.doAjax(`${this.mainURL}/api/siswa`, function (response) {
            console.log(response);
        });
    }

    setDataTableSiswa() {
        // Data yang dibutuhkan tabel
        this.dataTableElement = $("#example1");
        const urlAPI = `${this.mainURL}/api/siswa`;
        const dataColumns = [
            { data: "nis" },
            { data: "nisn" },
            { data: "nama_siswa" },
            { data: "jenis_kelamin" },
            { data: "tempat_lahir" },
            {
                data: "tanggal_lahir",
                render: (data) => {
                    return this.convertTanggal(data);
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
            40
        );
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self

        // Event listener untuk tombol delete
        this.dataTableElement.on(
            "click",
            ".btn-action.delete",
            function (event) {
                const button = $(this);
                const nis = button.data("nis");
                const nama_siswa = button.data("nama");
                self.performSoftDelete(nis, nama_siswa); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari Siswa Main
            }
        );
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

    refreshDataTable() {
        this.dataTable.ajax.reload();
    }
}

$(function () {
    new Main();
});
