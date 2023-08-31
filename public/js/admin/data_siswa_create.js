/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./resources/js/admin/data_siswa_create.js ***!
  \*************************************************/
$(document).ready(function () {
  var objectURL = new URL(window.location.href);
  var mainURL = objectURL.origin;
  var provinceSelect = $("#provinceSelect");
  var regencySelect = $("#regencySelect");
  var districtSelect = $("#districtSelect");
  var villageSelect = $("#villageSelect");
  var provinceFormGroup = $("#provinceFormGroup");
  var regencyFormGroup = $("#regencyFormGroup");
  var districtFormGroup = $("#districtFormGroup");
  var villageFormGroup = $("#villageFormGroup");
  function populateSelect(selectElement, data) {
    selectElement.html('<option value="" selected disabled>Pilih</option>');
    $.each(data, function (index, item) {
      selectElement.append($("<option>", {
        value: item.id,
        text: item.name
      }));
    });
    selectElement.show();
  }
  provinceSelect.on("change", function () {
    var selectedProvinceId = $(this).val();
    regencyFormGroup.hide();
    districtFormGroup.hide();
    villageFormGroup.hide();
    if (selectedProvinceId) {
      $.get("".concat(mainURL, "/api-wilayah-indonesia/regencies/").concat(selectedProvinceId, ".json"), function (data) {
        populateSelect(regencySelect, data);
        regencyFormGroup.show();
      });
    }
  });
  regencySelect.on("change", function () {
    var selectedRegencyId = $(this).val();
    districtFormGroup.hide();
    villageFormGroup.hide();
    if (selectedRegencyId) {
      $.get("".concat(mainURL, "/api-wilayah-indonesia/districts/").concat(selectedRegencyId, ".json"), function (data) {
        populateSelect(districtSelect, data);
        districtFormGroup.show();
      });
    }
  });
  districtSelect.on("change", function () {
    var selectedDistrictId = $(this).val();
    villageFormGroup.hide();
    if (selectedDistrictId) {
      $.get("".concat(mainURL, "/api-wilayah-indonesia/villages/").concat(selectedDistrictId, ".json"), function (data) {
        populateSelect(villageSelect, data);
        villageFormGroup.show();
      });
    }
  });

  // Fetch initial provinces data
  $.get("".concat(mainURL, "/api-wilayah-indonesia/provinces.json"), function (data) {
    populateSelect(provinceSelect, data);
    provinceFormGroup.show();
  });
});
/******/ })()
;