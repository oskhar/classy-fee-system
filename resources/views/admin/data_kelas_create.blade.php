@extends('layout.template_admin')

@section('title', 'Tambah data kelas')
@section('mainContent')

@include('depedensi.admin.data_kelas_create')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Data Jurusan SMK Triguna Utama</p>
                </div>
            </div>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data'>
                            @csrf
                            <div class='form-group'>
                                <label for='txt_nama_jurusan'>Nama jurusan</label>
                                <input type='text' class='form-control' id='txt_nama_jurusan' name='txt_nama_jurusan' placeholder='Nama Jurusan'>
                            </div>

                            <div class='form-group'>
                                <label for='txt_singkatan'>Singkatan</label>
                                <input type='text' class='form-control' id='txt_singkatan' name='txt_singkatan' placeholder='Singkatan'>
                            </div>

                            <div class='form-group'>
                                <label for='cb_status_data'>Status Data</label>
                                <select class='form-control' id='cb_status_data' name='cb_status_data'>
                                    <option value='Aktif'>Aktif</option>
                                    <option value='Tidak Aktif'>Tidak Aktif</option>
                                </select>
                            </div>

                            <div class='form-group'>
                                <button type='submit' class='btn btn-success' name='submit'>Submit</button>
                                <button type='reset' class='btn btn-danger' name='reset'>Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>	
</section>
@endsection