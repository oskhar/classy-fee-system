@extends('layout.template_siswa')

@section('title', 'Kelola data kelas')
@section('mainContent')


<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Rekap Hasil Belajar</h1>
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
      <div class="container">
            <div class='callout callout-success'>
                <p class='text-secondary'>Rekap Hasil Belajar</p>
            </div>
        <div class="card row card-primary">
            <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Kelas X</button>
            <button class="nav-link" id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Kelas XI</button>
            <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Kelas XII</button>
            </div>
        </nav>
        <button class="btn btn-outline-primary my-3">Download PDF</button>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class='table table-bordered table-hover'>
                    <thead>
                        <th>
                            <td>Kode Mapel</td>
                            <td>Nama Mapel</td>
                            <td>Nilai</td>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kode Mapel</td>
                            <td>Nama Mapel</td>
                            <td>Nilai</td>
                        </tr>
                        <tr>
                            <td>Kode Mapel</td>
                            <td>Nama Mapel</td>
                            <td>Nilai</td>
                        </tr>
                        <tr>
                            <td>Kode Mapel</td>
                            <td>Nama Mapel</td>
                            <td>Nilai</td>
                        </tr>
                        <tr>
                            <td>Kode Mapel</td>
                            <td>Nama Mapel</td>
                            <td>Nilai</td>
                        </tr>
                    </tbody>
                </table></div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
        </div>
    </div>
        </div>
      </div>
  </section>
  
@endsection