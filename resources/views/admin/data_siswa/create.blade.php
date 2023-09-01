@extends('layout.template_admin')

@section('title', 'Tambah data siswa')
@section('mainContent')

  @include('depedensi.admin.data_siswa.create')<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Data Siswa SMK Triguna Utama</p>
                </div>
            </div>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data' class="row" id="form-tambah-siswa">
                            @csrf
                            <div class='form-group col-sm-12'>
                                <label for='nama'>Nama Siswa</label>
                                <input type='text' class='form-control' id='nama' name='nama' placeholder='Nama Siswa'>
                            </div>

                            <div class='form-group col-sm-12'>
                                <label for='nis'>NIS</label>
                                <input type='text' class='form-control' id='nis' name='nis' placeholder='NIS'>
                            </div>

                            <div class='form-group col-sm-12'>
                                <label for='nisn'>NISN</label>
                                <input type='text' class='form-control' id='nisn' name='nisn' placeholder='NISN'>
                            </div>
                            
                            <div class='form-group col-sm-6' id="provinceFormGroup">
                                <label>Alamat Siswa</label>
                                <select id="provinceSelect" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                            
                            <div class='form-group col-sm-6' id="regencyFormGroup" style="display: none;">
                                <label class="text-muted">Kota</label>
                                <select id="regencySelect" class="form-control">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-6' id="districtFormGroup" style="display: none;">
                                <label class="text-muted">Kecamatan</label>
                                <select id="districtSelect" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                            <div class='form-group col-sm-6' id="villageFormGroup" style="display: none;">
                                <label class="text-muted">Kelurahan</label>
                                <select id="villageSelect" class="form-control">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-12 row">
                              <div class='form-group col-sm-6'>
                                  <label for='status_data'>Status Data</label>
                                  <select class='form-control' id='status_data' name='status_data'>
                                      <option value='Aktif'>Aktif</option>
                                      <option value='Tidak Aktif'>Tidak Aktif</option>
                                  </select>
                              </div>
                            </div>
                            
                            <div class='form-group col-sm-12 mt-3'>
                                <button type='submit' class='btn btn-success' name='submit'><i class="fas fa-arrow-right"></i> Submit</button>
                                <button type='reset' class='btn btn-secondary' name='reset'><i class="fas fa-reload"></i> Reset</button>
                            </div>
                        </form>
                    </div>
                    <button id="printAlamat">print alamat</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection