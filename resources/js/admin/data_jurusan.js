import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.setDataTableJurusan();
        this.setListener();
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self

        // Event listener untuk tombol delete
        this.dataTableElement.on(
            "click",
            ".btn-action.delete",
            function (event) {
                const button = $(this);
                const id_jurusan = button.data("id");
                const nama_jurusan = button.data("nama");
                self.performSoftDelete(id_jurusan, nama_jurusan); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari jurusan Main
            }
        );
    }

    setDataTableJurusan() {
        // Data yang dibutuhkan tabel
        this.dataTableElement = $("#example1");
        const urlAPI = `${this.mainURL}/api/jurusan`;
        const dataColumns = [
            { data: "nama_jurusan" },
            { data: "singkatan" },
            {
                data: "status_data",
                render: (data) => {
                    const className =
                        data === "Aktif" ? "text-success" : "text-danger";
                    return `<strong class='${className} px-3'>${data}</strong>`;
                },
            },
            {
                data: "id_jurusan",
                render: (data, type, row) => `
                        <a class="btn btn-outline-primary btn-sm" href="${
                            this.mainURL
                        }/admin/data-jurusan-detail/${data}" data-toggle="tooltip" data-bs-placement="top" title="lihat detai data">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-outline-warning btn-sm" href="${
                            this.mainURL
                        }/admin/data-jurusan-update/${btoa(
                    data
                )}" data-toggle="tooltip" data-bs-placement="top" title="ubah data">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-outline-danger btn-action btn-sm delete" data-id="${data}" data-nama="${
                    row.nama_jurusan
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
            dataColumns
        );
    }

    performSoftDelete(id_jurusan, nama_jurusan) {
        this.showWarningMessage(
            `Hapus jurusan ${nama_jurusan} ?`,
            "Hapus"
        ).then((result) => {
            // Assigmen data yang dibutuhkan untuk mengakses API
            let urlAPI = `${this.mainURL}/api/jurusan`;
            let method = "delete";
            let dataBody = { id_jurusan: id_jurusan };

            // Jalankan api untuk delete data jika tombol hapus diclick
            if (result.isDenied) {
                this.doAjax(
                    urlAPI,
                    (response) => {
                        this.refreshDataTable();
                        this.showSuccessMessage(response.data.success.message);
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
