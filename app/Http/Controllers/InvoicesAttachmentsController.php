<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InvoicesAttachmentsController extends Controller
{
    
    public function openfile($invoices_number,$file_name){

        return response()->file(public_path('Attachments/'.$invoices_number . '/' . $file_name));

    }
    
    public function downloadfile($invoices_number,$file_name){

        $content = public_path('Attachments/'.$invoices_number . '/' . $file_name);
        return response()->download($content);

    }


    public function delete_file(Request $request){
        // return $request;
        invoices_attachments::where('id',$request->id_file)->delete();
        File::delete(public_path('Attachments/'.$request->invoice_number . '/' . $request->file_name));
        return redirect()->back()->with('delete','تم حذف الملف');

    }


    public function addMoreAttachments(Request $request){

        // return $request;

        if($request->hasFile('pic')){

            // $invoices_id = invoices::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            invoices_attachments::create([
                'file_name'=> $file_name,
                'invoice_number'=>$request->invoice_number,
                'Created_by'=>Auth::user()->name,
                'invoice_id'=> $request->invoice_id,
            ]);

            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);

            return back()->with('success','تم اضافه الملف بنجاح');

        }else{
            return back()->with('errors','فشل في تحميل الملف');

        }
    }

}
