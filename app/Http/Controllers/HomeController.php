<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_invoice=Invoice::count();
        $unpaid_invoice=Invoice::where("value_status",1)->count();
        $PartialPaid_invoice=Invoice::where("value_status",2)->count();
        $Paid_invoice=Invoice::where("value_status",3)->count();
        $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['unpaid invoice', 'PartialPaid invoice','Paid invoice'])
         ->datasets([
             [
                 "label" => "My First dataset",
                 'backgroundColor' => ['rgba(255, 99, 132, 0.2)', 'rgba(255, 99, 132, 0.2)','rgba(255, 99, 132, 0.2)'],
                 'data' => [$unpaid_invoice/$all_invoice*100,$PartialPaid_invoice/$all_invoice*100,$Paid_invoice/$all_invoice*100]
             ],
            //  [
            //      "label" => "My second dataset",
            //      'backgroundColor' => ['rgba(255, 99, 132, 0.3)', 'rgba(54, 162, 235, 0.3)'],
            //      'data' => [65, 12]
            //  ]
         ])
         ->options([]);

         $chartjs2 = app()->chartjs
         ->name('pieChartTest')
         ->type('pie')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['unpaid_invoice','PartialPaid_invoice','Paid_invoice'])
         ->datasets([
             [
                 'backgroundColor' => ['#FF6384', '#36A2EB','#FF2000'],
                 'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#FF2000'],
                 'data' => [$unpaid_invoice/$all_invoice*100,$PartialPaid_invoice/$all_invoice*100,$Paid_invoice/$all_invoice*100]
             ]
         ])
         ->options([]);
        return view('index',compact("chartjs","chartjs2"));
        // return view('home');
    }
}
