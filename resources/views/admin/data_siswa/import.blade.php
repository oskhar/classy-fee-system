@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

  @include('depedensi.admin.data_siswa.import')

  <section class="content">
    <div class="container-fluid">
      <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Download Template Excel</h3>
        </div>
        <div class="card-body">
            <p>Unduh template Excel yang sesuai untuk mengimpor data:</p>
            <a href="{{ url('template_excel/siswa.xlsx') }}" class="btn btn-primary"><i class="fas fa-download"></i> Download Template</a>
        </div>
    </div>
    
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Import Data Siswa SMK Triguna Utama</h3>
        </div>
        <div class="card-body">
          <form id="import-form" class="row" enctype="multipart/form-data">
              @csrf
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
              <div class="form-group col-sm-12">
                <label for="excel-file">Pilih file Excel:</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="excel-file" id="excel-file" accept=".xlsx, .xls" required>
                  <label class="custom-file-label" id="file-label" for="excel-file">Pilih file</label>
                </div>
              </div>
              <div class="form-group col-sm-12">
              <button type="submit" class="btn btn-primary" id="import-button">Impor</button>
          </form>
          <div id="loading" class="mt-3" style="display: none;">
            loading...
            <div class="progress"><div class="progress-bar" role="progressbar" style="width: 0;"></div></div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
