/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/admin/data_kelas.js ***!
  \******************************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
// JavaScript (ES6+)
var Main = /*#__PURE__*/function () {
  function Main() {
    _classCallCheck(this, Main);
    this.dataTableElement = $("#example1");
    this.dataTable = this.setDataTable(this.dataTableElement);
    this.setListener();
  }
  _createClass(Main, [{
    key: "setListener",
    value: function setListener() {
      var self = this; // Simpan referensi this dalam variabel self

      // Event listener untuk tombol delete
      this.dataTableElement.on("click", ".btn-action.delete", function (event) {
        var button = $(this);
        var id_kelas = button.data("id");
        var nama_kelas = button.data("nama");
        self.performSoftDelete(id_kelas, nama_kelas); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari kelas Main
      });
    }
  }, {
    key: "setDataTable",
    value: function setDataTable(tableElement) {
      return tableElement.DataTable({
        ajax: {
          url: "".concat(mainURL, "/api/kelas/untuk-tabel"),
          type: "GET"
        },
        columns: [{
          data: "nama_kelas"
        }, {
          data: "nama_jurusan"
        }, {
          data: "status_data",
          render: function render(data) {
            var className = data === "Aktif" ? "text-success" : "text-danger";
            return "<strong class='".concat(className, " px-3'>").concat(data, "</strong>");
          }
        }, {
          data: "id_kelas",
          render: function render(data, type, row) {
            return "\n                        <a class=\"btn btn-outline-primary btn-sm\" href=\"".concat(mainURL, "/data-kelas-detail/").concat(data, "\">\n                            <i class=\"fas fa-eye\"></i>\n                        </a>\n                        <a class=\"btn btn-outline-warning btn-sm\" href=\"").concat(mainURL, "/data-kelas-update/").concat(data, "\">\n                            <i class=\"fas fa-pencil-alt\"></i>\n                        </a>\n                        <a class=\"btn btn-outline-danger btn-action btn-sm delete\" data-id=\"").concat(data, "\" data-nama=\"").concat(row.nama_kelas, "\">\n                            <i class=\"fas fa-trash\"></i>\n                        </a>\n                    ");
          }
        }],
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        language: {
          info: "Last updated data on"
        },
        processing: true,
        serverSide: true,
        // Aktifkan server-side processing
        paging: true,
        // Mengaktifkan paginasi
        pageLength: 10 // Menentukan jumlah data per halaman
      });
    }
  }, {
    key: "performSoftDelete",
    value: function performSoftDelete(id_kelas, nama_kelas) {
      var _this = this;
      this.showWarningMessage("Hapus kelas ".concat(nama_kelas, " ?"), "Hapus").then(function (result) {
        /* Read more about isConfirmed, isDenied below */
        if (result.isDenied) {
          $.ajax({
            url: "".concat(mainURL, "/api/kelas"),
            type: "delete",
            data: {
              id_kelas: id_kelas
            },
            dataType: "json",
            success: function success(response) {
              _this.refreshDataTable();
              _this.showSuccessMessage("Kelas ".concat(response.data.nama_kelas, " berhasil dihapus"));
            },
            error: function error(xhr) {
              // Menampilkan pesan error AJAX
              var errors;
              if (xhr.responseJSON.errors) {
                errors = self.objectToString(xhr.responseJSON.errors);
              } else {
                errors = self.objectToString(xhr.responseJSON);
              }
              _this.showErrorMessage(errors);
            }
          });
        }
      });
    }
  }, {
    key: "refreshDataTable",
    value: function refreshDataTable() {
      this.dataTable.ajax.reload();
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
    key: "showWarningMessage",
    value: function showWarningMessage(message, buttonText) {
      return Swal.fire({
        title: message,
        showConfirmButton: false,
        showDenyButton: true,
        showCancelButton: true,
        denyButtonText: buttonText
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