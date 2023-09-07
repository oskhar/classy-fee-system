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
        this.detailFormGroup = $("#detailFormGroup");
        this.detailAlamat = $("#detailAlamat");
        this.printButton = $("#printAlamat");

        this.fetchProvinces();
        this.setListeners();
        this.setFormData();
    }

    setFormData() {
        const self = this;
        let url = `${self.mainURL}/api/siswa`;
        let dataBody = { nis: self.getIdSiswa() };
        console.log(dataBody);

        self.doAjax(
            url,
            function (response) {
                const alamat = response.data.alamat;
                console.log(alamat.split(", ", ""));
                console.log(response.data.alamat);
                self.provinceSelect
                    .find('option[value="' + alamat[0] + '"]')
                    .prop("selected", true);
                self.regencySelect
                    .find('option[value="' + alamat[1] + '"]')
                    .prop("selected", true);
                self.districtSelect
                    .find('option[value="' + alamat[2] + '"]')
                    .prop("selected", true);
                self.villageSelect
                    .find('option[value="' + alamat[3] + '"]')
                    .prop("selected", true);
                $("#nama_siswa").val(response.data.nama_siswa); // Ubah sesuai dengan ID input yang sesuai
                $("#nis").val(response.data.nis);
                $("#nisn").val(response.data.nisn);
                $("#agama")
                    .find('option[value="' + response.data.agama + '"]')
                    .prop("selected", true);
                $("#tempat_lahir").val(response.data.tempat_lahir);
                $("#tanggal_lahir").val(response.data.tanggal_lahir);
                $("#jenis_kelamin")
                    .find('option[value="' + response.data.jenis_kelamin + '"]')
                    .prop("selected", true);
                $("#nama_ayah").val(response.data.nama_ayah);
                $("#pekerjaan_ayah").val(response.data.pekerjaan_ayah);
                $("#penghasilan_ayah").val(response.data.penghasilan_ayah);
                $("#nama_ibu").val(response.data.nama_ibu);
                $("#pekerjaan_ibu").val(response.data.pekerjaan_ibu);
                $("#penghasilan_ibu").val(response.data.penghasilan_ibu);
                $("#telp_rumah").val(response.data.telp_rumah); // Ubah sesuai dengan ID input yang sesuai
                $("#status_data")
                    .val(response.data.status_data)
                    .find('option[value="' + response.data.status_data + '"]')
                    .prop("selected", true);
            },
            dataBody
        );
    }

    setListeners() {
        const self = this;

        $("#form-ubah-siswa").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/siswa`;
            let method = "put";
            let dataBody = {
                id_wali_siswa: self.getIdSiswa(),
                nama_siswa: $("#nama_siswa").val(), // Ubah sesuai dengan ID input yang sesuai
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

        self.villageSelect.on("change", function () {
            self.detailFormGroup.show();
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
        const selectedDetail = this.detailAlamat.find(":selected").text();

        const fullAddress = `${selectedProvince}, ${selectedRegency}, ${selectedDistrict}, ${selectedVillage}, ${selectedDetail}`;

        if (fullAddress.includes("Pilih")) {
            return "";
        }

        return this.toTitleCase(fullAddress);
    }

    getIdSiswa() {
        // Ambil url keseluruhan
        let nis = this.objectURL.href.replace(
            `${this.mainURL}/admin/data-siswa-update/`,
            ""
        );
        nis = atob(nis);
        return nis;
    }
}

$(function () {
    // Inisialisasi masker inputmask
    $("[data-inputmask]").inputmask();

    new Main();
});
