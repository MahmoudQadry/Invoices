<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class ClientReport extends Controller
{
    public function index()
    {
        $sections=Section::all();
        return view("reports.client_reports",compact("sections"));
    }
    public function Search_customers(Request $request)
    {
        $start_at=$request->start_at;
        $end_at=$request->end_at;
        $Section=$request->Section;
        $product=$request->product;
        if($start_at&&$end_at&&$Section&&$product){
            Invoice::wherebetween("invoice_date",[$start_at,$end_at])->where("section_id",$Section)->get();
        }
    }
}
