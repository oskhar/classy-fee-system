@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')

  {{-- @include('depedensi.admin.data_pembayaran_spp.read') --}}

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
        
					<div class='row'><div class='col-md-12'><div class='callout callout-success'><p class='text-secondary'>Data Pembayaran SPP</p></div></div><div class='col-md-12'><div class='card'><div class='card-body'>
                        <button type='button' class='btn btn-outline-info btn-md mb-2' onclick=window.location.href="{{ route('admin.data_pembayaran_spp_create') }}">
                            Tambah Data
                        </button>
                    
                        <button type='button' class='btn btn-outline-info btn-md mb-2'>
                            Import Data
                        </button>
                    
                        <button type='button' class='btn btn-outline-info btn-md mb-2'>
                            Export Data
                        </button>
                    <table class='table table-bordered table-hover'><thead><tr><th>NIS</th><th>Nama Siswa</th><th>Total Pembayaran</th><th>Total Tagihan</th><th>Aksi</th></tr></thead><tbody><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr><tr><td>1114091000101</td><td>Aryajaya Alamsyah</td><td>Rp. 10.000.000,-</td><td>Rp. 0,-</td><td>
                                            <a href='?page=pembayaran-spp&act=lihat-data'>
                                                <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                            </a>
                                        </td></tr></tbody></table></div><div class='card-footer'><small>Last updated data on 2023-01-01, 20:30 WIB</small></div></div></div></div>
    </div>
</section>
@endsection