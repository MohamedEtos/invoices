<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoices',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;

        invoices::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section'=>$request->Section,
            'discount'=>$request->Discount,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'rate_vat'=>$request->Rate_VAT,
            'value_vat'=>$request->Value_VAT,
            'total'=>$request->Total,
            'status'=>'لم يتم الدفع',
            'value_status'=>0,
            'note'=>$request->note,
            'user'=>Auth::user()->name,
        ]);

        $invoices_id = invoices::latest()->first()->id;

        invoices_details::create([
            'id_invoice'=>$invoices_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'status'=>'لم يتم الدفع',
            'value_Status'=>0,
            'note'=>$request->note,
            'user'=>Auth::user()->name,
        ]);


        if($request->hasFile('pic')){

            $invoices_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            invoices_attachments::create([
                'file_name'=> $file_name,
                'invoice_number'=>$request->invoice_number,
                'Created_by'=>Auth::user()->name,
                'invoice_id'=> $invoices_id,
            ]);

            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);

            return back()->with('success','تم اضافه الفاتورة بنجاح');

        }


        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $sections = sections::all();
        return view('invoices.edit_invoices', compact('sections', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        invoices::where('id',$request->invoice_id)->update([
            'invoice_number'=>$request->invoice_number,
            'invoice_Date'=>$request->invoice_Date,
            'due_date'=>$request->due_date,
            'product'=>$request->product,
            'section'=>$request->section,
            'discount'=>$request->discount,
            'Amount_collection'=>$request->Amount_collection,
            'Amount_Commission'=>$request->Amount_Commission,
            'rate_vat'=>$request->rate_vat,
            'value_vat'=>$request->value_vat,
            'total'=>$request->total,
            'status'=>'لم يتم الدفع',
            'value_status'=>2,
            'note'=>$request->note,
            'user'=>Auth::user()->name,
        ]);

        $invoices_id = invoices::latest()->first()->id;

        invoices_details::where('id',$request->invoice_id)->update([
            'id_invoice'=>$invoices_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->section,
            'status'=>'لم يتم الدفع',
            'value_Status'=>2,
            'note'=>$request->note,
            'user'=>Auth::user()->name,
        ]);

        return redirect()->back()->with('success','تم تعديل الفاتورة');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        invoices::where('id',$request->id_inv)->delete();
        return redirect()->back()->with('success','تم حذف الفاتورة');
    }


    public function getproducts($id){
        $products = DB::table('products')->where('sections_id',$id)->pluck('product_name','id');
        return json_encode($products);

    }
    public function updatePayments(Request $request){


        invoices_details::where('id',$request->id_inv)->create([
            'value_Status' => $request->invoices_status,
            'invoice_number' =>$request->invoices_number ,
            'id_invoice' => $request->id_inv,
            'product' => invoices::where('id',$request->id_inv)->first()->product,
            'section' => invoices::where('id',$request->id_inv)->first()->section,
            'note' => $request->note_payments,
            'status' => $request->invoices_status,
            'user' => Auth::user()->name,
        ]);


        if( invoices_details::latest()->first()->value_Status == 2){
            invoices_details::latest()->first()->update([
                'status'=>'تم الدفع'
            ]);

            invoices::where('id',$request->id_inv)->update([
                'value_status'=>2,
                'status'=>'تم الدفع',
            ]);

        }

        if(  invoices_details::latest()->first()->value_Status == 1){
             invoices_details::latest()->first()->update([
                'status'=>'تم الدفع جزئياً'
            ]);


            invoices::where('id',$request->id_inv)->update([
                'value_status'=>1,
                'status'=>'تم الدفع جزئياً'
            ]);

        }

        return redirect()->back()->with('success','تم تعديل حاله الدفع');


    }

    public function invoices_paid(){

       $invoices = invoices::where('value_status',2)->get();
       $invoices_details = invoices_details::all();
        return view('invoices.invoices_Paid',compact('invoices','invoices_details'));

    }

    public function invoices_unpaid(){
        $invoices = invoices::where('value_status',0)->get();
        $invoices_details = invoices_details::all();
        return view('invoices.invoices_unpaid',compact('invoices','invoices_details'));

    }

    public function invoices_Partially(){
        $invoices = invoices::where('value_status',1)->get();
        $invoices_details = invoices_details::all();
        return view('invoices.invoices_Partially',compact('invoices','invoices_details'));

    }

    public function invoices_arch(){
        $invoices = invoices::onlyTrashed()->get();
        return view('invoices.invoices_Partially',compact('invoices'));

    }



}
