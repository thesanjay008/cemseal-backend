@extends('layouts.backend.master')
@section('content')
		<div class="app-page-title app-page-title-simple">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div>
						<div class="page-title-head center-elem">
							<span class="d-inline-block pr-2"><i class="lnr-apartment opacity-6"></i></span>
							<span class="d-inline-block">{{ trans('banner.create') }}</span>
						</div>
					</div>
				</div>
				<div class="page-title-actions">
					<div class="page-title-subheading opacity-10">
						<nav class="" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a><i aria-hidden="true" class="fa fa-home"></i></a></li>
								<li class="breadcrumb-item"> <a>{{ trans('banner.plural') }}</a></li>
								<li class="active breadcrumb-item" aria-current="page">{{ trans('banner.add') }}</li>
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
								<label for="title">{{ trans('banner.title') }}</label>
								<input id="title" type="text" class="form-control" placeholder="{{ trans('banner.placeholder.title') }}">
								<div class="validation-div" id="val-title"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="sorting">{{ trans('banner.sorting') }}</label>
								<input id="sorting" type="text" class="form-control" placeholder="{{ trans('banner.placeholder.sorting') }}">
								<div class="validation-div" id="val-sorting"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="outlet_id">{{ trans('banner.outlet') }}</label>
								<select  class="form-control" id="outlet_id">
									<option value="">Select</option>
									@foreach ($outlet as $row)
									<option value="{{$row->id}}">{{$row->title}}</option>
									@endforeach
								</select>
								<div class="validation-div" id="val-outlet_id"></div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="type">{{ trans('banner.type') }}</label>
								<select  class="form-control" id="type">
								  <option value="Slider">Slider</option>
								  <option value="Order">Order Page</option>
								</select>
								<div class="validation-div" id="val-type"></div>
							</div>
						</div>
					</div>
					
					<div class="form-row">
						<div class="position-relative form-group">
							<label for="timimg">Time (in seconds)</label>
							<input id="timimg" type="number" class="form-control" placeholder="Enter Banner Timing">
							<div class="validation-div" id="val-timimg"></div>
						</div>
					</div>
					
					<hr>
					<div class="form-row">
						<div class="col-md-6">
							<div class="form-row">
								<div class="col-md-12">
									<div class="position-relative form-group">
										<label for="exampleFile" class="">{{ trans('product.image') }}</label>
										<input name="file" id="image" type="file" class="form-control-file item-img" accept=".png, .jpg, .jpeg, .mp4">
										<div class="validation-div" id="val-image"></div>
										<div class="image-preview"><img id="image-src" src="" width="100%"/></div>
										<input type="hidden" id="img-blob">
									</div>
									<span style="color:#848484;">(Width: <b>1920px</b> &nbsp; Height: <b>1080px</b>)</span>
								</div>
							</div>
						</div>
					</div>
					
					<hr>
					<div class="form-row">
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="status" class="">{{ trans('common.status') }}</label>
								<select  class="form-control" id="status">
								  <option value="Active">{{trans('common.active')}}</option>
								  <option value="Inactive">{{trans('common.inactive')}}</option>
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
	$(document).ready(function(e) {
		$("#image").change(function () {
			readURL(this);
		});
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				jQuery('#image-src').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
		
  	// CREATE
  	function saveData(){
		var data = new FormData();
		data.append('title', $('#title').val());
		data.append('outlet_id', $('#formData #outlet_id').val());
		data.append('sorting', $('#sorting').val());
		data.append('timimg', $('#formData #timimg').val());
		data.append('type', $('#formData #type').val());
		data.append('image', $('#image')[0].files[0]);
		data.append('status', $('#status').val());
		
		var response = adminAjax('{{route("ajax_saveBanner")}}', data);
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