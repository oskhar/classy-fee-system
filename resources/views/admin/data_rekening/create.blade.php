@extends('layout.template_admin')

@section('title', 'Pembukaan tabungan siswa')
@section('mainContent')

@include('depedensi.admin.data_rekening.create')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Data rekening SMK Triguna Utama</p>
                </div>
            </div>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data' class="row" id="form-tambah-rekening">
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
                            <div class='form-group col-sm-12'>
                                <label for='nis'>Pilih Siswa</label>
                                <select class='form-control' id='nis' name='nis'>
                                    <option value='' selected disabled>Tidak Ada Siswa</option>
                                </select>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='setoran_awal'>Saldo Awal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type='number' class='form-control' id='setoran_awal' name='setoran_awal' placeholder='000.-'>
                                </div>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='status_data'>Status Data</label>
                                <select class='form-control' id='status_data' name='status_data'>
                                    <option value='Aktif'>Aktif</option>
                                    <option value='Tidak Aktif'>Tidak Aktif</option>
                                </select>
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