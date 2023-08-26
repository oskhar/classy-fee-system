class Main {
    constructor() {
        this.inputNamaKelas = $("#nama_kelas");
        this.inputIdJurusan = $("#id_jurusan");
        this.inputStatusData = $("#status_data");

        this.setInputJurusan();
        this.setListener();
    }

    setInputJurusan() {
        const self = this; // Simpan referensi this dalam variabel self
        $.ajax({
            url: `${mainURL}/api/jurusan/untuk-input-option`,
            type: "get",
            dataType: "json",
            success: function (response) {
                let data;
                for (let i = 0; i < response.data.length; i++) {
                    data = response.data[i];
                    self.inputIdJurusan.append(
                        new Option(data.nama_jurusan, data.id_jurusan)
                    );
                }
            },
            error: function (xhr, status, error) {
                alert(
                    "Data gagal ditambahkan: " +
                        xhr.status +
                        "\n" +
                        xhr.responseText +
                        "\n" +
                        error
                );
            },
        });
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-kelas").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Mendapatkan nilai input dari form
            let nama_kelas = self.inputNamaKelas.val();
            let id_jurusan = self.inputIdJurusan.val();
            let status_data = self.inputStatusData.val();

            // Membuat objek data yang akan dikirimkan melalui AJAX
            let data = {
                nama_kelas: nama_kelas,
                id_jurusan: id_jurusan,
                status_data: status_data,
            };

            // Kirim data ke controller menggunakan AJAX
            $.ajax({
                url: `${mainURL}/api/kelas`,
                type: "post",
                data: data,
                dataType: "json",
                success: function (response) {
                    // Respon berhasil dikirim ke user
                    console.log(response);
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
                        title: "Kelas berhasil ditambahkan",
                    });
                },
                error: function (xhr, status, error) {
                    // Menampilkan pesan error AJAX
                    let errors;
                    if (xhr.responseJSON.errors) {
                        errors = self.objectToString(xhr.responseJSON.errors);
                    } else {
                        errors = self.objectToString(xhr.responseJSON);
                    }
                    Swal.fire({
                        title: errors,
                        icon: "error",
                        confirmButtonText: "Ok",
                    });
                },
            });
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

    objectToString(object) {
        return Object.values(object).join("<br>");
    }
}

$(function () {
    const main = new Main();
});
