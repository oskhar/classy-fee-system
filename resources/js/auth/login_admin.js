import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.setListener();
        this.checkLogin();
    }

    checkLogin() {
        const jwtToken = localStorage.getItem("jwtToken");
        const self = this;
        if (jwtToken) {
            this.doAjax(
                `${self.mainURL}/api/auth/me`,
                function (response) {
                    window.location.href = `${self.mainURL}/admin`;
                },
                {},
                "post",
                {
                    Authorization: `Bearer ${jwtToken}`,
                },
                true
            );
        }
    }

    setListener() {
        const self = this; // Simpan referensi this dalam variabel self
        $("#form-login").submit(function (event) {
            // Mencegah pengiriman formulir secara default
            event.preventDefault();

            // Assigmen data yang diperlukan untuk mengakses API
            let url = `${self.mainURL}/api/auth/login`;
            let method = "post";
            let dataBody = {
                jenis_login: $("#username").val(),
                username: $("#username").val(),
                password: $("#password").val(),
            };
            if (dataBody.username == "siswa") {
                window.location.href = `${self.mainURL}/siswa`;
            } else {
                // Jalankan api untuk create data saat submit
                self.doAjax(
                    url,
                    function (response) {
                        localStorage.setItem("jwtToken", response.access_token);
                        window.location.href = `${self.mainURL}/admin`;
                    },
                    dataBody,
                    method
                );
            }
        });
    }
}

$(function () {
    new Main();
});
