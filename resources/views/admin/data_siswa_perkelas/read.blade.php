@extends('layout.template_admin')
  
@section('title', 'Halaman Dashboard')
@section('mainContent')

  @include('depedensi.admin.data_siswa_perkelas.read')

  <section class="content">

    <div class="col-md-12">
      <div class="callout callout-success">
          <b class="text-muted">Data siswa SMK Triguna Utama</b>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- /.card-header -->
          <div class="card">
            <div class="card-body">
                  <a href="{{ route('export.siswa') }}" class="btn btn-outline-primary p-2 ml-2" >Export Data</a>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Status Data</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
        </div>
      </div>
  </section>
@endsection