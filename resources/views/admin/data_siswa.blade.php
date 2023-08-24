@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

  <style>
    .buttons-excel {
      background: var(--primary);
    }.buttons-excel::before {
      content: "Unduh Sebagai ";
    }
    .card-outline-left {
      border-left: 0.3rem solid var(--success);
    }
  </style>
  @include('depedensi.admin.data_siswa')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Siswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('') }}">Dashboard</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

<section class="content">
  <div class="container-fluid">
    <div class="card card-outline-left">
      <div class="card-primary p-4">
        <h3 class="card-title text-muted">Data Siswa SMK Triguna Utama</h3>
      </div>
    </div>
  </div>
</section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card-header -->
          <div class="card">
            <div class="card-body">
                  <div class="row">
                    <a href="{{ url('dashboard/create') }}" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Tambah Data</a>
                    <a href="{{ url('dashboard/export_excel') }}" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Export Data</a>
                    <a href="" class="btn border-primary text-primary btn-sm col-sm-1 p-2 ml-2" onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')">Import Data</a>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Gender</th>
                        <th>Agama</th>
                        <th>Nomor Telepon</th>
                        <th>Status Data</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data_siswa as $data)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data['nis'] }}</td>
                        <td>{{ $data['nisn'] }}</td>
                        <td>{{ $data['nama'] }}</td>
                        <td>{{ ['Perempuan', 'Laki Laki'][$data['gender']] }}</td>
                        <td>{{ $data['agama'] }}</td>
                        <td>{{ $data['no_telp'] }}</td>
                        <td>{{ ['Aktif', 'Tidak Aktif'][$data['status_data']] }}</td>
                        <td>
                          <a onmouseover="this.classList.add('btn-info');this.classList.remove('text-info')" onmouseout="this.classList.remove('btn-info');this.classList.add('text-info')" href="{{ url('/dashboard/detail') }}/{{ $data['nis'] }}" class="btn border-info text-info btn-sm">
                            <i class="fas fa-eye"></i>
                          </a>
                          <a onmouseover="this.classList.add('btn-primary');this.classList.remove('text-primary')" onmouseout="this.classList.remove('btn-primary');this.classList.add('text-primary')" href="{{ url('/dashboard/update') }}/{{ $data['nis'] }}" class="btn border-primary text-primary btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a onmouseover="this.classList.add('btn-danger');this.classList.remove('text-danger')" onmouseout="this.classList.remove('btn-danger');this.classList.add('text-danger')" onclick="doSoftDelete(\'{{ $data['nis'] }}\')" class="btn border-danger text-danger btn-sm">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
        </div>
      </div>
  </section>
  <script>
    function doSoftDelete(nis) {
      // Membuat data dictionary
      let data = {nis: nis};

      // Kirim data ke controller menggunakan AJAX
      $.ajax({
        url: '{{ url("dashboard/soft_delete") }}',
        type: 'get',
        data: data,
        dataType: 'json',
        success: function(response) {
          alert("Data berhasil dihapus");
        window.location.href = "{{ url('dashboard') }}";
        },
        error: function(xhr, status, error) {
          alert("Data gagal ditambahkan: " + xhr.status + "\n" + xhr.responseText + "\n" + error);
        }
      });
    }
  </script>
  <!-- DataTables  & Plugins -->
  <script src="adminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="adminLTE/plugins/jszip/jszip.min.js"></script>
  <script src="adminLTE/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="adminLTE/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="adminLTE/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "language": {
            "info": 'Last updated data on'
        }
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection