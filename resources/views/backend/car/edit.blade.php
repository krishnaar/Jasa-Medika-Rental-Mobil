@extends('backend.layout.master')


@push('css')
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
	<link href="{{ asset('assets/backend') }}/css/partials/cust_select.css" rel="stylesheet" />
		
@endpush

@section('title', "Mobil")

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
	            @include('backend.layout.partials.flash')

				<form id="RegisterValidation" action="{{ route('admin.car.update', $car->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
					<div class="card ">
						<div class="card-header card-header-rose card-header-icon">
							<div class="card-icon">
								<i class="material-icons">edit</i>
							</div>
							<h4 class="card-title">Edit @yield('title')</h4>
						</div>
						<div class="card-body ">
							
							<div class="form-check">
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Merek *</label>
									<input type="text" class="form-control" name="merk" value="{{ $car->merk }}" id="exampleEmail" required="true">
								</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Model *</label>
									<input type="text" class="form-control" name="model" value="{{ $car->model }}" id="exampleEmail" required="true">
								</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Nomer Plat *</label>
									<input type="text" class="form-control" name="plat" value="{{ $car->plat }}" id="exampleEmail" required="true">
								</div>
								<div class="form-group">
									<label for="exampleEmail" class="bmd-label-floating"> Tarif per Hari *</label>
									<input type="number" class="form-control" name="rate" value="{{ $car->rate }}" id="exampleEmail" required="true">
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
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
	<script>
		$(document).ready( function() {
			$('.summernote').summernote({
			height: 300,
			});
			$('.note-summernote').change(function (){
				var textareaValue = $('#summernote').summernote('code');
			});
			
			$("#summernote-description .note-codable").attr( "name", "description" );
			
			$( '#submit' ).click( function(e) {
		// e.preventDefault();
				$('#summernote-description .note-codable').html($('#summernote-description .note-editable').html());
				// console.log($(this).serialize());

			});
		});
	</script>
@endpush