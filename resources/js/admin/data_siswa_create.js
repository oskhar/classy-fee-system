import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.provinceSelect = $("#provinceSelect");
        this.regencySelect = $("#regencySelect");
        this.districtSelect = $("#districtSelect");
        this.villageSelect = $("#villageSelect");
        this.provinceFormGroup = $("#provinceFormGroup");
        this.regencyFormGroup = $("#regencyFormGroup");
        this.districtFormGroup = $("#districtFormGroup");
        this.villageFormGroup = $("#villageFormGroup");
        this.printButton = $("#printAlamat");

        this.setListeners();
        this.fetchProvinces();
    }

    setListeners() {
        const self = this;

        self.provinceSelect.on("change", function () {
            const selectedProvinceId = $(this).val();
            self.regencyFormGroup.hide();
            self.districtFormGroup.hide();
            self.villageFormGroup.hide();

            if (selectedProvinceId) {
                self.fetchRegencies(selectedProvinceId);
            }
        });

        self.regencySelect.on("change", function () {
            const selectedRegencyId = $(this).val();
            self.districtFormGroup.hide();
            self.villageFormGroup.hide();

            if (selectedRegencyId) {
                self.fetchDistricts(selectedRegencyId);
            }
        });

        self.districtSelect.on("change", function () {
            const selectedDistrictId = $(this).val();
            self.villageFormGroup.hide();

            if (selectedDistrictId) {
                self.fetchVillages(selectedDistrictId);
            }
        });
        self.printButton.on("click", function () {
            console.log(self.getAlamatSelected()); // Ubah ini menjadi metode atau tampilan yang sesuai dengan kebutuhan Anda
        });
    }

    fetchProvinces() {
        const self = this;
        const url = `${self.mainURL}/api-wilayah-indonesia/provinces.json`;

        self.doAjax(url, function (data) {
            self.populateSelect(self.provinceSelect, data);
            self.provinceFormGroup.show();
        });
    }

    fetchRegencies(provinceId) {
        const self = this;
        const url = `${self.mainURL}/api-wilayah-indonesia/regencies/${provinceId}.json`;

        self.doAjax(url, function (data) {
            self.populateSelect(self.regencySelect, data);
            self.regencyFormGroup.show();
        });
    }

    fetchDistricts(regencyId) {
        const self = this;
        const url = `${self.mainURL}/api-wilayah-indonesia/districts/${regencyId}.json`;

        self.doAjax(url, function (data) {
            self.populateSelect(self.districtSelect, data);
            self.districtFormGroup.show();
        });
    }

    fetchVillages(districtId) {
        const self = this;
        const url = `${self.mainURL}/api-wilayah-indonesia/villages/${districtId}.json`;

        self.doAjax(url, function (data) {
            self.populateSelect(self.villageSelect, data);
            self.villageFormGroup.show();
        });
    }

    populateSelect(selectElement, data) {
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

    getAlamatSelected() {
        const selectedProvince = this.provinceSelect.find(":selected").text();
        const selectedRegency = this.regencySelect.find(":selected").text();
        const selectedDistrict = this.districtSelect.find(":selected").text();
        const selectedVillage = this.villageSelect.find(":selected").text();

        if (
            selectedProvince === "" ||
            selectedRegency === "" ||
            selectedDistrict === "" ||
            selectedVillage === ""
        ) {
            alert("Pilih alamat lengkap sebelum mencetak.");
            return;
        }

        const fullAddress = `${selectedVillage}, ${selectedDistrict}, ${selectedRegency}, ${selectedProvince}`;

        return this.toTitleCase(fullAddress);
    }

    toTitleCase(str) {
        return str.toLowerCase().replace(/^(.)|\s+(.)/g, function ($1) {
            return $1.toUpperCase();
        });
    }
}

$(function () {
    new Main();
});
