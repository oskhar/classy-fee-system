// JavaScript (ES6+)

class Main {
    constructor() {
        this.dataTableElement = $("#example1");
        this.dataTable = this.initializeDataTable(this.dataTableElement);

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
                const id = button.data("id");
                self.performSoftDelete(id); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari kelas Main
            }
        );
    }

    initializeDataTable(tableElement) {
        return tableElement.DataTable({
            ajax: {
                url: `${mainURL}/api/kelas/untuk-tabel`,
            },
            columns: [
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
                    render: (data) => `
                        <a class="btn btn-outline-primary btn-action btn-sm view" data-id="${data}" data-action="view">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-outline-warning btn-action btn-sm edit" data-id="${data}" data-action="edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-outline-danger btn-action btn-sm delete" data-id="${data}" data-action="delete">
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
            paging: true, // Mengaktifkan paginasi
            pageLength: 10, // Menentukan jumlah data per halaman
        });
    }

    performSoftDelete(id_kelas) {
        this.showWarningMessage("Hapus kelas ?", "Hapus").then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isDenied) {
                $.ajax({
                    url: `${mainURL}/api/kelas`,
                    type: "delete",
                    data: { id_kelas },
                    dataType: "json",
                    success: (response) => {
                        this.refreshDataTable();
                        this.showSuccessMessage(
                            `Kelas ${response.data.nama_kelas} berhasil dihapus`
                        );
                    },
                    error: (xhr) => {
                        const errors = Object.keys(xhr.responseJSON)
                            .map((key) => xhr.responseJSON[key])
                            .join("<br>");
                        this.showErrorMessage(errors);
                    },
                });
            }
        });
    }

    refreshDataTable() {
        this.dataTable.ajax.reload();
    }

    showSuccessMessage(message) {
        Swal.fire({
            toast: true,
            position: "top-right",
            iconColor: "white",
            color: "white",
            background: "var(--success)",
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            icon: "success",
            title: message,
        });
    }

    showErrorMessage(message) {
        Swal.fire({
            title: message,
            icon: "error",
            confirmButtonText: "Ok",
        });
    }

    showWarningMessage(message, buttonText) {
        return Swal.fire({
            title: message,
            showConfirmButton: false,
            showDenyButton: true,
            showCancelButton: true,
            denyButtonText: buttonText,
        });
    }
}

$(function () {
    const main = new Main();
});
