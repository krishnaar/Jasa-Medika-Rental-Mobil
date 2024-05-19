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

				<form id="RegisterValidation" action="{{ route('admin.car.store') }}" enctype="multipart/form-data" method="POST">
					@csrf
					<div class="card ">
						<div class="card-header card-header-rose card-header-icon">
							<div class="card-icon">
								<i class="material-icons">library_add</i>
							</div>
							<h4 class="card-title">Tambah @yield('title')</h4>
						</div>
						<div class="card-body ">
							<div class="form-check">
								 <div class="col-md-4 col-sm-4">
									<h4 class="title">Pilih Gambar</h4>
									<div class="fileinput fileinput-new text-center" data-provides="fileinput">
										<div class="fileinput-new thumbnail">
										<img src="{{ asset('assets/backend') }}/img/image_placeholder.jpg" alt="...">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail"></div>
										<div>
										<span class="btn btn-rose btn-round btn-file">
											<span class="fileinput-new">Pilih Gambar</span>
											<span class="fileinput-exists">Ubah</span>
											<input type="file" name="file" />
										</span>
										<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
										</div>
									</div>
									</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Merek *</label>
									<input type="text" class="form-control" name="merk" id="exampleEmail" required="true">
								</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Model *</label>
									<input type="text" class="form-control" name="model" id="exampleEmail" required="true">
								</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Nomer Plat *</label>
									<input type="text" class="form-control" name="plat" id="exampleEmail" required="true">
								</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Tarif per Hari *</label>
									<input type="number" class="form-control" name="rate" id="exampleEmail" required="true">
								</div>
								
								
							</div>
							<div class="category form-category">* Required fields</div>
						</div>
						<div class="card-footer text-right">
							<button type="submit" id="submit" class="btn btn-rose">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
	
@endpush