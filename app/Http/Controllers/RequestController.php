<?php

namespace App\Http\Controllers;
use \View as View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
include("lib/inc/chartphp_dist.php");


 class RequestController extends BaseController
{
    public function GetHistory(){
        if(Auth::check()) {
            /*
             * Pie chart
             */
            $p = new \chartphp();
            $DB = DB::Table('users')->select('Apple','Car','House','Gas')->where('id', '=', '2')->get();
            $fields = [];
            foreach($DB as $ind => $val) {
                foreach($val as $x => $y){
                    $fields[] =  [$x, $y];
                }

}
            $data = [ $fields ];
            $p->data = $data;
            $p->chart_type = "pie";
            $p->title = "";
            $out = $p->render('c2');
            /*
             * end pie chart
             */
            /*
             * Line Chart
             */
            $p = new \chartphp();

            $p->data = array(
                    array(
                        array(48.25,"2014-01-11"),
                        array(95.50,"2014-01-12"),
                        array(238.75,"2014-01-13"),
                        array(286.80,"2014-01-14"),
                        array(300.50,"2014-01-15")));
            $p->chart_type = "line";

// Common Options
            $p->title = "Sales - 2014 vs 2015";
            $p->ylabel = "Sales";

// For Custom Legend Names
            $p->series_label = array("2014","2015");
            $p->legend_show = false;

// Date interval for y axis
            $p->y_data_type = 'date';
            $p->y_tick_interval = '2 day';

             $Line = $p->render('c1');

/*
            end line chart
            */
            $id = Auth::user()->id;
            $Acc = $History =  DB::table('users')->select('BankAcc', 'StockAcc')->where('id', '=', $id)->get();
            $Error = ' ';
            $History = DB::table('History')
                ->select('Name', 'StockName', 'price', 'Date')
                ->where('UID', '=', $id)
                ->Take(5)
                ->get();

            if ($History == null) {
                $Error = 'You Have no purchased Stocks';
                return view('pages.Home')->
                with('Error', $Error)->
                with('History', $History)->
                with('Acc',$Acc)->
                with('out', $out);
            }
            else {
                return view('pages.home')
                    ->with('History', $History)
                    ->with('Error', $Error)
                    ->with('Acc',$Acc)
                    ->with('out', $out)->
                    with('Line',$Line)->
                    with('data', $data);
            }
        }
        else{
            return redirect()->intended('auth/login');
        }
    }
        /*
         * FULL transaction panel
         */
     public function GetHistoryFull()
     {
         if (Auth::check()) {
             $id = Auth::user()->id;
             $Error = ' ';
             $History = DB::table('History')
                 ->select('Name', 'StockName', 'Amount', 'Date', 'Price', 'BuyPrice', 'StartPrice')
                 ->where('UID', '=', $id)
                 ->get();
             if ($History == null) {
                 $Error = 'You Have no purchased Stocks';
                 return view('pages.Full')->with('Error', $Error)->with('History', $History);
             } else {
                 return view('pages.Full')->with('History', $History)->with('Error', $Error);
             }
         } else {
             return redirect()->intended('auth/login');
         }
     }
     public function Test(){
         $p = new \chartphp();
         $p->data = array(array(array('a',6), array('b',8), array('c',14), array('d',20)));
         $p->chart_type = "pie";
         $p->title = "";
         $out = $p->render('c2');
         return view('pages.test')->with('out', $out);
}

}
