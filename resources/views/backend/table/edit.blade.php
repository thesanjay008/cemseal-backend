@extends('layouts.backend.master')
@section('content')
		<div class="app-page-title app-page-title-simple">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div>
						<div class="page-title-head center-elem">
							<span class="d-inline-block pr-2"><i class="lnr-apartment opacity-6"></i></span>
							<span class="d-inline-block">{{ trans('table.edit') }}</span>
						</div>
					</div>
				</div>
				<div class="page-title-actions">
					<div class="page-title-subheading opacity-10">
						<nav class="" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a><i aria-hidden="true" class="fa fa-home"></i></a></li>
								<li class="breadcrumb-item"> <a>{{ trans('table.plural') }}</a></li>
								<li class="active breadcrumb-item" aria-current="page">{{ trans('table.edit') }}</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<!-- CONTENT START -->
		<div class="main-card mb-3 card">
			<div class="card-body">
				<!-- <h5 class="card-title">Grid Rows</h5> -->
				<form id="formData" action="javascript:void(0);" onsubmit="saveData();">
					<div class="form-row">
						<div class="col-md-4">
							<div class="position-relative form-group">
								<label for="title">{{ trans('table.title') }}</label>
								<input id="title" type="text" class="form-control" value="{{$data->translate('en')->title}}" placeholder="{{ trans('table.placeholder.title') }}">
								<div class="validation-div" id="val-title"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="table_number">{{ trans('table.table_number') }}</label>
								<input id="table_number" type="text" class="form-control" value="{{$data->table_number}}" placeholder="{{ trans('table.placeholder.table_number') }}">
								<div class="validation-div" id="val-table_number"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="outlet_id">{{ trans('user.outlet') }}</label>
								<select  class="form-control" id="outlet_id">
									<option value="">Select</option>
									@foreach ($outlet as $row)
									<option value='{{$row->id}}' 
										@if($data->outlet_id ==  $row->id) selected @endif>
										{{$row->title}}
									</option>
									@endforeach
								</select>
								<div class="validation-div" id="val-outlet_id"></div>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="status" class="">{{ trans('common.status') }}</label>
								<select class="form-control" id="status">
									<option value="Active" @if($data->status == 'Active') selected @endif>Active</option>
									<option value="Inactive" @if($data->status == 'Inactive') selected @endif>Inactive</option>
								</select>
								<div class="validation-div" id="val-status"></div>
							</div>
						</div>
					</div>
	  				<button class="mt-2 btn btn-primary">{{ trans('common.submit') }}</button>
				</form>
			</div>
		</div>
		<!-- CONTENT OVER -->
@endsection

@section('js')
<script>
  	// CREATE
  	function saveData(){
		var data = new FormData();
		data.append('item_id', '{{$data->id}}');
		data.append('title', $('#formData #title').val());
		data.append('table_number', $('#formData #table_number').val());
		data.append('outlet_id', $('#formData #outlet_id').val());
		data.append('status', $('#formData #status').val());
		
		var response = adminAjax('{{route("ajax_saveTable")}}', data);
		if(response.status == '200'){
			swal.fire({ type: 'success', title: response.message, showConfirmButton: false, timer: 1500 });
			setTimeout(function(){ location.reload(); }, 2000)
			
		}else if(response.status == '422'){
			$('.validation-div').text('');
			$.each(response.error, function( index, value ) {
				$('#val-'+index).text(value);
			});
			
		} else if(response.status == '201'){
			swal.fire({title: response.message,type: 'error'});
		}
  	}
</script>
@endsection