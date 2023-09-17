{{-- Main CSS --}}
<link rel="stylesheet" href="{{ asset('css/template_admin.css') }}">

{{-- Main JS --}}
<script src="{{ asset('js/template_admin.js') }}"></script>

{{-- Sweetalert 2 --}}
<link rel="stylesheet" href="{{ asset('sweetalert/sweetalert2.min.css') }}">
<script src="{{ asset('sweetalert/sweetalert2.min.js') }}"></script>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/jqvmap/jqvmap.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('adminLTE/dist/css/adminlte.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.css') }}">
<!-- summernote -->
<link rel="stylesheet" href="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.css') }}">
<!-- jQuery -->
<script src="{{ asset('adminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('adminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminLTE/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('adminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminLTE/dist/js/pages/dashboard.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#logout-admin").click(function() {

            Swal.fire({
                title: "Logout dari akun ini?",
                showConfirmButton: false,
                showDenyButton: true,
                showCancelButton: true,
                denyButtonText: "Logout",
            }).then((result) => {
                // Assigmen data yang dibutuhkan untuk mengakses API
                const jwtToken = localStorage.getItem("jwtToken");

                // Jalankan api untuk delete data jika tombol hapus diclick
                if (result.isDenied) {
                    $.ajax({
                        url: `/api/auth/logout`,
                        type: "post",
                        headers: {
                            Authorization: `Bearer ${jwtToken}`,
                        },
                        dataType: "json",
                        success: (response) => {
                            localStorage.removeItem('jwtToken');
                            window.location.href = `/`;
                        },
                        error: (xhr) => {
                            // Menampilkan pesan error AJAX
                            let errors;
                            if (xhr.responseJSON.errors) {
                                errors = this.objectToString(xhr.responseJSON.errors);
                            } else {
                                errors = this.objectToString(xhr.responseJSON);
                            }
                            this.showErrorMessage(errors).then(() => {
                                if (xhr.status == 401) {
                                    window.location.href = "/";
                                }
                            });
                        },
                    });
                }
            });
        });
    });
</script>