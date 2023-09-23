<?php

namespace App\Http\Controllers;

use App\Exports\InvicesExport;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Section;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Models\Invoice_details;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        return view("invoices.add_invoices", compact("sections"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user=Auth::user();
        // dd($user);
        $data = $request->validate([
            "invoice_no" => "required||string||min:4||unique:invoices,invoice_no",
            "invoice_date" => "required||date",
            "due_date" => "required||date",
            "section_id" => "required||exists:sections,id",
            "product_id" => "required||exists:products,id",
            "commission_amount" => "required||numeric",
            "collection_amount" => "required||numeric",
            "discount" => "required||numeric",
            "rate_vat" => "required||present",
            "value_vat" => "required||numeric",
            "total" => "required||numeric",
            "note" => "string",
            "file_name" => "required||file||mimes:png,jpg,jpeg,pdf",
        ]);
        $data["user"] = Auth::user()->name;
        Invoice::create($data);
        $invoice_id = Invoice::latest()->first()->id;
        $data["invoice_id"] = $invoice_id;
        Invoice_details::create($data);
        if ($request->has("file_name")) {
            $file = $data["file_name"]->getClientOriginalName();
            $data["file_name"] = Storage::putFileAs('invoices/' . $data["invoice_no"], $data["file_name"], $file);
            Attachment::create($data);
            // $user->notify(new AddInvoice($invoice_id));
            $user =User::get();
            $invoice=Invoice::latest()->first();
            Notification::send($user, new AddInvoice($invoice));
        }
        session()->flash("success", "created successfully");
        return redirect("invoices");
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        // dd($invoice);
        return view("invoices.invoice_sataus", compact("invoice"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        // dd($invoice);
        $sections = Section::all();
        return view("invoices.edit_invoices", compact("invoice", "sections"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // dd($invoice);
        if ($invoice->invoice_no == $request->invoice_no) {
            $data = $request->validate([
                "invoice_date" => "required||date",
                "due_date" => "required||date",
                "section_id" => "required||exists:sections,id",
                "product_id" => "required||exists:products,id",
                "commission_amount" => "required||numeric",
                "collection_amount" => "required||numeric",
                "discount" => "required||numeric",
                "rate_vat" => "required||present",
                "value_vat" => "required||numeric",
                "total" => "required||numeric",
                "note" => "string",
            ]);
            $invoice->update($data);
            session()->flash("success", "created successfully");
            return redirect("invoiceDetails/$request->id");
        }
        session()->flash("error", "not found");
        // return back();
        // view("invoices.invoiceDetails",compact("invoice"));
        return redirect("invoiceDetails/$request->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // dd($request);
        $id = $request->invoice_id;
        $invoice = Invoice::findOrFail($id);
        $attachments = Attachment::all();
        if ($attachments->isNotEmpty()) {
            # code...
            Storage::deleteDirectory("invoices/$invoice->invoice_no");
        }
        $invoice->forceDelete();
        session()->flash("success", "deleted succesfully");
        return redirect("invoices");
    }
    public function add_attachment(Request $request)
    {
        $data = $request->validate([
            "file_name" => "required||file||mimes:png,jpg,jpeg,pdf",
            "invoice_id" => "required||exists:invoices,id",
            "invoice_no" => "required||exists:invoices,invoice_no",
        ]);
        $data["user"] = Auth::user()->name;
        $file = $data["file_name"]->getClientOriginalName();
        $data["file_name"] = Storage::putFileAs("invoices/" . $data["invoice_no"], $data["file_name"], $file);
        Attachment::create($data);
        session()->flash("success", "created successfully");
        return back();
    }
    public function status_update(Invoice $invoice, Request $request)
    {
        $data = $request->validate([
            "value_status" => 'required',
            "payment_date" => "required||date",
            "invoice_no" => "required||string||min:4||unique:invoices,invoice_no," . $invoice->id,
            "invoice_date" => "required||date",
            "due_date" => "required||date",
            "section_id" => "required||exists:sections,id",
            "product_id" => "required||exists:products,id",
            "commission_amount" => "required||numeric",
            "collection_amount" => "required||numeric",
            "discount" => "required||numeric",
            "rate_vat" => "required||present",
            "value_vat" => "required||numeric",
            "total" => "required||numeric",
            "note" => "string",
        ]);
        $data["user"] = Auth::user()->name;
        $data["invoice_id"] = $invoice->id;
        if ($request->value_status == 3) {
            $data["status"] = "paid";
            $data["value_status"] = $request->value_status;
            $invoice->update([
                "value_status" => $request->value_status,
                "status" => "paid",
                "payment_date" => $request->payment_date,
            ]);
            Invoice_details::create($data);
            session()->flash("success", "created successfully");
            return redirect()->to("invoices");
        } else {
            $data["status"] = "partial paid";
            $data["value_status"] = $request->value_status;
            $invoice->update([
                "value_status" => $request->value_status,
                "status" => "partial paid",
                "payment_date" => $request->payment_date,
            ]);
            Invoice_details::create($data);
            session()->flash("success", "created successfully");
            return redirect()->to("invoices");
        }
    }
    public function print(Request $request, Invoice $invoice)
    {
        // dd($invoice);
        return view("invoices.print_invoice", compact("invoice"));
    }

    public function export(){
        return Excel::download(new InvicesExport,"InvoiceExport.xlsx");
    }

public function MarkAllAsRead()
{
    $Unreadednotification=auth()->user()->unreadNotifications;
    if($Unreadednotification){
        $Unreadednotification->MarkAsRead();
    }
    return back();
}

}
