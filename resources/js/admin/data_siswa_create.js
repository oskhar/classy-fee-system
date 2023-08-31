$(document).ready(function () {
    const objectURL = new URL(window.location.href);
    const mainURL = objectURL.origin;
    const provinceSelect = $("#provinceSelect");
    const regencySelect = $("#regencySelect");
    const districtSelect = $("#districtSelect");
    const villageSelect = $("#villageSelect");
    const provinceFormGroup = $("#provinceFormGroup");
    const regencyFormGroup = $("#regencyFormGroup");
    const districtFormGroup = $("#districtFormGroup");
    const villageFormGroup = $("#villageFormGroup");

    function populateSelect(selectElement, data) {
        selectElement.html('<option value="" selected disabled>Pilih</option>');
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
        regencyFormGroup.hide();
        districtFormGroup.hide();
        villageFormGroup.hide();

        if (selectedProvinceId) {
            $.get(
                `${mainURL}/api-wilayah-indonesia/regencies/${selectedProvinceId}.json`,
                function (data) {
                    populateSelect(regencySelect, data);
                    regencyFormGroup.show();
                }
            );
        }
    });

    regencySelect.on("change", function () {
        const selectedRegencyId = $(this).val();
        districtFormGroup.hide();
        villageFormGroup.hide();

        if (selectedRegencyId) {
            $.get(
                `${mainURL}/api-wilayah-indonesia/districts/${selectedRegencyId}.json`,
                function (data) {
                    populateSelect(districtSelect, data);
                    districtFormGroup.show();
                }
            );
        }
    });

    districtSelect.on("change", function () {
        const selectedDistrictId = $(this).val();
        villageFormGroup.hide();

        if (selectedDistrictId) {
            $.get(
                `${mainURL}/api-wilayah-indonesia/villages/${selectedDistrictId}.json`,
                function (data) {
                    populateSelect(villageSelect, data);
                    villageFormGroup.show();
                }
            );
        }
    });

    // Fetch initial provinces data
    $.get(`${mainURL}/api-wilayah-indonesia/provinces.json`, function (data) {
        populateSelect(provinceSelect, data);
        provinceFormGroup.show();
    });
});
