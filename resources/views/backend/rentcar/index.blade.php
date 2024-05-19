@extends('backend.layout.master')


@push('css')
	<style>
	.bootstrap-select{
		width: 100% !important;
		max-width: 100% !important;
	}
	.bootstrap-select{
		width: 100% !important;
		max-width: 100% !important;
	}
</style>	
@endpush

@section('title', "Rental Mobil")
	

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
						<h4 class="card-title">List @yield('title')</h4>
						<div class="float-right">
						</div>
						<br>
					</div>
					<div class="card-body">
						<div class="material-datatables">
							<table id="datatables" data-form="deleteForm" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Peminjam</th>
										<th>Mobil</th>
										<th>Nomer Plat</th>
										<th>Dari Tanggal</th>
										<th>Sampai Tanggal</th>
										<th>Status Sewa</th>
										<th>Tanggal Pengembalian</th>
										<th>Tarif Sewa (Total)</th>
										<th class="disabled-sorting">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($rent as $key => $data)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $data->user->name }}</td>
										<td>{{ $data->car->merk }} {{ $data->car->model }}</td>
										<td>{{ $data->car->plat }}</td>
										<td>{{ $data->from_date }}</td>
										<td>{{ $data->to_date }}</td>
										<td>{{ $data->status }}</td>
										<td>{{ $data->return_date }}</td>
										<td>{{ number_format($data->fee) }}</td>
										<td class="text-right">
											<div class="row">
												<a data-href="{{ route('admin.rentcar.update',$data->id) }}" id="status" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">list</i></a>
											
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
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
@include('backend.layout.partials.modal.delete')
@include('backend.rentcar.modal.status')
@endsection


@push('js')
	 <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
	<script src="{{ asset('assets') }}/js/plugins/jquery.dataTables.min.js"></script>
	<script>
    $(document).ready(function() {
      $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search records",
        }
      });

      var table = $('#datatable').DataTable();
	  
        $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e) {
            e.preventDefault();
            var $form = $(this);
            $('#confirm').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .on('click', '#delete-btn', function() {
                    $form.submit();
                });
        });
    });
  </script>
    <script>
          $(document).ready(function() {

              $(document).on('click', '#status', function(e) {
                  var url = $(this).attr('data-href');
                  $('#status_url').attr('action', url);
                  $('#status_modal').show();
                  e.preventDefault();
              });

          });
      </script>
@endpush