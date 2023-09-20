import { customAlphabet } from "nanoid";
import { Core } from "../Core.js";

class Main extends Core {
    constructor() {
        super();

        this.idTahunAjar = $("#idTahunAjar");
        this.idSiswa = $("#idSiswa");
        this.doAjax(`${this.mainURL}/api/siswa`, function (response) {
            console.log(response);
        });
        this.fetchTahunAjar();
        this.tahunAjarSelected = false;

        this.setListeners();
    }

    setListeners() {
        const self = this;

        self.idTahunAjar.on("change", function () {
            this.tahunAjarSelected = $(this).val();
            self.idTahunAjar.prop("disabled", false);

            if (this.tahunAjarSelected) {
                self.fetchNamaSiswa();
            }
        });

        // self.regencySelect.on("change", function () {
        //     const selectedRegencyId = $(this).val();
        //     self.districtFormGroup.hide();
        //     self.villageFormGroup.hide();

        //     if (selectedRegencyId) {
        //         self.fetchDistricts(selectedRegencyId);
        //     }
        // });

        // self.districtSelect.on("change", function () {
        //     const selectedDistrictId = $(this).val();
        //     self.villageFormGroup.hide();

        //     if (selectedDistrictId) {
        //         self.fetchVillages(selectedDistrictId);
        //     }
        // });
    }

    fetchTahunAjar() {
        const self = this;
        const url = `${self.mainURL}/api/tahun-ajar`;

        self.doAjax(url, function (response) {
            self.populateSelect(self.idTahunAjar, response.data);
        });
    }

    fetchNamaSiswa() {
        const self = this;
        const url = `${self.mainURL}/api/siswa`;

        self.doAjax(url, function (response) {
            self.populateSelect(self.idSiswa, response.data);
        });
    }

    populateSelect(selectElement, data) {
        selectElement.html('<option value="" selected disabled>Pilih</option>');
        $.each(data, function (index, item) {
            selectElement.append(
                $("<option>", {
                    value: item.id_tahun_ajar,
                    text: item.nama_tahun_ajar + " " + item.semester,
                })
            );
        });
    }
}

$(function () {
    new Main();
});
