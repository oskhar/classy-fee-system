@extends('layout.template_admin')

@section('title', 'Tambah data tahun_ajar')
@section('mainContent')

@include('depedensi.admin.data_tahun_ajar.create')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Data tahun ajar SMK Triguna Utama</p>
                </div>
            </div>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data' class="row" id="form-tambah-tahun-ajar">
                            @csrf
                            <div class='form-group col-sm-12'>
                                <label for='nama_tahun_ajar'>Nama tahun</label>
                                <input type='text' class='form-control' id='nama_tahun_ajar' name='nama_tahun_ajar' placeholder='Nama Jurusan'>
                            </div>

                            <div class='form-group col-sm-4'>
                                <label for='semester'>Semester</label>
                                <select class='form-control' id='semester' name='semester'>
                                    <option value='Ganjil'>Ganjil</option>
                                    <option value='Genap'>Genap</option>
                                </select>
                            </div>

                            <div class='form-group col-sm-4'>
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