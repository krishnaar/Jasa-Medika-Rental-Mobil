@extends('backend.layout.master')


@push('css')
		
@endpush

@section('title', "Mobil")
	

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
	            @include('backend.layout.partials.flash')

				<div class="card">
					<div class="card-header card-header-primary card-header-icon">
						<div class="card-icon">
							<i class="material-icons">assignment</i>
						</div>
						<h4 class="card-title">Detail @yield('title')</h4>
						<div class="float-right">
							<button  id="rent" {{ $status == "Tidak Tersedia" ? 'disabled' : '' }} class="btn btn-primary">Sewa mobil ini</button>
						</div>
						<br>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3">
								@if (!empty($car->image))
								<img src="{{ asset('uploads/car') }}/{{ $car->image }}" width="300px" alt="...">
								@else
								<img src="{{ asset('assets/backend') }}/img/image_placeholder.jpg" width="300px" alt="...">
								@endif
							</div>
							<div class="col-md-9">
								<div class="row  mb-2">
									<div class="col-md-3">
										<b>

											Merek
										</b>
									</div>
									<div class="col-md-9">
										: {{ $car->merk }}
									</div>
								</div>
								<div class="row  mb-2">
									<div class="col-md-3">
										<b>

											Model
										</b>
									</div>
									<div class="col-md-9">
										: {{ $car->model }}
									</div>
								</div>
								<div class="row  mb-2">
									<div class="col-md-3">
										<b>

											Plat Nomor
										</b>
									</div>
									<div class="col-md-9">
										: {{ $car->plat }}
									</div>
								</div>
								<div class="row  mb-2">
									<div class="col-md-3">
										<b>

											Tarif Sewa
										</b>
									</div>
									<div class="col-md-9">
										: {{ number_format($car->rate) }}
									</div>
								</div>
								<div class="row  mb-2">
									<div class="col-md-3">
										<b>

											Status
										</b>
									</div>
									<div class="col-md-9">
										: {{ $status }}
									</div>
								</div>
								@if ($status == "Tidak Tersedia")
									
									<div class="row  mb-2">
										<div class="col-md-3">
											<b>

												Tersedia kembali pada
											</b>
										</div>
										<div class="col-md-9">
											: {{ $car->rent[0]->to_date }}
										</div>
									</div>
								@endif
							</div>
						</div>
						
					</div>
					<!-- end content-->
				</div>
				<!--  end card  -->
			</div>
			<!-- end col-md-12 -->
		</div>
		<!-- end row -->
	</div>
</div>
@include('backend.car.modal.rent')

@endsection


@push('js')
	 <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
	<script>
		$(document).ready(function() {


			$(document).on('click', '#rent', function(e) {
				

				$('#rent_modal').modal('show');
				e.preventDefault();
			});

		});
		</script>
		<script>
		

			function formatRupiah(angka, prefix) {
				 var number_string = angka.toString().replace(/[^.\d]/g, ""),
				split = number_string.split("."),
				sisa = split[0].length % 3,
				rupiah = split[0].substr(0, sisa),
				ribuan = split[0].substr(sisa).match(/\d{3}/gi);
				
				// tambahkan titik jika yang di input sudah menjadi angka ribuan
				if (ribuan) {
					separator = sisa ? "," : "";
					rupiah += separator + ribuan.join(",");
				}
				
				rupiah = split[1] != undefined ? rupiah + "." + split[1] : rupiah;
				console.log('ini:' + number_string);
				return prefix == undefined ? rupiah : "";
			}
		</script>
		<script>
			  $(document).on('change', '#from_date', function(e) {
				// alert($(this).val())
				if ($('#end_date').val()) {
					
					var start 	  = new Date($(this).val()),
						end   	  = new Date($('#end_date').val()),
						diff  	  = new Date(end - start),
						days 	  = diff/1000/60/60/24;
						total_fee = {{ $car->rate }} * (days + 1)
					
					$('#total_fee').val(formatRupiah(total_fee))
				}
               
            });
			  $(document).on('change', '#end_date', function(e) {
				// alert($(this).val())
				if ($('#from_date').val()) {
					
					var start 	  = new Date($('#from_date').val()),
						end   	  = new Date($(this).val()),
						diff  	  = new Date(end - start),
						days 	  = diff/1000/60/60/24;
						total_fee = {{ $car->rate }} * (days + 1)
					
					$('#total_fee').val(formatRupiah(total_fee))
				}
               
            });
		</script>
@endpush