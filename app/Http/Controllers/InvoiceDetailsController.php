<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Invoice;
use App\Models\Invoice_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id,$readed=null)
    {
        if($readed!=null){
            auth()->user()->unreadNotifications->markAsRead($readed);
        }
            $invoice=Invoice::where("id",$id)->first();
            $invoiceDetails=Invoice_details::where("invoice_id",$invoice->id)->get();
            $invoiceAttachment=Attachment::where("invoice_id",$invoice->id)->get();
            return view("invoices.invoiceDetails",compact("invoice","invoiceDetails","invoiceAttachment"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice_details $invoice_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice_details $invoice_details)
    {
        //
    }
    // public function View_file($invoices,$invoice_name,$name)
    // {
    //     // dd([$invoices,$invoice_name,$name]);
    //     $file=public_path("storage/invoices/file5/omarrsabryy.pdf");
    //     // $file=Storage::disk("public")->get("/$invoice_name/$name");

    //     // dd($file);
    //     return response()->file($file);
    // }
    // public function download_file($invoices,$invoice_name,$name)
    // {
    //     // dd([$invoices,$invoice_name,$name]);
    //     $file=Storage::disk("public")->get("$invoices/$invoice_name/$name");
    //     // dd($file);
    //     return response()->download($file);
    // }
}
