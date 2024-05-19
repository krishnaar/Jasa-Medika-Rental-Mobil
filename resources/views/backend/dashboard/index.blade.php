@extends('backend.layout.master')

@section('title', "Dashboard")

@section('content')

<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-warning card-header-icon">
						<div class="card-icon">
							<i class="material-icons">people</i>
						</div>
						<p class="card-category">Jumlah pengguna</p>
						<h3 class="card-title">{{ count($user) }}</h3>
					</div>
					<div class="card-footer">
						
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-rose card-header-icon">
						<div class="card-icon">
							<i class="material-icons">directions_car</i>
						</div>
						<p class="card-category">Jumlah Mobile</p>
						<h3 class="card-title">{{ count($car) }}</h3>
					</div>
					<div class="card-footer">
						
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-success card-header-icon">
						<div class="card-icon">
							<i class="material-icons">no_crash</i>
						</div>
						<p class="card-category">Jumlah Mobil dirental</p>
						<h3 class="card-title">{{ count($rent) }}</h3>
					</div>
					<div class="card-footer">
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="card card-stats">
					<div class="card-header card-header-info card-header-icon">
						<div class="card-icon">
							<i class="material-icons">paid</i>
						</div>
						<p class="card-category">Total Pendapatan</p>
						<h3 class="card-title">{{ number_format($rent->sum('fee')) }}</h3>
					</div>
					<div class="card-footer">
						
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
