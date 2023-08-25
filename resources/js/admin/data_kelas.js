const apiURL = mainURL + "/api/kelas/untuk-tabel";
function doSoftDelete(nis, url) {
    // Kirim data ke controller menggunakan AJAX
    $.ajax({
        url: apiURL,
        type: "get",
        dataType: "json",
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            alert(
                "Data gagal ditemukan: " +
                    xhr.status +
                    "\n" +
                    xhr.responseText +
                    "\n" +
                    error
            );
        },
    });
}

$(function () {
    // Mengatur DataTable
    $("#example1")
        .DataTable({
            ajax: {
                url: apiURL,
            },
            columns: [
                { data: "nama_kelas" },
                { data: "nama_jurusan" },
                {
                    data: "status_data",
                    render: function (data) {
                        return (
                            "<strong class='text-success px-3'>" +
                            data +
                            "</strong>"
                        );
                    },
                },
                {
                    data: "id_kelas",
                    render: function (data) {
                        localStorage.setItem("idKelasYangDipilih", data);
                        return (
                            `<a onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')" href="` +
                            (mainURL + "/admin/data-kelas/detail/") +
                            `" class="btn border-primary text-primary btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a onmouseover="this.classList.add('btn-warning');this.classList.remove('text-warning')" onmouseout="this.classList.remove('btn-warning');this.classList.add('text-warning')" href="` +
                            (mainURL + "/admin/data-kelas/edit/") +
                            `" class="btn border-warning text-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a onmouseover="this.classList.add('btn-danger');this.classList.remove('text-danger')" onmouseout="this.classList.remove('btn-danger');this.classList.add('text-danger')" class="btn border-danger text-danger btn-sm" onclick="doSoftDelete({{ $data->id }}, '{{ $data->nama_lengkap }}')">
                            <i class="fas fa-trash"></i>
                        </a>`
                        );
                    },
                },
            ],
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            language: {
                info: "Last updated data on",
            },
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
});
