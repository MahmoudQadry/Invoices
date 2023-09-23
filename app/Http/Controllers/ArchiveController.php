<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices=Invoice::onlyTrashed()->get();
        return view("invoices.archive_invoices",compact("invoices"));
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
        $id=$request->invoice_id;
        $invoice=Invoice::findOrFail($id);
        $invoice->delete();
        session()->flash("success","invoice archive successfully");
        return redirect("archive");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id=$request->invoice_id;
        Invoice::withTrashed()->where("id","$id")->restore();
        session()->flash("success",'restore successfully');
        return redirect("invoices");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        echo "ahmed";
    }
}
