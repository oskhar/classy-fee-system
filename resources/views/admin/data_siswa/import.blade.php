@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

  @include('depedensi.admin.data_siswa.import')

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
          <form id="import-form" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="excel-file">Pilih file Excel:</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="excel-file" id="excel-file" accept=".xlsx, .xls" required>
                  <label class="custom-file-label" id="file-label" for="excel-file">Pilih file</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" id="import-button">Impor</button>
          </form>
          <div id="loading" class="mt-3" style="display: none;">
              Sedang mengimpor data... Mohon tunggu.
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
