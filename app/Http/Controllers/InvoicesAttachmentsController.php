<?php

namespace App\Http\Controllers;

use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesAttachmentsController extends Controller
{
    
    public function openfile($invoices_number,$file_name){

        return response()->file(public_path('Attachments/'.$invoices_number . '/' . $file_name));

    }
    
    public function downloadfile($invoices_number,$file_name){

        $content = public_path('Attachments/'.$invoices_number . '/' . $file_name);
        return response()->download($content);

    }

}
