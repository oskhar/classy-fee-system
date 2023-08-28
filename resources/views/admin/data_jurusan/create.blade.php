@extends('layout.template_admin')

@section('title', 'Tambah data jurusan')
@section('mainContent')

@include('depedensi.admin.data_jurusan.create')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Data jurusan SMK Triguna Utama</p>
                </div>
            </div>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data' class="row" id="form-tambah-jurusan">
                            @csrf
                            <div class='form-group col-sm-12'>
                                <label for='nama_jurusan'>Nama jurusan</label>
                                <input type='text' class='form-control' id='nama_jurusan' name='nama_jurusan' placeholder='Nama Jurusan'>
                            </div>

                            <div class='form-group col-sm-4'>
                                <label for='singkatan'>Singkatan nama jurusan</label>
                                <input type='text' class='form-control' id='singkatan' name='singkatan' placeholder='Singkatan Nama Jurusan'>
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