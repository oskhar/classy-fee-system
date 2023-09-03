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
        $("#form-tambah-siswa").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/siswa`;
            let method = "post";
            let dataBody = {
                nama_siswa: $("#nama").val(), // Ubah sesuai dengan ID input yang sesuai
                nis: $("#nis").val(),
                nisn: $("#nisn").val(),
                agama: $("#agama").val(),
                tempat_lahir: $("#tempat_lahir").val(),
                tanggal_lahir: $("#tanggal_lahir").val(),
                jenis_kelamin: $("#jenis_kelamin").val(),
                alamat: self.getAlamatSelected(), // Gunakan metode yang sudah Anda definisikan untuk mendapatkan alamat
                nama_ayah: $("#nama_ayah").val(),
                pekerjaan_ayah: $("#pekerjaan_ayah").val(),
                penghasilan_ayah: $("#penghasilan_ayah").val(),
                nama_ibu: $("#nama_ibu").val(),
                pekerjaan_ibu: $("#pekerjaan_ibu").val(),
                penghasilan_ibu: $("#penghasilan_ibu").val(),
                telp_rumah: $("#telp_rumah").val(), // Ubah sesuai dengan ID input yang sesuai
                status_data: $("#status_data").val(),
            };

            // Jalankan api untuk create data saat submit
            self.doAjax(
                url,
                function (response) {
                    if (response.data.errors) {
                        self.showInfoMessage(
                            self.objectToString(response.data.errors),
                            "pulihkan"
                        ).then((result) => {
                            if (result.isConfirmed) {
                                let url = `${self.mainURL}/api/siswa/pulihkan`;
                                let method = "put";
                                let dataBody = {
                                    id_siswa: response.data.id_siswa,
                                };
                                self.doAjax(
                                    url,
                                    function (response) {
                                        self.showSuccessAndRedirect(
                                            response.data.success.message,
                                            `${self.mainURL}/admin/data-siswa`
                                        );
                                    },
                                    dataBody,
                                    method
                                );
                            }
                        });
                    } else {
                        self.showSuccessMessage(response.data.success.message);
                    }
                },
                dataBody,
                method
            );
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

        const fullAddress = `${selectedVillage}, ${selectedDistrict}, ${selectedRegency}, ${selectedProvince}`;

        if (fullAddress.includes("Pilih")) {
            this.showErrorMessage("Alamat siswa wajib diisi!");
            return "";
        }

        return this.toTitleCase(fullAddress);
    }
}

$(function () {
    // Inisialisasi masker inputmask
    $("[data-inputmask]").inputmask();

    new Main();
});
