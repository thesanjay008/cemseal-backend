@extends('layouts.backend.master')

@section('content')
				<div class="app-page-title app-page-title-simple">
					<div class="page-title-wrapper">
						<div class="page-title-heading">
							<div>
								<div class="page-title-head center-elem">
									<span class="d-inline-block pr-2"><i class="lnr-apartment opacity-6"></i></span>
									<span class="d-inline-block">User Management</span>
								</div>
							</div>
						</div>
						<div class="page-title-actions">
							<div class="page-title-subheading opacity-10">
								<nav class="" aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a><i aria-hidden="true" class="fa fa-home"></i></a></li>
										<li class="breadcrumb-item"> <a>Users</a></li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<!-- CONTENT START -->
				<div class="main-card mb-3 card">
					<div class="card-header-tab card-header">
						<div class="card-header-title font-size-lg text-capitalize font-weight-normal">User List</div>
						<div class="btn-actions-pane-right text-capitalize">
							<a class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm" href="{{ route('users.create') }}" > {{trans('common.add_new')}} </a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="mb-0 table table-striped">
								<thead>
									<tr>
									 <th>#</th>
									 <th>Name</th>
									 <th>Number</th>
									 <th>Outlet</th>
									 <th>Created at</th>
									 <th>{{ trans('common.status') }}</th>
									 <th>{{ trans('common.action') }}</th>
									</tr>
								</thead>
								<tbody id="data-list"></tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- CONTENT OVER -->
@endsection
@section('js')
<script>

	$(document).ready(function(e) {
		getData();

		$(document).on('change','.change_status',function(){
			var data = new FormData();
			data.append('status', $(this).val());
			data.append('id', $(this).attr('id'));
			var response = adminAjax('{{route("ajax_change_userStatus")}}', data);
			if(response.status == '200'){
				if(response.data.status == 'success'){
					swal.fire({ type: 'success', title: response.message, showConfirmButton: false, timer: 1500 });
					setTimeout(function(){ location.reload(); }, 2000)
				}
				else
				{

				}
			}
		});
		
	});
	// GET LIST
	function getData(){
		var data = new FormData();
		var response = adminAjax('{{route("ajax_user_list")}}', data);
		if(response.status == '200'){
			if(response.data.length > 0){
				var htmlData = '';
				$.each(response.data, function( index, value ) {
					htmlData+= '<tr>'+
							'<th scope="row">'+ value.id +'</th>'+
							'<td>'+ value.name +'</td>'+
							'<td>'+ value.mobile_number +'</td>'+
							'<td>'+ value.outlet +'</td>'+
							'<td>'+ value.created_at +'</td>'+
							'<td>'+ value.status +'</td>'+
							'<td>'+ value.action +'</td>'+
						'</tr>';
				})
				$('#data-list').html(htmlData);
			}
		}
	}
	
	// DELETE
	function deleteThis(item_id = ''){
		if (confirm("Are you sure to delete this record?")) {
			var data = new FormData();
			data.append('item_id', item_id);
			var response = adminAjax('{{route("ajax_delete_user")}}', data);
			if(response.status == '200'){
				swal.fire({ type: 'success', title: response.message, showConfirmButton: false, timer: 1500 });
				setTimeout(function(){ location.reload(); }, 2000)

			}else if(response.status == '422'){
					$('.validation-div').text('');
					$.each(response.error, function( index, value ) {
						$('#val-'+index).text(value);
					});
					
			}else if(response.status == '201'){
				$('.validation-div').text('');
				swal.fire({title: response.message,type: 'error'});
			}
		}
	}
</script>
@endsection