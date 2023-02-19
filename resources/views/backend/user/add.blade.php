@extends('layouts.backend.master')

@section('css')
	<link rel='stylesheet prefetch' href='https://foliotek.github.io/Croppie/croppie.css'>
 	<style type="text/css">
 		#cropImagePop .modal-body {
 			height: 400px;
 		}
 		#cropImagePop .modal-content{
 			width: 400px;
 		}
 	</style>
@endsection

@section('popup')
	<!-- CROP MODAL -->
	<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
				  	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  	<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
		            <div id="upload-demo" class="center-block"></div>
		      	</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="cropImageBtn" class="btn btn-primary">Crop</button>
				</div>
			</div>
		</div>
	</div>
	<!-- CROP MODAL OVER -->
@endsection

@section('content')
		<div class="app-page-title app-page-title-simple">
			<div class="page-title-wrapper">
				<div class="page-title-heading">
					<div>
						<div class="page-title-head center-elem">
							<span class="d-inline-block pr-2"><i class="lnr-apartment opacity-6"></i></span>
							<span class="d-inline-block">{{ trans('user.create') }}</span>
						</div>
					</div>
				</div>
				<div class="page-title-actions">
					<div class="page-title-subheading opacity-10">
						<nav class="" aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a><i aria-hidden="true" class="fa fa-home"></i></a></li>
								<li class="breadcrumb-item"> <a>{{ trans('user.plural') }}</a></li>
								<li class="active breadcrumb-item" aria-current="page">{{ trans('user.add') }}</li>
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
								<label for="name">{{ trans('user.name') }}</label>
								<input id="name" type="text" class="form-control" placeholder="{{ trans('user.placeholder.name') }}">
								<div class="validation-div" id="val-name"></div>
							</div>
						</div>
					</div>
					<div class="form-row">
						
						<div class="col-md-3">
							<div class="position-relative form-group">
								<label for="mobile_number">{{ trans('user.mobile_number') }}</label>
								<input id="mobile_number" type="text" class="form-control" placeholder="{{ trans('user.placeholder.mobile_number') }}">
								<div class="validation-div" id="val-mobile_number"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="position-relative form-group">
								<label for="email">{{ trans('user.email') }}</label>
								<input id="email" type="text" class="form-control" placeholder="{{ trans('user.placeholder.email') }}">
								<div class="validation-div" id="val-email"></div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="position-relative form-group">
								<label for="password">{{ trans('user.password') }}</label>
								<input id="password" type="password" class="form-control" placeholder="{{ trans('user.placeholder.password') }}">
								<div class="validation-div" id="val-password"></div>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="outlet_id">{{ trans('user.outlet') }}</label>
								<select  class="form-control" id="outlet_id">
									<option value="">Select</option>
									@foreach ($outlet as $row)
									<option value="{{$row->id}}">{{$row->title}}</option>
									@endforeach
								</select>
								<div class="validation-div" id="val-outlet_id"></div>
							</div>
						</div>
					</div>
					
					<hr>
					<div class="form-row">
						<div class="col-md-6">
							<div class="position-relative form-group">
								<label for="exampleFile" class="">{{ trans('user.image') }}</label>
								<input name="file" id="image" type="file" class="form-control-file item-img" accept="image/*">
								<div class="validation-div" id="val-image"></div>
								<div class="image-preview"><img id="image-src" src="" width="100%"/></div>
								<input type="hidden" id="img-blob">
							</div>
						</div>
					</div>
					
					
					<hr>
					<div class="form-row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="email">{{ trans('user.user_type') }}</label>
								<select  class="form-control" id="user_type">
									<option value="Cashier">Cashier</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="position-relative form-group">
								<label for="status" class="">{{ trans('common.status') }}</label>
								<select  class="form-control" id="status">
								  <option value="active">{{trans('common.active')}}</option>
								  <option value="inactive">{{trans('common.inactive')}}</option>
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
<script src='https://foliotek.github.io/Croppie/croppie.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
	// CREATE
  	function saveData(){
		var data = new FormData();
		data.append('name', $('#formData #name').val());
		data.append('mobile_number', $('#formData #mobile_number').val());
		data.append('user_type', $('#formData #user_type').val());
		data.append('email', $('#formData #email').val());
		data.append('password', $('#formData #password').val());
		data.append('outlet_id', $('#formData #outlet_id').val());
		data.append('status', $('#formData #status').val());
		if(img_blob != undefined){
			data.append('image', img_blob);
		}
		
		var response = adminAjax('{{route("ajax_saveUser")}}', data);
		if(response.status == '200'){
			swal.fire({ type: 'success', title: response.message, showConfirmButton: false, timer: 1500 });
			setTimeout(function(){ window.location.href = '{{route("users.index")}}'; }, 2000)
			
		}else if(response.status == '422'){
			$('.validation-div').text('');
			$.each(response.error, function( index, value ) {
				$('#val-'+index).text(value);
			});
			
		} else if(response.status == '201'){
			swal.fire({title: response.message,type: 'error'});
		}
  	}
	
	
	// Start image cropping
	var img_blob;
	var $uploadCrop,
	tempFilename,
	rawImg,
	imageId;
	function readFile(input) {
			if (input.files && input.files[0]) {
	      var reader = new FileReader();
	        reader.onload = function (e) {
				$('.upload-demo').addClass('ready');
				$('#cropImagePop').modal('show');
	            rawImg = e.target.result;
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	    else {
	        swal("Sorry - you're browser doesn't support the FileReader API");
	    }
	}

	$uploadCrop = $('#upload-demo').croppie({
		viewport: {
			width: 400,
			height: 400,
		},
		enforceBoundary: false,
		enableExif: true
	});
	$('#cropImagePop').on('shown.bs.modal', function(){
		// alert('Shown pop');
		$uploadCrop.croppie('bind', {
			url: rawImg
		}).then(function(){
			console.log('jQuery bind complete');
		});
	});

	$('.item-img').on('change', function () { 
		imageId = $(this).data('id'); 
		tempFilename = $(this).val();
		$('#cancelCropBtn').data('id', imageId); readFile(this); 
	});
	$('#cropImageBtn').on('click', function (ev) {
		$uploadCrop.croppie('result', {
			type: 'blob',
			format: 'jpeg',
			size: {width: 200, height: 200}
		}).then(function (resp) {
			img_blob = resp;
			$('#image-src').attr('src', URL.createObjectURL(resp, { oneTimeOnly: true }));
			$('#cropImagePop').modal('hide');
		});
	});
	// End image cropping
</script>
@endsection