import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.doAjax(
            `${this.mainURL}/api/siswa`,
            function (response) {
                console.log(response);
            },
            { nis: "087392" }
        );
    }
}

$(function () {
    new Main();
});
