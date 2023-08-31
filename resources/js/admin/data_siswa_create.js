$(document).ready(function () {
    const provinceSelect = $("#provinceSelect");
    const regencySelect = $("#regencySelect");
    const districtSelect = $("#districtSelect");
    const villageSelect = $("#villageSelect");

    function populateSelect(selectElement, data) {
        selectElement.html('<option value="">Pilih</option>');
        $.each(data, function (index, item) {
            selectElement.append(
                $("<option>", {
                    value: item.id,
                    text: item.name,
                })
            );
        });
        selectElement.show();
    }

    provinceSelect.on("change", function () {
        const selectedProvinceId = $(this).val();
        regencySelect.hide();
        districtSelect.hide();
        villageSelect.hide();

        if (selectedProvinceId) {
            $.get(`api/regencies/${selectedProvinceId}.json`, function (data) {
                populateSelect(regencySelect, data);
            });
        }
    });

    regencySelect.on("change", function () {
        const selectedRegencyId = $(this).val();
        districtSelect.hide();
        villageSelect.hide();

        if (selectedRegencyId) {
            $.get(`api/districts/${selectedRegencyId}.json`, function (data) {
                populateSelect(districtSelect, data);
            });
        }
    });

    districtSelect.on("change", function () {
        const selectedDistrictId = $(this).val();
        villageSelect.hide();

        if (selectedDistrictId) {
            $.get(`api/villages/${selectedDistrictId}.json`, function (data) {
                populateSelect(villageSelect, data);
            });
        }
    });

    // Fetch initial provinces data
    $.get(`api/provinces.json`, function (data) {
        populateSelect(provinceSelect, data);
    });
});
