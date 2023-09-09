// Kelas utama untuk semua
export class Core {
    constructor() {}

    doAjax(url, fungsiSaatSuccess, data = {}, method = "get", dataHeader = {}) {
        $.ajax({
            url: url,
            type: method,
            data: data,
            headers: dataHeader,
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
                this.showErrorMessage(errors).then(() => {
                    if (xhr.status == 401) {
                        window.location.href = "/";
                    }
                });
            },
        });
    }

    showSuccessMessage(message, timer = 2000) {
        Swal.fire({
            toast: true,
            position: "top",
            iconColor: "white",
            color: "white",
            background: "var(--success)",
            showConfirmButton: false,
            timer: timer,
            timerProgressBar: true,
            icon: "success",
            title: message,
        });
    }

    showErrorMessage(message) {
        return Swal.fire({
            title: message,
            icon: "error",
            allowOutsideClick: false,
            confirmButtonText: "Ok",
        });
    }

    objectToString(object) {
        return Object.values(object).join("<br>");
    }
}
