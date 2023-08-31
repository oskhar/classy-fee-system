// Kelas utama untuk semua
export class Core {
    constructor() {
        this.objectURL = new URL(window.location.href);
        this.mainURL = this.objectURL.origin;
        this.messageLink = this.getMessage();
        if (this.messageLink) {
            this.showSuccessMessage(this.messageLink);
        }
    }

    doAjax(url, fungsiSaatSuccess, data = {}, method = "get") {
        $.ajax({
            url: url,
            type: method,
            data: data,
            dataType: "json",
            success: (response) => {
                fungsiSaatSuccess(response);
            },
            error: (xhr) => {
                // Menampilkan pesan error AJAX
                let errors;
                if (xhr.responseJSON.errors) {
                    errors = this.objectToString(xhr.responseJSON.errors);
                } else {
                    errors = this.objectToString(xhr.responseJSON);
                }
                this.showErrorMessage(errors);
            },
        });
    }

    showSuccessMessage(message) {
        Swal.fire({
            toast: true,
            position: "top-right",
            iconColor: "white",
            color: "white",
            background: "var(--success)",
            showConfirmButton: false,
            timer: 2000,
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

    showInfoMessage(message, buttonText) {
        return Swal.fire({
            title: message,
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonText: buttonText,
        });
    }

    objectToString(object) {
        return Object.values(object).join("<br>");
    }

    setDataTable(tableElement, urlAPI, dataColumns) {
        return tableElement.DataTable({
            ajax: {
                url: urlAPI,
                type: "GET",
                data: function (data) {
                    // Tambahkan parameter pengurutan
                    if (data.order.length > 0) {
                        data.orderColumn = data.order[0].column; // Indeks kolom yang ingin diurutkan
                        data.orderDir = data.order[0].dir; // Arah pengurutan (asc atau desc)
                    }
                },
            },
            columns: dataColumns,
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            language: {
                info: "Last updated data on",
            },
            processing: true, // Mengaktifkan side-server-processing
            searching: true, // Aktifkan fungsi searching
            serverSide: true, // Aktifkan server-side processing
            paging: true, // Mengaktifkan paginasi
            pageLength: 5, // Menentukan jumlah data per halaman
            drawCallback: function () {
                $('[data-toggle="tooltip"]').tooltip();
            },
        });
    }

    getMessage() {
        // Ambil url keseluruhan
        const message = this.objectURL.searchParams.get("message");
        return message;
    }
}
