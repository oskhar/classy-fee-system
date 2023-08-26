import { Core } from "./Core.js";

class Main extends Core{

    constructor() {
        super();
        this.dataTableElement = $("#example1");
        this.dataTable = this.setDataTable(this.dataTableElement);
        this.setListener();
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self

        // Event listener untuk tombol delete
        this.dataTableElement.on("click", ".btn-action.delete", function (event) {
                const button = $(this);
                const id_jurusan = button.data("id");
                const nama_jurusan = button.data("nama");
                self.performSoftDelete(id_jurusan, nama_jurusan); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari jurusan Main
            }
        );
    }

    setDataTable(tableElement) {
        return tableElement.DataTable({
            ajax: {
                url: `${this.mainURL}/api/jurusan/untuk-tabel`,
                type: "GET",
                data: function (data) {
                    // Tambahkan parameter pengurutan
                    if (data.order.length > 0) {
                        data.orderColumn = data.order[0].column; // Indeks kolom yang ingin diurutkan
                        data.orderDir = data.order[0].dir; // Arah pengurutan (asc atau desc)
                    }
                },
            },
            columns: [
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
                        <a class="btn btn-outline-primary btn-sm" href="${this.mainURL}/admin/data-jurusan-detail/${data}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-outline-warning btn-sm" href="${this.mainURL}/admin/data-jurusan-update/?id_jurusan=${data}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-outline-danger btn-action btn-sm delete" data-id="${data}" data-nama="${row.nama_jurusan}">
                            <i class="fas fa-trash"></i>
                        </a>
                    `,
                },
            ],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            language: {
                info: "Last updated data on",
            },
            processing: true,
            searching: true, // Aktifkan fungsi searching
            serverSide: true, // Aktifkan server-side processing
            paging: true, // Mengaktifkan paginasi
            pageLength: 10, // Menentukan jumlah data per halaman
        });
    }

    performSoftDelete(id_jurusan, nama_jurusan) {
        this.showWarningMessage(`Hapus jurusan ${nama_jurusan} ?`, "Hapus").then(
            (result) => {
                
                // Assigmen data yang dibutuhkan untuk mengakses API
                let urlAPI = `${this.mainURL}/api/jurusan`;
                let method = 'delete';
                let dataBody = {id_jurusan: id_jurusan};

                // Jalankan api untuk delete data jika tombol hapus diclick
                if (result.isDenied) {
                    this.doAjax(urlAPI, (response) => {
                        this.refreshDataTable();
                        this.showSuccessMessage(
                            `jurusan ${response.data.nama_jurusan} berhasil dihapus`
                        );
                    }, dataBody, method);
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
