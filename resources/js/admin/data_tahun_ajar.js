import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.setDataTableTahunAjar();
        this.setListener();
    }

    setDataTableTahunAjar() {
        // Data yang dibutuhkan tabel
        this.dataTableElement = $("#example1");
        const urlAPI = `${this.mainURL}/api/tahun-ajar/untuk-tabel`;
        const dataColumns = [
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
                data: "id_tahun_ajar",
                render: (data, type, row) => `
                    <a class="btn btn-outline-primary btn-sm" href="${this.mainURL}/admin/data-tahun-ajar-detail/${data}" data-toggle="tooltip" data-bs-placement="top" title="lihat detai data">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-outline-warning btn-sm" href="${this.mainURL}/admin/data-tahun-ajar-update/?id_tahun_ajar=${data}" data-toggle="tooltip" data-bs-placement="top" title="ubah data">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-outline-danger btn-action btn-sm delete" data-id="${data}" data-nama="${row.nama_tahun_ajar}" data-toggle="tooltip" data-bs-placement="top" title="hapus data">
                        <i class="fas fa-trash"></i>
                    </a>
                `,
            },
        ];

        // Membuat tabel
        this.dataTable = this.setDataTable(
            this.dataTableElement,
            urlAPI,
            dataColumns
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
                const id_tahun_ajar = button.data("id");
                const nama_tahun_ajar = button.data("nama");
                self.performSoftDelete(id_tahun_ajar, nama_tahun_ajar); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari kelas Main
            }
        );
    }

    performSoftDelete(id_tahun_ajar, nama_tahun_ajar) {
        this.showWarningMessage(
            `Hapus tahun ajar ${nama_tahun_ajar} ?`,
            "Hapus"
        ).then((result) => {
            // Assigmen data yang dibutuhkan untuk mengakses API
            let urlAPI = `${this.mainURL}/api/tahun-ajar`;
            let method = "delete";
            let dataBody = { id_tahun_ajar: id_tahun_ajar };

            // Jalankan api untuk delete data jika tombol hapus diclick
            if (result.isDenied) {
                this.doAjax(
                    urlAPI,
                    (response) => {
                        this.refreshDataTable();
                        this.showSuccessMessage(
                            `tahun ajar ${response.data.nama_tahun_ajar} berhasil dihapus`
                        );
                    },
                    dataBody,
                    method
                );
            }
        });
    }

    refreshDataTable() {
        this.dataTable.ajax.reload();
    }
}

$(function () {
    new Main();
});
