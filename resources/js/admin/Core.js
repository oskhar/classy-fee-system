// Kelas utama untuk semua
export class Core {
    constructor() {
        this.setAjaxHeader();
        this.objectURL = new URL(window.location.href);
        this.mainURL = this.objectURL.origin;
        this.token = localStorage.getItem("jwtToken");
        this.namaBulan = {
            1: "Januari",
            2: "Februari",
            3: "Maret",
            4: "April",
            5: "Mei",
            6: "Juni",
            7: "Juli",
            8: "Agustus",
            9: "September",
            10: "Oktober",
            11: "November",
            12: "Desember",
        };
    }

    setAjaxHeader() {
        const self = this;
        $.ajaxSetup({
            beforeSend: function (request) {
                // Send Authentication header with each request
                request.setRequestHeader(
                    "Authorization",
                    "Bearer " + self.token
                );
            },
        });
    }

    toTitleCase(str) {
        return str.toLowerCase().replace(/^(.)|\s+(.)/g, function ($1) {
            return $1.toUpperCase();
        });
    }

    convertTanggal(tanggal) {
        // Memecah tanggal menjadi tahun, bulan, dan hari
        let tanggalArray = tanggal.split("-");
        let tahun = tanggalArray[0];
        let bulan = tanggalArray[1];
        let hari = tanggalArray[2];

        // Mengonversi bulan menjadi kata
        let bulanKata = this.namaBulan[parseInt(bulan)];

        // Hasil akhir
        return hari + " " + bulanKata + " " + tahun;
    }

    doAjax(url, fungsiSaatSuccess, data = {}, method = "get", dataHeader = {}) {
        $.ajax({
            url: url,
            type: method,
            data: Object.assign(data, { jenis_login: "admin" }),
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
                        localStorage.removeItem("jwtToken");
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

    showSuccessAndRedirect(message, url, timer = 1200) {
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
        }).then(() => {
            window.location.href = url;
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

    setDataTable(tableElement, urlAPI, dataColumns, limit = 5) {
        const self = this;
        return tableElement.DataTable({
            ajax: {
                url: urlAPI,
                type: "GET",
                data: function (data) {
                    // Tambahkan parameter pengurutan
                    if (data.order.length > 0) {
                        data.orderColumn = data.order[0].column; // Indeks kolom yang ingin diurutkan
                        data.orderDir = data.order[0].dir; // Arah pengurutan (asc atau desc)
                        data.jenis_login = "admin";
                    }
                },
                error: function (xhr) {
                    // Handle kesalahan yang terjadi saat pengambilan data
                    let errors;
                    if (xhr.responseJSON.errors) {
                        errors = self.objectToString(xhr.responseJSON.errors);
                    } else {
                        errors = self.objectToString(xhr.responseJSON);
                    }
                    self.showErrorMessage(errors).then(() => {
                        if (xhr.status == 401) {
                            localStorage.removeItem("jwtToken");
                            window.location.href = "/";
                        }
                    });
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
            pageLength: limit, // Menentukan jumlah data per halaman
            drawCallback: function () {
                $('[data-toggle="tooltip"]').tooltip();
            },
        });
    }
}
