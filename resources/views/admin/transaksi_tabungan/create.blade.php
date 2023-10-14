@extends('layout.template_admin')

@section('title', 'Penambahan data transaksi siswa')
@section('mainContent')

@include('depedensi.admin.transaksi_tabungan.create')
<section class="content">
    <div class="container-fluid">
        <div class='row'>
            <div class='col-md-12'>
                <div class='callout callout-success'>
                    <p class='text-secondary'>Data buku transaksi SMK Triguna Utama</p>
                </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body row">
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
                </div>
              </div>
            </div>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='card-body'>
                        <form method='POST' enctype='multipart/form-data' class="row" id="form-transaksi-tabungan">
                            @csrf

                            <div class='form-group col-sm-12'>
                                <label for='nomor_rekening'>Pilih nomor rekening</label>
                                <select class="form-control select2" style="width: 100%;" id='nomor_rekening' name='nomor_rekening'>
                                    <option value="debit" selected disabled>nomor rekening</option>
                                </select>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='jenis_transaksi'>Pilih jenis pembayaran</label>
                                <select class="form-control select2" style="width: 100%;" id='jenis_transaksi' name='jenis_transaksi'>
                                    <option value="" selected disabled>jenis pembayaran</option>
                                    <option value="debit">pemasukan</option>
                                    <option value="kredit">pengeluaran</option>
                                </select>
                            </div>

                            <div class='form-group col-sm-6'>
                                <label for='nominal'>Nominal Saldo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type='number' min="5000" class='form-control' id='nominal' name='nominal' placeholder='000.-'>
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