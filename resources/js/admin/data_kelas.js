import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.setDataTableKelas();
        this.setListener();
    }

    setDataTableKelas() {
        // Data yang dibutuhkan tabel
        this.dataTableElement = $("#example1");
        const urlAPI = `${this.mainURL}/api/kelas`;
        const dataColumns = [
            { data: "nama_kelas" },
            { data: "nama_jurusan" },
            {
                data: "status_data",
                render: (data) => {
                    const className =
                        data === "Aktif" ? "text-success" : "text-danger";
                    return `<strong class='${className} px-3'>${data}</strong>`;
                },
            },
            {
                data: "id_kelas",
                render: (data, type, row) => `
                    <a class="btn btn-outline-primary btn-sm" href="${
                        this.mainURL
                    }/admin/data-kelas-detail/${data}" data-toggle="tooltip" data-bs-placement="top" title="lihat detai data">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-outline-warning btn-sm" href="${
                        this.mainURL
                    }/admin/data-kelas-update/${btoa(
                    data
                )}" data-toggle="tooltip" data-bs-placement="top" title="ubah data">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-outline-danger btn-action btn-sm delete" data-id="${data}" data-nama="${
                    row.nama_kelas
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

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self

        // Event listener untuk tombol delete
        this.dataTableElement.on(
            "click",
            ".btn-action.delete",
            function (event) {
                const button = $(this);
                const id_kelas = button.data("id");
                const nama_kelas = button.data("nama");
                self.performSoftDelete(id_kelas, nama_kelas); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari kelas Main
            }
        );
    }

    performSoftDelete(id_kelas, nama_kelas) {
        this.showWarningMessage(`Hapus kelas ${nama_kelas} ?`, "Hapus").then(
            (result) => {
                // Assigmen data yang dibutuhkan untuk mengakses API
                let urlAPI = `${this.mainURL}/api/kelas`;
                let method = "delete";
                let dataBody = { id_kelas: id_kelas };

                // Jalankan api untuk delete data jika tombol hapus diclick
                if (result.isDenied) {
                    this.doAjax(
                        urlAPI,
                        (response) => {
                            this.refreshDataTable();
                            this.showSuccessMessage(
                                `Kelas ${response.data.nama_kelas} berhasil dihapus`
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
