import { Core } from "./Core.js";

class Main extends Core {
    constructor() {
        super();
        this.dataTableElement = $("#example1");
        this.setDataTableBukuTabungan();
    }

    setDataTableBukuTabungan() {
        // Data yang dibutuhkan tabel
        const urlAPI = `${this.mainURL}/api/buku-tabungan`;
        const dataColumns = [
            { data: "nomor_rekening" },
            {
                data: "debit",
                render: (data) => {
                    const uang =
                        this.numberToMoney(data) == 0
                            ? "0"
                            : `Rp ${this.numberToMoney(data)}.-`;
                    return uang;
                },
            },
            {
                data: "kredit",
                render: (data) => {
                    const uang =
                        this.numberToMoney(data) == 0
                            ? "0"
                            : `Rp ${this.numberToMoney(data)}.-`;
                    return uang;
                },
            },
            {
                data: "saldo",
                render: (data) => {
                    const uang = `Rp ${this.numberToMoney(data)}.-`;
                    return uang;
                },
            },
            {
                data: "tanggal",
                render: (data) => {
                    return this.convertTanggal(data);
                },
            },
            {
                data: "status_data",
                render: (data) => {
                    const className =
                        data === "Aktif" ? "text-success" : "text-danger";
                    return `<strong class='${className} px-3'>${data}</strong>`;
                },
            },
        ];

        // Membuat tabel
        this.dataTable = this.setDataTable(
            this.dataTableElement,
            urlAPI,
            dataColumns,
            10
        );
    }
}

$(function () {
    new Main();
});
