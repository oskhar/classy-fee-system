/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/admin/data_siswa.js ***!
  \******************************************/
function doSoftDelete(nis, url) {
  // Membuat data dictionary
  var data = {
    nis: nis
  };

  // Kirim data ke controller menggunakan AJAX
  $.ajax({
    url: url,
    type: "get",
    data: data,
    dataType: "json",
    success: function success(response) {
      alert("Data berhasil dihapus");
      window.location.href = "{{ url('dashboard') }}";
    },
    error: function error(xhr, status, _error) {
      alert("Data gagal ditambahkan: " + xhr.status + "\n" + xhr.responseText + "\n" + _error);
    }
  });
}
$(function () {
  $("#example1").DataTable({
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    language: {
      info: "Last updated data on"
    }
  }).buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
});
/******/ })()
;