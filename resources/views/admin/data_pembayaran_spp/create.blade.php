@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Pembayaran SPP</h1>
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
        <div class='row'><div class='col-md-12'><div class='callout callout-success'><p class='text-secondary'>Data Pembayaran SPP</p></div></div></div><div class='row'><div class='col-md-12'><div class='callout callout-success'><p class='text-secondary'>Formulir pembayaran spp</p></div></div><div class='col-md-12'><div class='card'><div class='card-body'><form method='POST' enctype='multipart/form-data'><div class='form-row'>
            <div class='form-group col-md-12'>
                <label for'txt_id_master_data'>ID Master Data</label>
                <input type='text' class='form-control' id='txt_id_master_data' name='txt_id_master_data' placeholder='ID Master Data'>
            </div>
        
            <div class='form-group col-md-4'>
                <label for'txt_nisn'>NISN Siswa</label>
                <input type='text' class='form-control' id='txt_nisn' name='txt_nisn' placeholder='NIS Siswa' disabled>
            </div>
        
            <div class='form-group col-md-4'>
                <label for'txt_nama_siswa'>Nama Siswa</label>
                <input type='text' class='form-control' id='txt_nama_siswa' name='txt_nama_siswa' placeholder='Nama Siswa' disabled>
            </div>
        
            <div class='form-group col-md-4'>
                <label for'txt_kelas'>Kelas</label>
                <input type='text' class='form-control' id='txt_kelas' name='txt_kelas' placeholder='Kelas' disabled>
            </div>
        
            <div class='form-group col-md-4'>
                <label for'cb_jenis_pembayaran'>Jenis Pembayaran</label>
                <select class='form-control' id='cb_jenis_pembayaran' name='cb_jenis_pembayaran'>
                    <option value='SPP Bulanan'>SPP Bulanan</option>
                    <option value='Lainnya'>Lainnya</option>
                </select>
            </div>
        
            <div class='form-group col-md-4'>
                <label for'txt_nominal_pembayaran'>Nominal Pembayaran</label>
                <input type='text' class='form-control' id='txt_nominal_pembayaran' name='txt_nominal_pembayaran' placeholder='Nominal Pembayaran'>
            </div>
        
            <div class='form-group col-md-4'>
                <label for'txt_tanggal_pembayaran'>Tanggal Pembayaran</label>
                <input type='date' class='form-control' id='txt_tanggal_pembayaran' name='txt_tanggal_pembayaran' placeholder='Tanggal Pembayaran'>
            </div>
        
            <div class='form-group'>
                <button type='submit' class='btn btn-success' name='submit'>Submit</button>
                <button type='reset' class='btn btn-danger' name='reset'>Reset</button>
            </div>
        </div></form></div></div></div></div>
    </div>
</section>
@endsection