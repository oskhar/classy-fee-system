@extends('layout.template_admin')
  
@section('title', 'Halaman Dashboard')
@section('mainContent')

  @include('depedensi.admin.data_buku_tabungan.read')

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
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>nomor rekening</th>
                        <th>debit</th>
                        <th>kredit</th>
                        <th>saldo</th>
                        <th>tanggal</th>
                        <th>status_data</th>
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