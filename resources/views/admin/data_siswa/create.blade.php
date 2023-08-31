@extends('layout.template_admin')

@section('title', 'Tambah data siswa')
@section('mainContent')

  @include('depedensi.admin.data_siswa_create')
  <div>
      <select id="provinceSelect">
          <option value="">Pilih Provinsi</option>
      </select>
      <select id="regencySelect" style="display: none;">
          <option value="">Pilih Kota/Kabupaten</option>
      </select>
      <select id="districtSelect" style="display: none;">
          <option value="">Pilih Kecamatan</option>
      </select>
      <select id="villageSelect" style="display: none;">
          <option value="">Pilih Kelurahan/Desa</option>
      </select>
  </div>

@endsection