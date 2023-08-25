/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/admin/data_kelas_create.js ***!
  \*************************************************/
$(function () {
  var inputNamaKelas = $("#nama_kelas");
  var inputIdJurusan = $("#id_jurusan");
  var inputStatusData = $("#status_data");
  $.ajax({
    url: mainURL + "/api/jurusan/untuk-input-option",
    type: "get",
    dataType: "json",
    success: function success(response) {
      var data;
      for (var i = 0; i < response.data.length; i++) {
        data = response.data[i];
        inputIdJurusan.append(new Option(data.nama_jurusan, data.id_jurusan));
      }
    },
    error: function error(xhr, status, _error) {
      alert("Data gagal ditambahkan: " + xhr.status + "\n" + xhr.responseText + "\n" + _error);
    }
  });
  $("#form-tambah-kelas").submit(function (event) {
    // Mencegah pengiriman formulir secara default
    event.preventDefault();

    // Mendapatkan nilai input dari form
    var nama_kelas = inputNamaKelas.val();
    var id_jurusan = inputIdJurusan.val();
    var status_data = inputStatusData.val();

    // Membuat objek data yang akan dikirimkan melalui AJAX
    var data = {
      nama_kelas: nama_kelas,
      id_jurusan: id_jurusan,
      status_data: status_data
    };

    // Kirim data ke controller menggunakan AJAX
    $.ajax({
      url: mainURL + "/api/kelas",
      type: "post",
      data: data,
      dataType: "json",
      success: function success(response) {
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
          title: "Kelas " + response.nama_kelas + " berhasil ditambahkan"
        });
      },
      error: function error(xhr, status, _error2) {
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
  });
});
/******/ })()
;