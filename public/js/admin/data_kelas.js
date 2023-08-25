/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/admin/data_kelas.js ***!
  \******************************************/
function lakukanSoftDelete(id_kelas) {
  // Kirim data ke controller menggunakan AJAX
  $.ajax({
    url: mainURL + "/api/kelas",
    type: "delete",
    data: {
      id_kelas: id_kelas
    },
    dataType: "json",
    success: function success(response) {
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
        title: "Kelas " + response.nama_kelas + " berhasil dihapus"
      });
    },
    error: function error(xhr, status, _error) {
      // Menampilkan pesan error AJAX
      var errors = Object.keys(xhr.responseJSON.errors).map(function (key) {
        return xhr.responseJSON.errors[key];
      }).join("<br>");
      Swal.fire({
        title: "" + errors,
        icon: "error",
        confirmButtonText: "Ok"
      });
    }
  });
}
function pindahDenganMembawaData(url, data) {
  localStorage.setItem("idKelasYangDipilih", data);
  window.location.href = url;
}
$(function () {
  // Mengatur DataTable
  var table = $("#example1").DataTable({
    ajax: {
      url: mainURL + "/api/kelas/untuk-tabel"
    },
    columns: [{
      data: "nama_kelas"
    }, {
      data: "nama_jurusan"
    }, {
      data: "status_data",
      render: function render(data) {
        return "<strong class='text-success px-3'>".concat(data, "</strong>");
      }
    }, {
      data: "id_kelas",
      render: function render(data) {
        return "\n                        <a class=\"btn-action view\" data-id=\"".concat(data, "\" data-action=\"view\">\n                            <i class=\"fas fa-eye\"></i>\n                        </a>\n                        <a class=\"btn-action edit\" data-id=\"").concat(data, "\" data-action=\"edit\">\n                            <i class=\"fas fa-pencil-alt\"></i>\n                        </a>\n                        <a class=\"btn-action delete\" data-id=\"").concat(data, "\" data-action=\"delete\">\n                            <i class=\"fas fa-trash\"></i>\n                        </a>");
      }
    }],
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    language: {
      info: "Last updated data on"
    }
  });

  // Event listener untuk tindakan pada tombol-tombol
  $("#example1").on("click", ".btn-action", function () {
    var id = $(this).data("id");
    var action = $(this).data("action");
    if (action === "view") {
      pindahDenganMembawaData("".concat(mainURL, "/admin/data-kelas/detail/"), id);
    } else if (action === "edit") {
      pindahDenganMembawaData("".concat(mainURL, "/admin/data-kelas/edit/"), id);
    } else if (action === "delete") {
      lakukanSoftDelete(id);
    }
  });
});
/******/ })()
;