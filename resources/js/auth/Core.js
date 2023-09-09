// Kelas utama untuk semua
export class Core {
    constructor() {
        this.objectURL = new URL(window.location.href);
        this.mainURL = this.objectURL.origin;
    }

    doAjax(
        url,
        fungsiSaatSuccess,
        data = {},
        method = "get",
        dataHeader = {},
        hapusJwtTokenJikaError = false
    ) {
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

                /**
                 * Untuk memeriksa apakah jwt token
                 * harus dihapus? jika true maka
                 * jwt token akan dihapus
                 */
                if (hapusJwtTokenJikaError) {
                    localStorage.removeItem("jwtToken");
                }
                this.showErrorMessage(errors);
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
