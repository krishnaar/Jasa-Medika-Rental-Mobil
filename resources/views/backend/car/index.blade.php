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
						<h4 class="card-title">List @yield('title')</h4>
						<div class="float-right">
							@if (Auth::user()->role->id == 1)
							<a href="{{ route('admin.car.create') }}" class="btn btn-primary">Tambah</a>
							@endif
						</div>
						<br>
					</div>
					<div class="card-body">
						<div class="material-datatables">
							<table id="datatables" data-form="deleteForm" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
								<thead>
									<tr>
										<th>No</th>
										<th>Merek</th>
										<th>Model</th>
										<th>Nomer Plat</th>
										<th>Tarif Sewa (per hari)</th>
										<th class="disabled-sorting">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($car as $key => $data)
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $data->merk }}</td>
										<td>{{ $data->model }}</td>
										<td>{{ $data->plat }}</td>
										<td>{{ number_format($data->rate) }}</td>
										<td class="text-right">
											<div class="row">
												@if (Auth::user()->role->id == 1)
													<a href="{{ route('admin.car.edit',$data->id) }}" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">edit</i></a>
													<a href="{{ route(Auth::user()->role->name.'.car.detail',$data->id) }}" class="btn btn-link btn-success btn-just-icon like"><i class="material-icons">visibility</i></a>
													<form action="{{ route('admin.car.destroy',$data->id) }}" class="form-delete" method="POST">
														@csrf
														@method("DELETE")
														<button type="submit" class="btn btn-link btn-danger btn-just-icon remove " name="delete_modal"><i class="material-icons">delete</i></button>
													</form>
												@else
													<a href="{{ route(Auth::user()->role->name.'.car.detail',$data->id) }}" class="btn btn-link btn-success btn-just-icon like"><i class="material-icons">visibility</i></a>

												@endif
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
@endpush