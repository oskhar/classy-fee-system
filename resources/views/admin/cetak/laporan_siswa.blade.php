@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

@include('depedensi.admin.cetak.laporan_siswa')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Cetak laporan Siswa & Wali Siswa</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data'>
                            @csrf
                            <h3>Pilih data yang ingin dicetak</h3>

                            <div class='form-group'>
                                <label for='idTahunAjar'>Tahun ajar</label>
                                <select required class="form-control" name="idTahunAjar" id="idTahunAjar">
                                    <option value="" disabled>Pilih tahun ajar</option>
                                </select>
                            </div>

                            <div class='form-group'>
                                <label for='idKelas'>Nama Kelas</label>
                                <select required class="form-control" name="idKelas" id="idKelas">
                                    <option value="" disabled>Pilih kelas</option>
                                </select>
                            </div>

                            <div class='form-group'>
                                <label for='idSiswa'>Nama Siswa</label>
                                <select required class="form-control" name="idSiswa" id="idSiswa">
                                    <option value="" disabled>Pilih siswa</option>
                                </select>
                            </div>

                            <button class="btn btn-outline-primary">
                                <i class="nav-icon fa-solid fa-print"></i>
                                Cetak Laporan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection