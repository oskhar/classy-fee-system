@extends('layout.template_admin')
  
@section('title', 'Halaman Dashboard')
@section('mainContent')

  @include('depedensi.admin.transaksi_tabungan.read')

  <section class="content">

    <div class="col-md-12">
      <div class="callout callout-success">
          <b class="text-muted">Data buku tabungan SMK Triguna Utama</b>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <!-- /.card-header -->
          <div class="card">
            <div class="card-body row">
              <div class="col-lg-12">
                  <a href="{{route('admin.transaksi_tabungan_create')}}" class="btn btn-outline-primary p-2 my-2 ml-2">Tambah Data</a>
                  <button class="btn btn-outline-primary p-2 my-2" id="exportSiswaPerkelas">Export Data</button>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>hak akses</th>
                        <th>nomor rekening</th>
                        <th>jenis transaksi</th>
                        <th>tanggal transaksi</th>
                        <th>nominal</th>
                        <th>status data</th>
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
      </div>
  </section>
@endsection