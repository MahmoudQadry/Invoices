<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReport extends Controller
{
    public function index()
    {
        return view("reports.invoices_reports");
    }
    public function get_invoices (Request $request)
    {

        $radio=$request->radio;
        if ($radio==1)
        {
            if($request->type&&$request->start_at&&$request->end_at)
            {
                $from_date=date($request->start_at);
                $to_date=date($request->end_at);
                $type=$request->type;
                $invoices=Invoice::wherebetween("invoice_date",[$from_date,$to_date])->where("value_status","=",$request->type)->get();
                return view("reports.invoices_reports",compact("invoices","type","from_date","to_date"));
            }else{
                $type=$request->type;
                $invoices=Invoice::where("value_status","=",$request->type)->get();
                return view("reports.invoices_reports",compact("invoices","type"));
            }
        }else
        {
            $invoice_no=$request->invoice_number;
            $invoices=Invoice::where("invoice_no","=",$invoice_no)->get();
            return view("reports.invoices_reports",compact("invoices","invoice_no"));
        }
    }
}
