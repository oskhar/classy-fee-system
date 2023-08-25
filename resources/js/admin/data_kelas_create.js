$(function () {
    const inputNamaKelas = $("#nama_kelas");
    const inputIdJurusan = $("#id_jurusan");
    const inputStatusData = $("#status_data");

    $.ajax({
        url: mainURL + "/api/jurusan/untuk-input-option",
        type: "get",
        dataType: "json",
        success: function (response) {
            let data;
            for (let i = 0; i < response.data.length; i++) {
                data = response.data[i];
                inputIdJurusan.append(
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

    $("#form-tambah-kelas").submit(function (event) {
        // Mencegah pengiriman formulir secara default
        event.preventDefault();

        // Mendapatkan nilai input dari form
        let nama_kelas = inputNamaKelas.val();
        let id_jurusan = inputIdJurusan.val();
        let status_data = inputStatusData.val();

        // Membuat objek data yang akan dikirimkan melalui AJAX
        let data = {
            nama_kelas: nama_kelas,
            id_jurusan: id_jurusan,
            status_data: status_data,
        };

        // Kirim data ke controller menggunakan AJAX
        $.ajax({
            url: mainURL + "/api/kelas",
            type: "post",
            data: data,
            dataType: "json",
            success: function (response) {
                // Respon berhasil dikirim ke user
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
                    title: "Kelas " + data.nama_kelas + " berhasil ditambahkan",
                });
            },
            error: function (xhr, status, error) {
                // Menampilkan pesan error AJAX
                let errors = Object.keys(xhr.responseJSON.errors)
                    .map(function (key) {
                        return xhr.responseJSON.errors[key];
                    })
                    .join("<br>");
                Swal.fire({
                    title: "" + errors,
                    icon: "error",
                    confirmButtonText: "Ok",
                });
            },
        });
    });
});
