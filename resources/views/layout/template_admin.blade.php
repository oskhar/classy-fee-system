<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="{{ asset('images/smk3gu0ke.png') }}" type="image/x-icon">
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@include('depedensi.layout.template_admin')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	{{-- @include('components.loading') --}}
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Home / Main Dashboard</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" data-widget="fullscreen" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- sidebar logo -->
				<div class="user-panel mt-3 mb-3 pb-3 d-flex">
					<div class="image">
						<img src="{{ asset('images/smk3gu0ke.png') }}" alt="AdminLTE Logo" class="img-circle elevation-2" style="opacity: .8">
					</div>
					<div class="info">
						<a href="{{url('admin')}}" class="d-block">SMA-SMK Triguna Utama</a>
					</div>
				</div>
				<!-- sidebar logo -->

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						
						<!-- menu-Dashboard -->
						<li class="nav-item @if(strpos(request()->path(), 'admin/home-keuangan-sekolah') !== false)
							menu-open
						@endif">
							<a href="#" class="nav-link">
								<i class="nav-icon fa-solid fa-home"></i>
								<p>Main Dashboard<i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Dash. Guru & Karyawan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Dash. Siswa & Wali Siswa</p>
									</a>
								</li>
								<!-- li-main-dashboard -->
								<li class="nav-item">
									<a href="{{ route('admin.home_keuangan_sekolah') }}" class="nav-link 
										@if(request()->is('admin/home-keuangan-sekolah'))
											active
										@endif">
										<i class="nav-icon fas fa-minus"></i>
										<p>
											Dash. Keuangan Sekolah
										</p>
									</a>
								</li>
								<!-- ./li-main-dashboard -->
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Dash. Raport Siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Dash. Tabungan Siswa</p>
									</a>
								</li>
							</ul>
							<!-- /.nav nav-treeview -->
						</li>
						<!-- /. menu-Dashboard -->

						<!-- menu-master-siswa -->
						<li class="nav-item 
							@if(strpos(request()->path(), 'admin/data-siswa') !== false)
								menu-open
							@endif">
							<a href="#" class="nav-link 
								@if(strpos(request()->path(), 'admin/data-siswa') !== false)
									active
								@endif">
								<i class="nav-icon fas fa-user-graduate"></i>
								<p>Master Data Siswa<i class="fas fa-angle-left right"></i></p>
							</a>
							<!-- nav-tree-master-siswa -->
							<ul class="nav nav-treeview">

								<!-- data siswa -->
								<li class="nav-item">
									<a href="{{ route('admin.data_siswa') }}" class="nav-link 
										@if(strpos(request()->path(), 'admin/data-siswa') !== false)
											active
										@endif">
										<i class="fas fa-minus nav-icon"></i>
										<p>Data Siswa & Wali Siswa</p>
									</a>
								</li>
								<!-- /.data jurusan -->

								<!-- data kelas -->
								<li class="nav-item">
									<a href="{{ route('admin.data_siswa_perkelas') }}" class="nav-link @if(strpos(request()->path(), 'admin/data-kelas') !== false)
											active
										@endif">
										<i class="fas fa-minus nav-icon"></i>
										<p>Data Siswa Perkelas</p>
									</a>
								</li>
							</ul>
							<!-- /.nav nav-treeview -->
						</li>
							<!-- nav-tree-pengaturan-sistem -->
						</li>
						<!-- ./menu-pengaturan-sistem -->

						<!-- menu guru & karyawan -->
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa-solid fa-user-graduate"></i>
								<p>Data Guru & Karyawan</p>
							</a>
						</li>
						<!-- /. menu guru & karyawan -->

						<!-- SI. Pembayaran SPP -->
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa-solid fa-money-check-dollar"></i>
								<p>Sis. Keuangan Sekolah<i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Jenis Pembayaran</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Transaksi Pembayaran</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="{{ route('admin.data_pembayaran_spp') }}" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Data Pembayaran SPP</p>
									</a>
								</li>
							</ul>

							<!-- /.nav nav-treeview -->
						</li>
						<!-- /. SI. Pembayaran SPP -->

						<!-- SI. Rapot Siswa -->
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa-solid fa-book"></i>
								<p>Sis. Raport Siswa<i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Menu ke-1</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Menu ke-1</p>
									</a>
								</li>
							</ul>
							<!-- /.nav nav-treeview -->
						</li>
						<!-- /. SI. Rapot Siswa -->

						<!-- SI. Tabungan Siswa -->
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa-solid fa-book"></i>
								<p>Sis. Tabungan Siswa<i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Data Rekening Siswa</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Buku Tabungan Siswa</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Transaksi Tarik Setor</p>
									</a>
								</li>
							</ul>
							<!-- /.nav nav-treeview -->
						</li>
						<!-- /. SI. Tabungan Siswa -->

						<!-- menu-laporan -->
						<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon fa-solid fa-print"></i>
								<p>Cetak Laporan<i class="fas fa-angle-left right"></i></p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Lap. Guru & Karyawan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="{{route('admin.cetak.laporan_siswa')}}" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Lap. Siswa & Wali Siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Lap. Pembayaran SPP</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Lap. Raport Siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Lap. Tabungan Siswa</p>
									</a>
								</li>
							</ul>
							<!-- /.nav nav-treeview -->
						</li>
						<!-- /. menu-laporan -->

						<!-- menu-pengaturan-sistem -->
						<li class="nav-item 
							@if(strpos(request()->path(), 'admin/data-tahun-ajar') !== false || strpos(request()->path(), 'admin/data-kelas') !== false || strpos(request()->path(), 'admin/data-jurusan') !== false )
								menu-open
							@endif">

							<!-- pengaturan sistem -->
							<a href="#" class="nav-link 
								@if(strpos(request()->path(), 'admin/data-tahun-ajar') !== false || strpos(request()->path(), 'admin/data-kelas') !== false || strpos(request()->path(), 'admin/data-jurusan') !== false )
									active
								@endif">
								<i class="nav-icon fas fa-gears"></i>
								<p>Pengaturan Sistem<i class="fas fa-angle-left right"></i></p>
							</a>
							<!-- /. pengaturan sistem -->

							<!-- nav-tree-pengaturan-sistem -->
							<ul class="nav nav-treeview">

								<li class="nav-item">
									<a href="{{ route('admin.data_jurusan') }}" class="nav-link
										@if(strpos(request()->path(), 'admin/data-jurusan') !== false)
											active
										@endif">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Data Jurusan</p>
									</a>
								</li>

								<li class="nav-item">
									<a href="{{ route('admin.data_kelas') }}" class="nav-link
										@if(strpos(request()->path(), 'admin/data-kelas') !== false)
											active
										@endif">
										<i class="fa-solid fa-minus nav-icon"></i>
										<p>Data kelas</p>
									</a>
								</li>

								<!-- data tahun ajar -->
								<li class="nav-item">
									<a href="{{ route('admin.data_tahun_ajar') }}" class="nav-link 
										@if(strpos(request()->path(), 'admin/data-tahun-ajar') !== false)
											active
										@endif">
										<i class="fas fa-minus nav-icon"></i>
										<p>Data Tahun Ajar</p>
									</a>
								</li>
								<!-- ./data tahun ajar -->

							</ul>
							<!-- nav-tree-pengaturan-sistem -->

						</li>
						<!-- ./menu-pengaturan-sistem -->

						<!-- li-keluar -->
						<li id="logout-admin" class="nav-item">
							<a class="nav-link">
								<i class="nav-icon fas fa-sign-out"></i>
								<p>Keluar</p>
							</a>
						</li>
						<!-- /. li-keluar -->

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper pt-4">
			@yield('mainContent')
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.2.0
			</div>
		</footer>

		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->
</body>

</html>