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
<!--Internal  Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<!--Internal  treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview.css')}}" rel="stylesheet" type="text/css" />

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

							<div class="col-12 mg-t-20">
								<a class="modal-effect btn btn-outline-primary col-sm-12 col-md-6 col-lg-2" data-effect="effect-rotate-left" data-toggle="modal" href="#modaldemo8">اضافة منتج</a>
                                
								@error('products_name')
                                <input id="products_name" type="hidden" value="{{$message}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#products_name').val(),
                                           type: "error"
                                       });
                                   }
                                   </script>
								@enderror

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
								@if(Session::has('fai_edit_sections'))
                                <input id="fai_edit_sections" type="hidden" value="{{Session::get('fai_edit_sections')}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#fai_edit_sections').val(),
                                           type: "error"
                                       });
                                   }
                                   </script>
								@endif

								@if(Session::has('success'))
                                <input id="nofic" type="hidden" value="{{Session::get('success')}}">
                                <script>
                                    window.onload = function not7() {
                                      notif({
                                           msg: $('#nofic').val(),
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
												<th class="border-bottom-0" >م</th>
												<th class="border-bottom-0">اسم المنتج</th>
												<th class="border-bottom-0">اسم القسم</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">العمليات</th>

											</tr>
										</thead>
										<tbody>
											<?php $i = 0 ; ?>
											@foreach ($products as $data )
											<?php $i++; ?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$data->product_name}}</td>
												<td>{{$data->productionToSectionsRealtions->section_name }}</td>
												<td>{{$data->description}}</td>

												<td>
													<button class="btn btn-outline-success btn-sm"
														data-name="{{ $data->product_name }}" data-pro_id="{{ $data->id }}"
														data-section_name="{{ $data->productionToSectionsRealtions->section_name }}"
														data-description="{{ $data->description }}" data-toggle="modal"
														data-target="#edit_Product">تعديل</button>

													<button class="btn btn-outline-danger btn-sm " data-pro_id="{{ $data->id }}"
														data-product_name="{{ $data->product_name }}" data-toggle="modal"
														data-target="#modaldemo9">حذف</button>
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
								<form action="{{route('products.store')}}" method="post">
									@csrf
									<div class="modal" id="modaldemo8">
										<div class="modal-dialog" role="document">
											<div class="modal-content modal-content-demo">
												<div class="modal-header">
													<h6 class="modal-title">اضافة منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
														<div class="mb-3">
															<label for="exampleFormControlInput1" class="form-label">اسم المنتج</label>
															<input type="text" class="form-control" name="product_name" id="exampleFormControlInput1" required >
														</div>

														<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
														<select name="sections_id" id="section_id" class="form-control mb-3" required>
															<option value="" selected disabled> --حدد القسم--</option>
															 @foreach ($sections as $section)
																<option value="{{ $section->id }}">{{ $section->section_name }}</option>
															 @endforeach
														</select>

														<div class="mb-3">
															<label for="exampleFormControlTextarea1" class="form-label">نبذة عن المنتج</label>
															<textarea class="form-control" id="exampleFormControlTextarea1" name='description' rows="3" required></textarea>
														</div>
												</div>
												<div class="modal-footer">
													<button class="btn ripple btn-success" type="submit" >حفظ</button>
													<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">اغلاق</button>
												</div>
											</div>
										</div>
									</div>
								</form>

									<!-- End add -->


								<!-- edit -->
								<div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
								aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action='products/update' method="post">
											{{ method_field('patch') }}
											{{ csrf_field() }}
											<div class="modal-body">

												<div class="form-group">
													<label for="title">اسم المنتج :</label>

													<input type="hidden" class="form-control" name="pro_id" id="pro_id" value="">

													<input type="text" class="form-control" name="product_name" id="product_name">
												</div>

												<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
												<select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
													@foreach ($sections as $section)
														<option>{{ $section->section_name }}</option>
													@endforeach
												</select>

												<div class="form-group">
													<label for="des">ملاحظات :</label>
													<textarea name="description" cols="20" rows="5" id='description'
														class="form-control"></textarea>
												</div>

											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">تعديل البيانات</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
											</div>
										</form>
									</div>
								</div>
							</div>

								{{-- end edit --}}

								<!-- delete -->
								<div class="modal fade" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
									aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">حذف المنتج</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<form action="products/destroy" method="post">
												{{ method_field('delete') }}
												{{ csrf_field() }}
												<div class="modal-body">
													<p>هل انت متاكد من عملية الحذف ؟</p><br>
													<input type="hidden" name="pro_id" id="pro_id" value="">
													<input class="form-control" name="product_name" id="product_name" type="text" readonly>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
													<button type="submit" class="btn btn-danger">تاكيد</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								{{-- end delete --}}
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
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
        $('#edit_Product').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('name')
            var section_name = button.data('section_name')
            var pro_id = button.data('pro_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #pro_id').val(pro_id);
        })
</script>

<script>
	$('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var modal = $(this)

            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
        });

		function test(){
		};
</script>

@endsection




