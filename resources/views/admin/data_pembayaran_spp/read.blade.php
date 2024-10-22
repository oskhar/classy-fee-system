@extends('layout.template_admin')

@section('title', 'Halaman Dashboard')
@section('mainContent')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <b>Data Pembayaran SPP</b>
                </div></div><div class='col-md-12'><div class='card'><div class='card-body'>
                        <button type='button' class='btn btn-outline-info btn-md mb-2' onclick=window.location.href="{{ route('admin.data_pembayaran_spp_create') }}">
                            Tambah Data
                        </button>
                    
                        <button type='button' class='btn btn-outline-info btn-md mb-2'>
                            Import Data
                        </button>
                    
                        <button type='button' class='btn btn-outline-info btn-md mb-2'>
                            Export Data
                        </button>
                    <table class='table table-bordered table-hover'>
                        <thead>
                            
                            <tr>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Total Pembayaran</th>
                                <th>Total Tagihan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>1114091000101</td>
                                <td>Aryajaya Alamsyah</td>
                                <td>Rp. 10.000.000,-</td>
                                <td>Rp. 0,-</td>
                                <td>
                                    <a href='?page=pembayaran-spp&act=lihat-data'>
                                        <button type='button' class='btn btn-outline-info btn-sm'>Rincian</button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='card-footer'>
                    <small>Last updated data on 2023-01-01, 20:30 WIB</small>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection