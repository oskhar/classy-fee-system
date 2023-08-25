/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/admin/data_kelas_create.js ***!
  \*************************************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
var Main = /*#__PURE__*/function () {
  function Main() {
    _classCallCheck(this, Main);
    this.inputNamaKelas = $("#nama_kelas");
    this.inputIdJurusan = $("#id_jurusan");
    this.inputStatusData = $("#status_data");
    this.setInputJurusan();
    this.setListener();
  }
  _createClass(Main, [{
    key: "setInputJurusan",
    value: function setInputJurusan() {
      var self = this; // Simpan referensi this dalam variabel self
      $.ajax({
        url: "".concat(mainURL, "/api/jurusan/untuk-input-option"),
        type: "get",
        dataType: "json",
        success: function success(response) {
          var data;
          for (var i = 0; i < response.data.length; i++) {
            data = response.data[i];
            self.inputIdJurusan.append(new Option(data.nama_jurusan, data.id_jurusan));
          }
        },
        error: function error(xhr, status, _error) {
          alert("Data gagal ditambahkan: " + xhr.status + "\n" + xhr.responseText + "\n" + _error);
        }
      });
    }
  }, {
    key: "setListener",
    value: function setListener() {
      var self = this; // Simpan referensi this dalam variabel self
      $("#form-tambah-kelas").submit(function (event) {
        // Mencegah pengiriman formulir secara default
        event.preventDefault();

        // Mendapatkan nilai input dari form
        var nama_kelas = self.inputNamaKelas.val();
        var id_jurusan = self.inputIdJurusan.val();
        var status_data = self.inputStatusData.val();

        // Membuat objek data yang akan dikirimkan melalui AJAX
        var data = {
          nama_kelas: nama_kelas,
          id_jurusan: id_jurusan,
          status_data: status_data
        };

        // Kirim data ke controller menggunakan AJAX
        $.ajax({
          url: "".concat(mainURL, "/api/kelas"),
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
              title: "Kelas berhasil ditambahkan"
            });
          },
          error: function error(xhr, status, _error2) {
            // Menampilkan pesan error AJAX
            var errors;
            if (xhr.responseJSON.errors) {
              errors = self.objectToString(xhr.responseJSON.errors);
            } else {
              errors = self.objectToString(xhr.responseJSON);
            }
            Swal.fire({
              title: errors,
              icon: "error",
              confirmButtonText: "Ok"
            });
          }
        });
      });
    }
  }, {
    key: "showSuccessMessage",
    value: function showSuccessMessage(message) {
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
        title: message
      });
    }
  }, {
    key: "showErrorMessage",
    value: function showErrorMessage(message) {
      Swal.fire({
        title: message,
        icon: "error",
        confirmButtonText: "Ok"
      });
    }
  }, {
    key: "objectToString",
    value: function objectToString(object) {
      return Object.values(object).join("<br>");
    }
  }]);
  return Main;
}();
$(function () {
  var main = new Main();
});
/******/ })()
;