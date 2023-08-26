import { Core } from "./Core.js";

class Main extends Core{

    constructor() {
        super();
        this.inputNamaKelas = $("#nama_kelas");
        this.inputIdJurusan = $("#id_jurusan");
        this.inputStatusData = $("#status_data");
        this.paramIdKelas = this.getIdKelas();

        this.setInputJurusan();
        this.setFormData();
        this.setListener();
    }

    setFormData() {
        const self = this; // Simpan referensi this dalam variabel self
        let url = `${self.mainURL}/api/kelas/find`;
        let dataBody = {id_kelas: self.paramIdKelas};

        this.doAjax(url, function (response) {
            let pilihanIdJurusan = parseInt(response.data.id_jurusan.replace('J-', ''))-1;
            let pilihanStatusData = response.data.status_data == "Aktif" ? 0 : 1;
            self.inputNamaKelas.val(response.data.nama_kelas);
            self.inputIdJurusan.val($("#id_jurusan option").eq(pilihanIdJurusan).val());
            self.inputStatusData.val($("#status_data option").eq(pilihanStatusData).val());
        }, dataBody);
    }

    setInputJurusan() {
        const self = this; // Simpan referensi this dalam variabel self
        
        // Assigmen data yang diperlukan untuk mengakses API
        let url = `${self.mainURL}/api/jurusan/untuk-input-option`;
        
        this.doAjax(url, function (response) {
            let data;
            for (let i = 0; i < response.data.length; i++) {
                data = response.data[i];
                self.inputIdJurusan.append(
                    new Option(data.nama_jurusan, data.id_jurusan)
                );
            }
        });
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-tambah-kelas").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/kelas`;
            let method = 'put';
            let dataBody = {
                id_kelas: self.paramIdKelas,
                nama_kelas: self.inputNamaKelas.val(),
                id_jurusan: self.inputIdJurusan.val(),
                status_data: self.inputStatusData.val(),
            };

            // Jalankan api untuk create data saat submit
            self.doAjax(url, function (response) {
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
                    title: `Kelas ${response.data.nama_kelas} berhasil ditambahkan`,
                });
            }, dataBody, method);
        });
    }

    getIdKelas () {
        // Ambil url keseluruhan
        const id_kelas = this.objectURL.searchParams.get('id_kelas');
        return id_kelas;
    }
}

$(function () {
    new Main();
});
