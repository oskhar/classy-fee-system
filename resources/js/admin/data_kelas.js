function lakukanSoftDelete(id_kelas) {
    // Kirim data ke controller menggunakan AJAX
    $.ajax({
        url: mainURL + "/api/kelas",
        type: "delete",
        data: { id_kelas: id_kelas },
        dataType: "json",
        success: function (response) {
            // Respon berhasil dikirim ke user
            console.log(response);
            Swal.fire({
                toast: true,
                position: "top-right",
                iconColor: "white",
                color: "white",
                background: "var(--warning)",
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                icon: "success",
                title: "Kelas " + response.nama_kelas + " berhasil dihapus",
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
}

function pindahDenganMembawaData(url, data) {
    localStorage.setItem("idKelasYangDipilih", data);
    window.location.href = url;
}

$(function () {
    // Mengatur DataTable
    const table = $("#example1").DataTable({
        ajax: {
            url: mainURL + "/api/kelas/untuk-tabel",
        },
        columns: [
            { data: "nama_kelas" },
            { data: "nama_jurusan" },
            {
                data: "status_data",
                render: function (data) {
                    return `<strong class='text-success px-3'>${data}</strong>`;
                },
            },
            {
                data: "id_kelas",
                render: function (data) {
                    return `
                        <a class="btn-action view" data-id="${data}" data-action="view">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn-action edit" data-id="${data}" data-action="edit">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn-action delete" data-id="${data}" data-action="delete">
                            <i class="fas fa-trash"></i>
                        </a>`;
                },
            },
        ],
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        language: {
            info: "Last updated data on",
        },
    });

    // Event listener untuk tindakan pada tombol-tombol
    $("#example1").on("click", ".btn-action", function () {
        const id = $(this).data("id");
        const action = $(this).data("action");

        if (action === "view") {
            pindahDenganMembawaData(`${mainURL}/admin/data-kelas/detail/`, id);
        } else if (action === "edit") {
            pindahDenganMembawaData(`${mainURL}/admin/data-kelas/edit/`, id);
        } else if (action === "delete") {
            lakukanSoftDelete(id);
        }
    });
});
