/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin/Core.js":
/*!************************************!*\
  !*** ./resources/js/admin/Core.js ***!
  \************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Core: () => (/* binding */ Core)
/* harmony export */ });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
// Kelas utama untuk semua
var Core = /*#__PURE__*/function () {
  function Core() {
    _classCallCheck(this, Core);
    this.objectURL = new URL(window.location.href);
    this.mainURL = this.objectURL.origin;
    this.messageLink = this.getMessage();
    if (this.messageLink) {
      this.showSuccessMessage(this.messageLink);
    }
  }
  _createClass(Core, [{
    key: "doAjax",
    value: function doAjax(url, fungsiSaatSuccess) {
      var _this = this;
      var data = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : {};
      var method = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : "get";
      $.ajax({
        url: url,
        type: method,
        data: data,
        dataType: "json",
        success: function success(response) {
          fungsiSaatSuccess(response);
        },
        error: function error(xhr) {
          // Menampilkan pesan error AJAX
          var errors;
          if (xhr.responseJSON.errors) {
            errors = _this.objectToString(xhr.responseJSON.errors);
          } else {
            errors = _this.objectToString(xhr.responseJSON);
          }
          _this.showErrorMessage(errors);
        }
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
    key: "showInfoMessage",
    value: function showInfoMessage(message, buttonText) {
      return Swal.fire({
        title: message,
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: buttonText
      });
    }
  }, {
    key: "objectToString",
    value: function objectToString(object) {
      return Object.values(object).join("<br>");
    }
  }, {
    key: "setDataTable",
    value: function setDataTable(tableElement, urlAPI, dataColumns) {
      return tableElement.DataTable({
        ajax: {
          url: urlAPI,
          type: "GET",
          data: function data(_data) {
            // Tambahkan parameter pengurutan
            if (_data.order.length > 0) {
              _data.orderColumn = _data.order[0].column; // Indeks kolom yang ingin diurutkan
              _data.orderDir = _data.order[0].dir; // Arah pengurutan (asc atau desc)
            }
          }
        },

        columns: dataColumns,
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        language: {
          info: "Last updated data on"
        },
        processing: true,
        // Mengaktifkan side-server-processing
        searching: true,
        // Aktifkan fungsi searching
        serverSide: true,
        // Aktifkan server-side processing
        paging: true,
        // Mengaktifkan paginasi
        pageLength: 5,
        // Menentukan jumlah data per halaman
        drawCallback: function drawCallback() {
          $('[data-toggle="tooltip"]').tooltip();
        }
      });
    }
  }, {
    key: "getMessage",
    value: function getMessage() {
      // Ambil url keseluruhan
      var message = this.objectURL.searchParams.get("message");
      return message;
    }
  }]);
  return Core;
}();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!***********************************************!*\
  !*** ./resources/js/admin/data_tahun_ajar.js ***!
  \***********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Core_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Core.js */ "./resources/js/admin/Core.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }

var Main = /*#__PURE__*/function (_Core) {
  _inherits(Main, _Core);
  var _super = _createSuper(Main);
  function Main() {
    var _this;
    _classCallCheck(this, Main);
    _this = _super.call(this);
    _this.setDataTableTahunAjar();
    _this.setListener();
    return _this;
  }
  _createClass(Main, [{
    key: "setDataTableTahunAjar",
    value: function setDataTableTahunAjar() {
      var _this2 = this;
      // Data yang dibutuhkan tabel
      this.dataTableElement = $("#example1");
      var urlAPI = "".concat(this.mainURL, "/api/tahun-ajar");
      var dataColumns = [{
        data: "nama_tahun_ajar"
      }, {
        data: "semester"
      }, {
        data: "status_data",
        render: function render(data) {
          var className = data === "Aktif" ? "text-success" : "text-danger";
          return "<strong class='".concat(className, " px-3'>").concat(data, "</strong>");
        }
      }, {
        data: "id_tahun_ajar",
        render: function render(data, type, row) {
          return "\n                    <a class=\"btn btn-outline-primary btn-sm\" href=\"".concat(_this2.mainURL, "/admin/data-tahun-ajar-detail/").concat(data, "\" data-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"lihat detai data\">\n                        <i class=\"fas fa-eye\"></i>\n                    </a>\n                    <a class=\"btn btn-outline-warning btn-sm\" href=\"").concat(_this2.mainURL, "/admin/data-tahun-ajar-update/").concat(btoa(data), "\" data-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"ubah data\">\n                        <i class=\"fas fa-edit\"></i>\n                    </a>\n                    <a class=\"btn btn-outline-danger btn-action btn-sm delete\" data-id=\"").concat(data, "\" data-nama=\"").concat(row.nama_tahun_ajar, "\" data-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"hapus data\">\n                        <i class=\"fas fa-trash\"></i>\n                    </a>\n                ");
        }
      }];

      // Membuat tabel
      this.dataTable = this.setDataTable(this.dataTableElement, urlAPI, dataColumns);
    }
  }, {
    key: "setListener",
    value: function setListener() {
      var self = this; // Simpan referensi this dalam variabel self

      // Event listener untuk tombol delete
      this.dataTableElement.on("click", ".btn-action.delete", function (event) {
        var button = $(this);
        var id_tahun_ajar = button.data("id");
        var nama_tahun_ajar = button.data("nama");
        self.performSoftDelete(id_tahun_ajar, nama_tahun_ajar); // Menggunakan variabel self untuk memanggil metode performSoftDelete dari kelas Main
      });
    }
  }, {
    key: "performSoftDelete",
    value: function performSoftDelete(id_tahun_ajar, nama_tahun_ajar) {
      var _this3 = this;
      this.showWarningMessage("Hapus tahun ajar ".concat(nama_tahun_ajar, " ?"), "Hapus").then(function (result) {
        // Assigmen data yang dibutuhkan untuk mengakses API
        var urlAPI = "".concat(_this3.mainURL, "/api/tahun-ajar");
        var method = "delete";
        var dataBody = {
          id_tahun_ajar: id_tahun_ajar
        };

        // Jalankan api untuk delete data jika tombol hapus diclick
        if (result.isDenied) {
          _this3.doAjax(urlAPI, function (response) {
            _this3.refreshDataTable();
            _this3.showSuccessMessage("tahun ajar ".concat(response.data.nama_tahun_ajar, " berhasil dihapus"));
          }, dataBody, method);
        }
      });
    }
  }, {
    key: "refreshDataTable",
    value: function refreshDataTable() {
      this.dataTable.ajax.reload();
    }
  }]);
  return Main;
}(_Core_js__WEBPACK_IMPORTED_MODULE_0__.Core);
$(function () {
  new Main();
});
})();

/******/ })()
;