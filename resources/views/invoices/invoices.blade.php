@extends('layouts.master')
@section('title')
الفواتير
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
							<h4 class="content-title mb-0 my-auto">  قائمه الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الفواتير</span>

						</div>
					</div>
                </div>
@endsection

@section('content')
				<!-- row opened -->
				<div class="row row-sm">

					<!--/div-->

                    @if(Session::has('success'))
                    {{-- <span id="hideMeAfter5Seconds"  class=" mr-2 text-success">{{Session::get('success')}}</span> --}}

                    <script>
                     window.onload = function not7() {
                       notif({
                            msg: "تم حذف الفتاتورة ",
                            type: "success"
                        });
                    }
                    </script>


                    @endif
					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="col-sm-6 col-md-2">
									<a href="invoices/create" class="btn btn-primary-gradient btn-block">اضافه فاتورة</a>
								</div>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap " data-page-length="25">
										<thead>
											<tr>
												<th class="border-bottom-0">م</th>
												<th class="border-bottom-0">رقم الفاتورة</th>
												<th class="border-bottom-0">تاريخ الفاتورة</th>
												<th class="border-bottom-0">تاريخ الاستحقاق</th>
												<th class="border-bottom-0">المنتج</th>
												<th class="border-bottom-0">القسم</th>
												<th class="border-bottom-0">الخصم</th>
												<th class="border-bottom-0">نسبه الضريبة</th>
												<th class="border-bottom-0">قيمه الضريبه</th>
												<th class="border-bottom-0">الاجمالي</th>
												<th class="border-bottom-0">الحاله</th>
												<th class="border-bottom-0">ملاحظات</th>
												<th class="border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i = 0 ;
											@endphp
											@foreach ($invoices as $invoice)
											@php
												$i++
											@endphp
											<tr>
												<td>{{$i}}</td>
												<td>{{$invoice->invoice_number}}</td>
												<td>{{$invoice->invoice_Date}}</td>
												<td>{{$invoice->due_date}}</td>
												<td>{{$invoice->productionToSectionsRealtions->section_name}}</td>
												{{-- <td>{{$invoice->invoice_id}}</td> --}}
												<td>
													<a href="{{url('invoicesdetails')}}/{{$invoice->id}}">
														{{$invoice->product}}
													</a>

												</td>
												<td>{{$invoice->discount}}</td>
												<td>{{$invoice->rate_vat}}</td>
												<td>{{$invoice->value_vat}}</td>
												<td>{{$invoice->total}}</td>
												<td>
												@if ($invoice->value_status == 1)
													<span class="text-success">{{ $invoice->status }}</span>
												@elseif($invoice->value_status == 2)
													<span class="text-danger">{{ $invoice->status }}</span>
												@else
													<span class="text-warning">{{ $invoice->status }}</span>
												@endif
												</td>
												<td>{{$invoice->note}}</td>
												<td>
													<div class="dropdown">
														<button aria-expanded="false" aria-haspopup="true" class="btn btn-sm ripple btn-primary"
														data-toggle="dropdown" id="dropdownMenuButton" type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
														<div  class="dropdown-menu tx-13">
															<a class="dropdown-item" href="{{url('invoicesdetails')}}/{{$invoice->id}}">تفاصيل اللفاتورة</a>
															<a class="dropdown-item text-info" href="{{url('edit_invoices')}}/{{$invoice->id}}">تعديل الفاتورة</a>
                                                            {{-- <a class="dropdown-item text-success" href="{{url('edit_invoices')}}/{{$invoice->id}}">تعديل حاله الدفع</a> --}}

                                                            <button class="dropdown-item text-success"
                                                            data-toggle="modal" data-invoices_number="{{$invoice->invoice_number}}"
                                                            data-id_inv="{{ $invoice->id }}"
                                                            data-target="#edit_payment">تعديل حاله الدفع</button>

                                                            <button class="dropdown-item text-danger"
                                                            data-toggle="modal"
                                                            data-id_inv="{{ $invoice->id }}"
                                                            data-target="#delete_file"> حذف الفاتورة
                                                        </button>
														</div>
													</div>
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
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->

        {{-- delete modal --}}

        <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('invoicesDeleted')}}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> هل انت متاكد من عملية حذف الفاتورة ؟</h6>
                        </p>

                        <input type="hidden" name="id_inv" id="id_inv" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

        {{-- delete modal --}}

        <!-- payment status -->
        <div class="modal fade" id="edit_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل حاله الدفع</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('updatePayments')}}" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="title">رقم الفاتورة</label>

                            <input type="hidden" class="form-control" name="id_inv" id="id_inv" value="">

                            <input type="text" disabled class="form-control" name="invoices_number" id="invoices_number">
                        </div>


                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">حاله الدفع</label>
                        <select name="invoices_status" id="invoices_status" class="custom-select my-1 mr-sm-2" required>
                                <option value="0" >مدفعوه كلياً</option>
                                <option value="1" >مدفوعه جزئيا</option>
                        </select>


                        <div class="form-group">
                            <label for="title">المبلغ المدفوع</label>

                            <input type="text" class="form-control" name="payment_value" id="payment_value">
                        </div>
                        <div class="form-group">
                            <label for="title">ملاحظات</label>
                            <input type="text" class="form-control" name="note_payments" id="note_payments">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل الحاله</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        {{-- end payment status --}}

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

<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_inv = button.data('id_inv')
        var modal = $(this)
        modal.find('.modal-body #id_inv').val(id_inv);
    })
</script>

<script>
    $('#edit_payment').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoices_number = button.data('invoices_number')
        var id_inv = button.data('id_inv')
        var modal = $(this)
        modal.find('.modal-body #invoices_number').val(invoices_number);
        modal.find('.modal-body #id_inv').val(id_inv);
    })
</script>
@endsection



