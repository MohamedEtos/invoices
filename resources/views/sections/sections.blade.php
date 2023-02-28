@extends('layouts.master')
@section('title')
الاقسام~
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection

@section('content')
				<!-- row opened -->
				<div class="row row-sm">

					<!--/div-->


					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">

							<div class="col-sm-8 col-md-6 col-xl-4 mg-t-20">
								<a class="modal-effect btn btn-outline-primary " data-effect="effect-rotate-left" data-toggle="modal" href="#modaldemo8">اضافه اقسام</a>
								@error('section_name')
                                <input id="section_name" type="hidden" value="{{$message}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#section_name').val(),
                                           type: "error"
                                       });
                                   }
                                   </script>
								@enderror

								@error('description')
                                <input id="description" type="hidden" value="{{$message}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#description').val(),
                                           type: "error"
                                       });
                                   }
                                   </script>
								@enderror

								@if(Session::has('delete'))
                                <input id="delete" type="hidden" value="{{Session::get('delete')}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#delete').val(),
                                           type: "error"
                                       });
                                   }
                                   </script>
								@endif


								@if(Session::has('delete_faild'))
                                <input id="delete_faild" type="hidden" value="{{Session::get('delete_faild')}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#delete_faild').val(),
                                           type: "error"
                                       });
                                   }
                                   </script>
								@endif

								@if(Session::has('success'))
                                <input id="success" type="hidden" value="{{Session::get('success')}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#success').val(),
                                           type: "success"
                                       });
                                   }
                                   </script>
								@endif
							</div>
							<div class="card-body">
								<div class="table-responsive">



									<table id="example1" class="table key-buttons text-md-nowrap table_style "data-page-length="25">

										<thead>
											<tr>
												<th class="border-bottom-0">م</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">العمليات</th>

											</tr>
										</thead>
										<tbody>
											<?php $i = 0 ; ?>
											@foreach ($sections_data as $data )
											<?php $i++; ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$data->section_name}}</td>
												<td>{{$data->description}}</td>

												<td>
                                                    <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $data->id }}" data-section_name="{{ $data->section_name }}"
                                                       data-description="{{ $data->description }}" data-toggle="modal" href="#exampleModal2"
                                                       title="تعديل"><i class="las la-pen"></i></a>

                                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-id="{{ $data->id }}" data-section_name="{{ $data->section_name }}" data-toggle="modal"
                                                       href="#modaldemo9" title="حذف"><i class="las la-trash"></i></a>
                                            	</td>

											</tr>
											@endforeach

										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
					<!--/div-->
									<!-- add  -->
								<form action="{{route('sections.store')}}" method="post">
									@csrf
									<div class="modal" id="modaldemo8">
										<div class="modal-dialog" role="document">
											<div class="modal-content modal-content-demo">
												<div class="modal-header">
													<h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
														<div class="mb-3">
															<label for="exampleFormControlInput1" class="form-label">اسم القسم</label>
															<input type="text" class="form-control" name="section_name" id="exampleFormControlInput1" >
														</div>
														<div class="mb-3">
															<label for="exampleFormControlTextarea1" class="form-label">نبذة عن القسم</label>
															<textarea class="form-control" id="exampleFormControlTextarea1" name='description' rows="3"></textarea>
														</div>
												</div>
												<div class="modal-footer">
													<button class="btn ripple btn-success" type="submit">حفظ</button>
													<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
												</div>
											</div>
										</div>
									</div>
								</form>

									<!-- End add -->


								<!-- edit -->
								<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
								aria-hidden="true">
							   <div class="modal-dialog" role="document">
								   <div class="modal-content">
									   <div class="modal-header">
										   <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
										   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											   <span aria-hidden="true">&times;</span>
										   </button>
									   </div>
									   <div class="modal-body">

										   <form action="sections/update" method="post" autocomplete="off">
											   {{method_field('patch')}}
											   {{csrf_field()}}
											   <div class="form-group">
												   <input type="hidden" name="id" id="id" value="">
												   <label for="recipient-name" class="col-form-label">اسم القسم:</label>
												   <input class="form-control" name="section_name" id="section_name" type="text">
											   </div>
											   <div class="form-group">
												   <label for="message-text" class="col-form-label">ملاحظات:</label>
												   <textarea class="form-control" id="description" name="description"></textarea>
											   </div>
									   </div>
									   <div class="modal-footer">
										   <button type="submit" class="btn btn-success">تاكيد</button>
										   <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
									   </div>
									   </form>
								   </div>
							   </div>
						   </div>
								<!-- End  edit-->

								<!-- delete -->
								<div class="modal" id="modaldemo9">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content modal-content-demo">
											<div class="modal-header">
												<h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
												type="button"><span aria-hidden="true">&times;</span></button>
											</div>
											<form action="sections/destroy" method="post">
												{{method_field('delete')}}
												{{csrf_field()}}
												<div class="modal-body">
													<p>هل انت متاكد من عملية الحذف ؟
														<br> سيتم حذف كل المنتجات داخل القسم</p><br>
													<input type="hidden" name="id" id="id" value="">
													<input class="form-control" name="section_name" id="section_name" type="text" readonly>
													<p>هذا الاجراء يحتاج الي ترخيص عالي برجاء ادخال كلمه المرور</p>
													<input type="password" class="form-control" name="password_del" id="" type="text" >
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
													<button type="submit" class="btn btn-danger">تاكيد</button>
												</div>
										</div>
										</form>
									</div>
								</div>
								<!-- end delete -->
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>

<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

<script>
	$('#exampleModal2').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var section_name = button.data('section_name')
		var description = button.data('description')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #section_name').val(section_name);
		modal.find('.modal-body #description').val(description);
	})
</script>

<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
		var button = $(event.relatedTarget)
		var id = button.data('id')
		var section_name = button.data('section_name')
		var modal = $(this)
		modal.find('.modal-body #id').val(id);
		modal.find('.modal-body #section_name').val(section_name);
	})
</script>

@endsection
