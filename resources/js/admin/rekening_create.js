import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.pilihanSiswa = $("#nis");
        this.setInputSiswa();
    }

    setInputSiswa() {
        const self = this; // Simpan referensi this dalam variabel self

        // Assigmen data yang diperlukan untuk mengakses API
        let url = `${self.mainURL}/api/rekening/siswa-belum-terdaftar`;
        self.doAjax(url, function (response) {
            console.log(response);
        });
        // self.pilihanSiswa.html("");

        // this.doAjax(url, function (response) {
        //     let data;
        //     for (let i = 0; i < response.data.length; i++) {
        //         data = response.data[i];
        //         self.pilihanSiswa.append(
        //             new Option(`(${data.nis}) ${data.nama_siswa}`, data.nis)
        //         );
        //     }
        // });
    }
}

$(function () {
    new Main();
});
