@extends('layout.template_admin')

@section('title', 'Tambah data siswa')
@section('mainContent')

  @include('depedensi.admin.data_siswa.update')
  <section class="content">
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
                        <form method='POST' enctype='multipart/form-data' class="row" id="form-ubah-siswa">
                            @csrf
                            <h3>Input Data Siswa</h3>
                            <div class='form-group col-sm-12'>
                                <label for='nama_siswa'>Nama Siswa</label>
                                <input type='text' class='form-control' id='nama_siswa' name='nama_siswa' placeholder='Nama Siswa'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='nis'>NIS</label>
                                <input type='text' class='form-control' id='nis' name='nis' placeholder='NIS'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='nisn'>NISN</label>
                                <input type='text' class='form-control' id='nisn' name='nisn' placeholder='NISN'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='agama'>Agama</label>
                                <select id="agama" class="form-control">
                                    <option value="" selected disabled>Pilih Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='tempat_lahir'>Tempat Lahir</label>
                                <input type='text' class='form-control' id='tempat_lahir' name='tempat_lahir' placeholder='tempat_lahir'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='tanggal_lahir'>Tanggal Lahir</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                </div>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='jenis_kelamin'>Jenis Kelamin</label>
                                <select id="jenis_kelamin" class="form-control">
                                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki Laki">Laki Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            
                            <div class='form-group col-sm-6' id="provinceFormGroup">
                                <label>Provinsi</label>
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

                            <div class='form-group col-sm-12' id="detailFormGroup" style="display: none;">
                                <label for='detailAlamat' class="text-muted">Alamat Siswa</label>
                                <input type='text' class='form-control' id='detailAlamat' name='detailAlamat' placeholder='Detail Alamat'>
                            </div>

                            <h3 class="col-sm-12 text-left mt-4">Input Data Wali Siswa</h3>

                            <div class='form-group col-sm-6'>
                                <label for='nama_ayah'>Nama Ayah</label>
                                <input type='text' class='form-control' id='nama_ayah' name='nama_ayah' placeholder='nama_ayah'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='pekerjaan_ayah'>Pekerjaan Ayah</label>
                                <input type='text' class='form-control' id='pekerjaan_ayah' name='pekerjaan_ayah' placeholder='pekerjaan_ayah'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='penghasilan_ayah'>Penghasilan Ayah</label>
                                <input type='number' class='form-control' id='penghasilan_ayah' name='penghasilan_ayah' placeholder='penghasilan_ayah'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='nama_ibu'>Nama Ibu</label>
                                <input type='text' class='form-control' id='nama_ibu' name='nama_ibu' placeholder='nama_ibu'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='pekerjaan_ibu'>Pekerjaan Ibu</label>
                                <input type='text' class='form-control' id='pekerjaan_ibu' name='pekerjaan_ibu' placeholder='pekerjaan_ibu'>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='penghasilan_ibu'>Penghasilan Ibu</label>
                                <input type='number' class='form-control' id='penghasilan_ibu' name='penghasilan_ibu' placeholder='penghasilan_ibu'>
                            </div>

                            <!-- text input -->
                            <div class="form-group col-sm-6">
                                <label for="telp_rumah">No telepon rumah</label>
        
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><strong>+62</strong></span>
                                    </div>
                                    <input type="text" class="form-control" data-inputmask="'mask': ['999-9999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="" inputmode="text" placeholder="___-___-____ " id="telp_rumah" name="telp_rumah">
                                </div>
                                <!-- /.input group -->
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
                </div>
            </div>
        </div>
    </div>
</section>
@endsection