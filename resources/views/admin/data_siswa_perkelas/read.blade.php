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
            <div class="card-body row">

              <div class='form-group col-sm-6'>
                  <label for='idTahunAjar'>Tahun ajar</label>
                  <select required class="form-control" name="idTahunAjar" id="idTahunAjar">
                      <option value="" disabled>Pilih tahun ajar</option>
                  </select>
              </div>

              <div class='form-group col-sm-6'>
                  <label for='idKelas'>Nama Kelas</label>
                  <select required class="form-control" name="idKelas" id="idKelas">
                      <option value="" disabled>Pilih kelas</option>
                  </select>
              </div>
              <div class="col-lg-12">
                  <button class="btn btn-outline-primary p-2 my-2" id="exportSiswaPerkelas">Export Data</button>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Tahun Ajar</th>
                        <th>Semester</th>
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
      </div>
  </section>
@endsection