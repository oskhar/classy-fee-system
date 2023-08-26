// Kelas utama untuk semua
export class Core {
    constructor() {
        this.objectURL = new URL(window.location.href);
        this.mainURL = this.objectURL.origin;
    }

    doAjax (url, fungsiSaatSuccess, data = {}, method = 'get') {
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
                    errors = this.objectToString(
                        xhr.responseJSON.errors
                    );
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

    objectToString(object) {
        return Object.values(object).join("<br>");
    }
}