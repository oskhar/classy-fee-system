import "./bootstrap";

$.ajaxSetup({
    header: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
